<?php 

    require_once( 'lib/helpers/visits-setup.inc.php'); 
    require_once( "lib/helpers/visits-util.inc.php"); 
  
    $gate=new ContinentTableGateway($dbAdapter);
    $results = $gate->getHitsByID($_GET["id"]);
    
    function genTableRow($item)
    {
        return "<tr><td class='mdl-data-table__cell--non-numeric'>".$item->CountryName."</td><td>".$item->Hits."</td></tr>";    
    }
    
    $output = "<th class='mdl-data-table__cell--non-numeric'>Country</th>
                  <th>Hits</th>";
     foreach($results as $item)
     {
         $output = $output.genTableRow($item);
     }
     
     echo $output;
    
?>