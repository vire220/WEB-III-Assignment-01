<?php
/*
   Represents a single row for the Browsers table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class Continent extends DomainObject implements JsonSerializable
{  
   
   static function getFieldNames() {
      return array('id','name');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }

   public function jsonSerialize(){
      return [ 'id'=> $this->id, 'num' => $this->num ];
   }

}

?>