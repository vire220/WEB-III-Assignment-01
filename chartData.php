<?php
require_once('lib/helpers/visits-setup.inc.php');
header('Content-type: application/json');

$id = $_GET['id'];

$gate = new VisitsTableGateway($dbAdapter);

if($_GET["type"] == "area")
{
$result = $gate->getHitsByDay($id);
}

if($_GET["type"] == "region")
{
$result = $gate->getRegionData($id);
}

if($_GET["type"] == "bar")
{
$result["id1"] = $gate->getCountryDataByMonth($_GET["id1"]);
$result["id2"] = $gate->getCountryDataByMonth($_GET["id2"]);
$result["id3"] = $gate->getCountryDataByMonth($_GET["id3"]);
}


echo json_encode($result);
?>