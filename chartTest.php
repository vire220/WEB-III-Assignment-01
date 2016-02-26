<?php
include("./dashboard1.php");
require_once('lib/helpers/visits-setup.inc.php');
require_once("lib/helpers/visits-util.inc.php");

$vGate = new VisitsTableGateway($dbAdapter);
$resultA = $vGate->getPercentages();
$result = $vGate->findByBrowserPercent();
$result4 = $vGate->findAllTables();
$areaData = $vGate->getHitsByDay("01");

$gate = new DeviceBrandTableGateway($dbAdapter);
$resultsB = $gate->getBrandHits();

$gate = new ContinentTableGateway($dbAdapter);
$resultsC = $gate->findAllCustom();

$gate2 = new DeviceBrandTableGateway($dbAdapter);
$result2 = $gate2->findByName();

$gate3 = new ContinentTableGateway($dbAdapter);
$result3 = $gate3->findByName();

?>

<!doctype html>
  <html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>

  <!-- Add to homescreen for Chrome on Android -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="icon" sizes="192x192" href="images/android-desktop.png">

  <!-- Add to homescreen for Safari on iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Material Design Lite">
  <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

  <!-- Tile icon for Win8 (144x144 + tile color) -->
  <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
  <meta name="msapplication-TileColor" content="#3372DF">

  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://code.getmdl.io/1.1.1/material.indigo-pink.min.css">
  <script defer src="https://code.getmdl.io/1.1.1/material.min.js"></script>
  <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
  <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script src="js/chart.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="css/styles.css">

  <!--Load the AJAX API-->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    
    
    
    
    

</head>

<body>
    <div id="chart_div"></div>
    <select id="month-list">
      <option value="01" selected="selected">January</option>
      <option value="02">February</option>
      <option value="03">March</option>
      <option value="04">April</option>
      <option value="05">May</option>
      <option value="06">June</option>
      <option value="07">July</option>
      <option value="08">August</option>
      <option value="09">September</option>
      <option value="10">October</option>
      <option value="11">November</option>
      <option value="12">December</option>
    </select>
    
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      var google;
      google.charts.setOnLoadCallback(drawAreaChart);
      
    google.charts.load('current', {'packages':['corechart']});
      // Set a callback to run when the Google Visualization API is loaded.
      

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawAreaChart() {

        var xhr = new XMLHttpRequest();
        //console.log("select value: " +document.getElementById("month-list").value);
        xhr.open('GET', 'chartData.php?id=' + document.getElementById("month-list").value);
        xhr.send(null);
    
        xhr.onload = function () {
          
        // Create the data table.
        var areaArray = JSON.parse(xhr.responseText);
        //console.log("response text: " + areaArray);
        var editArray = [["hits", "date"]];
        
        for(var i = 0; i < areaArray.length; i++)
        {
            console.log("loop #" + i + ": " + areaArray[i]);
            editArray.push([parseInt(areaArray[i].visit_date.substring(8,10)), parseInt(areaArray[i].hits)]);
            
        }
        console.log("Edit array: " + editArray);
        var data = google.visualization.arrayToDataTable(editArray);
        
        // Set chart options
        var options = {'title':'Visits by Date',
                       hAxis: {title: 'Day',  titleTextStyle: {color: '#333'}},
                        vAxis: {title: 'Visits', minValue: 0}};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
        };
      }
      
      document.getElementById("month-list").addEventListener("change", drawAreaChart);
      
    </script>
</body>
</html>