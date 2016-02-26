<?php
/*
   Represents a single row for the device-brand table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class Countries extends DomainObject implements JsonSerializable
{  
   
   static function getFieldNames() {
      return array('id','name');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
   
   public function jsonSerialize(){
      return  $this->name;
   }
}

?>