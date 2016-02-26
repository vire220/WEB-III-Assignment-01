<?php
/*
  Table Data Gateway for the Browser table.
 */
class VisitsTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "Visits";
   } 
   protected function getTableName()
   {
      return "visits";
   }
   protected function getOrderFields() 
   {
      return 'name';
   }
  
   protected function getPrimaryKeyName() {
      return "id";
   }
    
    
     public function findByBrowserPercent()
   {
      $sql = "SELECT name, COUNT(*) AS num FROM `visits` JOIN browsers ON browsers.ID=visits.browser_id GROUP BY `browser_id`";
     
      $results = $this->dbAdapter->fetchAsArray($sql); 
      if (is_null($results))
          return $results;
      else          
          return $this->convertRecordsToObjects($results);
     }
    
      
     public function findByBrowserId($id)
   {  
         $sql = "SELECT `browser_id`, name, COUNT(*)AS num FROM `visits` JOIN browsers ON browsers.ID=visits.browser_id WHERE `browser_id` = :id GROUP BY `browser_id` ";
     
         $results = $this->dbAdapter->fetchRow($sql, Array(':id' => $id));
      if (is_null($results))
          return $results;
      else          
          return $this->convertRowToObject($results);
     }


      public function findAllTables()
   {
      $sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='visits'";
     
      $results = $this->dbAdapter->fetchAsArray($sql); 
      if (is_null($results))
          return $results;
      else          
          return $this->convertRecordsToObjects($results);
     }
      // http://stackoverflow.com/questions/3913620/get-all-table-names-of-a-particular-database-by-sql-query  
    
  
    function getPercentages()
   {
      $sql = "SELECT b.name, (
      COUNT( v.id ) / ( 
      SELECT COUNT( * ) 
      FROM visits ) *100
      ) AS percentage
      FROM visits AS v
      JOIN browsers AS b ON ( b.ID = v.browser_id ) 
      GROUP BY b.name";
      
      $result = $this->dbAdapter->fetchAsArray($sql);
      return $result;
   }
    

   function getHitsByDay($id)
   {
      $sql = "SELECT COUNT( id ) AS hits, visit_date
      FROM visits
      WHERE visit_date LIKE ?
      GROUP BY visit_date;";
      
      $result = $this->dbAdapter->fetchAsArray($sql, array("____-".$id."%"));
      
      return $result;
   }
   
   function getRegionData($id)
   {
      $sql = "SELECT CountryName, Count(id) as hits
      FROM countries as c JOIN visits as v ON (v.country_code = c.ISO)
      WHERE visit_date LIKE ?
      GROUP BY CountryName";
      
      $result = $this->dbAdapter->fetchAsArray($sql, array("____-".$id."%"));
      
      return $result;
   }
   
   public function getCountryVisits($id){

       $sql = "SELECT countries.countryname AS country, device_types.name as device, device_brands.name AS brand, operating_systems.name as os, referrers.name AS referrer,ip_address as ip, visit_date as date, visit_time as time FROM `visits` JOIN device_types ON device_types.id=visits.device_type_id JOIN device_brands ON device_brands.id=visits.device_brand_id JOIN browsers ON browsers.id=visits.browser_id JOIN countries ON countries.iso=visits.`country_code` JOIN operating_systems ON operating_systems.id=visits.`os_id` JOIN referrers ON referrers.id=visits.`referrer_id` WHERE countries.countryname =:id ORDER BY visit_date DESC, visit_time DESC LIMIT 100 ";

             $results = $this->dbAdapter->fetchAsArray($sql, Array(':id' => $id)); 
            if (is_null($results))
                return $results;
            else          
                return $this->convertRecordsToObjects($results);


    }
    
    function getCountryDataByMonth($iso)
   {
      $sql = 'SELECT CountryName, Count(id) as hits, "01" as month
      FROM countries as c JOIN visits as v ON (v.country_code = c.ISO)
      WHERE visit_date LIKE "____-01%"
      AND ISO LIKE ?
      GROUP BY CountryName
UNION
SELECT CountryName, Count(id) as hits, "05" as month
      FROM countries as c JOIN visits as v ON (v.country_code = c.ISO)
      WHERE visit_date LIKE "____-05%"
      AND ISO LIKE ?
      GROUP BY CountryName
UNION
SELECT CountryName, Count(id) as hits, "09" as month
      FROM countries as c JOIN visits as v ON (v.country_code = c.ISO)
      WHERE visit_date LIKE "____-09%"
      AND ISO LIKE ?
      GROUP BY CountryName';
      
      $result = $this->dbAdapter->fetchAsArray($sql, array($iso, $iso, $iso));
      
      return $result;
   }
   
   function getAllDeviceTypes()
   {
      $sql = "SELECT * FROM device_types;";
      
      return $this->dbAdapter->fetchAsArray($sql);
   }
   
   function getAllDeviceBrands()
   {
      $sql = "SELECT * FROM device_brands;";
      
      return $this->dbAdapter->fetchAsArray($sql);
   }
   
   function getAllBrowsers()
   {
      $sql = "SELECT * FROM browsers;";
      
      return $this->dbAdapter->fetchAsArray($sql);
   }
   
   function getAllReferrers()
   {
      $sql = "SELECT * FROM referrers;";
      
      return $this->dbAdapter->fetchAsArray($sql);
   }
   
   function getAllOS()
   {
      $sql = "SELECT * FROM operating_systems;";
      
      return $this->dbAdapter->fetchAsArray($sql);
   }
   
   function filterSearch($data)
   {
      $sql = "SELECT visit_date, visit_time, ip_address, CountryName, id
      FROM visits JOIN countries ON (ISO = country_code)";
      
      $where = " WHERE id IS NOT NULL ";
      
      foreach($data as $key => $value)
      {
         if($value != "null")
         {
            $where .= "AND ".$key." LIKE '".$value."'";
         }
      }
      
      $sql .= $where;
      
      $results = $this->dbAdapter->fetchAsArray($sql." ORDER BY visit_date DESC, visit_time DESC LIMIT 100;");
      
      return $this->convertRecordsToObjects($results);
   }
}

?>