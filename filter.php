<?php
require_once('lib/helpers/visits-setup.inc.php');
header('Content-type: application/json');
$id = $_GET[ "id" ];
$gate = new VisitsTableGateway($dbAdapter);
$result = $gate->filterSearch($_GET);
echo json_encode($result);
?>