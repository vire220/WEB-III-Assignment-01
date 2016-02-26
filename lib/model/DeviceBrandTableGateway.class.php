<?php
/*
  Table Data Gateway for the device-brand table.
 */
class DeviceBrandTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "DeviceBrand";
   } 
   protected function getTableName()
   {
      return "device_brands";
   }
   protected function getOrderFields() 
   {
      return 'name';
   }
  
   protected function getPrimaryKeyName() {
      return "id";
   }

      public function findByName()
   {
      $sql = "SELECT name, COUNT(*)AS num FROM `visits` JOIN device_brands ON device_brands.ID=visits.device_brand_id GROUP BY `device_brand_id`";
     
      $results = $this->dbAdapter->fetchAsArray($sql); 
      if (is_null($results))
          return $results;
      else          
          return $this->convertRecordsToObjects($results);
     }


   public function findByDeviceId($id)
   {  
         $sql = "SELECT name, COUNT(*)AS num FROM `visits` JOIN device_brands ON device_brands.ID=visits.device_brand_id WHERE `device_brand_id` = :id GROUP BY `device_brand_id`";
     
         $results = $this->dbAdapter->fetchRow($sql, Array(':id' => $id));
      if (is_null($results))
          return $results;
      else          
          return $this->convertRowToObject($results);
     }


function getBrandHits()
   {
      $sql = "select name, count(name) as hits
         from device_brands JOIN visits ON (device_brands.ID = visits.device_brand_id)
         group by name";
      
      $result = $this->dbAdapter->fetchAsArray($sql);
      return $result;
   }

}

?>

