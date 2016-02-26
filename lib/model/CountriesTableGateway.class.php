<?php
/*
  Table Data Gateway for the Browser table.
 */
class CountriesTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "Countries";
   } 
   protected function getTableName()
   {
      return "countriess";
   }
   protected function getOrderFields() 
   {
      return "name";
   }
  
   protected function getPrimaryKeyName() {
      return "id";
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

      public function findForAuto($term)
   {      
       $sql = "SELECT `ISO` , CountryName as name FROM countries WHERE CountryName LIKE ? LIMIT 100";

      $results = $this->dbAdapter->fetchAsArray($sql, Array("%".$term."%"));   
       if (is_null($results))
          return $results;
      else          
          return $this->convertRecordsToObjects($results);
    }

   public function getTopCountries()
   {
      $sql = "SELECT CountryName, ISO, Count(id) as hits
      FROM countries as c JOIN visits as v ON (v.country_code = c.ISO)
      GROUP BY CountryName
      ORDER BY hits DESC
      LIMIT 0, 10";
      
      return $this->dbAdapter->fetchAsArray($sql);
   }

 
}

?>