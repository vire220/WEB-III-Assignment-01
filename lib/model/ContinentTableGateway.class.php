<?php
/*
  Table Data Gateway for the Browser table.
 */
class ContinentTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "Continent";
   } 
   protected function getTableName()
   {
      return "continents";
   }
   protected function getOrderFields() 
   {
      return "name";
   }
  
   protected function getPrimaryKeyName() {
      return "id";
   }
    
    public function findByName()
   {
      $sql = "SELECT `ContinentName` AS name ,`ContinentCode`AS num FROM `continents`";
     
      $results = $this->dbAdapter->fetchAsArray($sql); 
      if (is_null($results))
          return $results;
      else          
          return $this->convertRecordsToObjects($results);
     }

     public function findByBrowserContinent($id)
   {  
         $sql = "SELECT `CountryName`AS id , COUNT(*)AS num FROM `countries` JOIN visits ON countries.ISO=visits.country_code WHERE `Continent`= :id GROUP BY `ISO`";
     
         $results = $this->dbAdapter->fetchAsArray($sql, Array(':id' => $id)); 
      if (is_null($results))
          return $results;
      else          
       return $this->convertRecordsToObjects($results);
     }

    public function getHitsByID($id)
   {
      $sql = "SELECT CountryName, COUNT(v.id) as Hits
      FROM visits as v JOIN countries as c ON (c.ISO = v.country_code)
      JOIN continents as con ON (c.Continent = con.ContinentCode)
      WHERE Continent = ?
      GROUP BY CountryName";
      
      $result = $this->dbAdapter->fetchAsArray($sql, array($id));
      
      return $this->convertRecordsToObjects($result);
      
   }
   
   public function findAllCustom()
   {
      $sql = "SELECT ContinentCode as id, ContinentName as name FROM continents;";
      
      $result = $this->dbAdapter->fetchAsArray($sql);
      
      return $this->convertRecordsToObjects($result);
   }

    
}

?>