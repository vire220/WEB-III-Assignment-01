<?php
/*
   Represents a single row for the device-brand table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class Visits extends DomainObject implements JsonSerializable
{  
   
   static function getFieldNames() {
      return array('id','name');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
   
   public function jsonSerialize(){
      return  [ 'country'=> $this->CountryName, 'ip' => $this->ip_address, 'time'=> $this->visit_time, 'date'=> $this->visit_date ];
   }
   // implement any setters that need input checking/validation
}

?>