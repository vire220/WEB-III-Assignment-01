<?php
/*
   Use this page to test each one of your table gateway classes.
*/

require_once('lib/helpers/visits-setup.inc.php');


function makeChart($result){

$len=count($result);
$i=0;
foreach ($result as $row)
{
   if($i == $len-1)
   	{echo "['". $row->name ."', ". $row->num . "]";}
   else
    {echo "['". $row->name ."', ". $row->num . "],"; 
	$i++;}
 
} 
}

function makeLists($array)
{
 			foreach ($array as $option){
 			echo '<option value="'.$option->num.'">'.$option->name.'</option>';
 			}

}

function makeListFilter($array)
{
 			foreach ($array as $option){
 			echo '<option value="'.$option->TABLE_NAME.'">'.$option->TABLE_NAME.'</option>';
 			}

}
  

?>