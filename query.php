
<?php
require_once('lib/helpers/visits-setup.inc.php');
header('Content-type: application/json');
$id = $_GET['id'];
$gate4 = new ContinentTableGateway($dbAdapter);
$result4 = $gate4->findByBrowserContinent($id);
echo json_encode($result4);
?>




