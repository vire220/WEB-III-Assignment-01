<?php
require_once('lib/helpers/visits-setup.inc.php');
header('Content-type: application/json');
$term = $_GET[ "term" ];
$gate = new CountriesTableGateway($dbAdapter);
$result = $gate->findForAuto($term);
echo json_encode($result);
?>