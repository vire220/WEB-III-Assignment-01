<?php
include("./dashboard1.php");
require_once('lib/helpers/visits-setup.inc.php');
require_once("lib/helpers/visits-util.inc.php");

$gate = new VisitsTableGateway($dbAdapter);
$resultA = $gate->getPercentages();

$gate = new DeviceBrandTableGateway($dbAdapter);
$resultsB = $gate->getBrandHits();

$gate = new ContinentTableGateway($dbAdapter);
$resultsC = $gate->findAllCustom();

$gate = new VisitsTableGateway($dbAdapter);
$result = $gate->findByBrowserPercent();
$result4 = $gate->findAllTables();

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




  <!-- The drawer is always open in large screens. The header is always shown,
  even in small screens. -->
  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header mdl-layout--header--scroll">
    <header class="mdl-layout__header ">
      <div class="mdl-layout__header-row">
        <div class="mdl-layout-spacer"></div>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
                  mdl-textfield--floating-label mdl-textfield--align-right">
          <label class="mdl-button mdl-js-button mdl-button--icon" for="fixed-header-drawer-exp">
            <i class="material-icons">search</i>
          </label>
          <div class="mdl-textfield__expandable-holder">
            <input class="mdl-textfield__input" type="text" name="sample" id="fixed-header-drawer-exp">
          </div>
        </div>
      </div>
    </header>
    <div class="mdl-layout__drawer">
      <span class="mdl-layout-title">Title</span>
      <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="">Link</a>
        <a class="mdl-navigation__link" href="">Link</a>
        <a class="mdl-navigation__link" href="">Link</a>
        <a class="mdl-navigation__link" href="">Link</a>
      </nav>
    </div>
    <main class="mdl-layout__content mdl-color--grey-100">







      <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">


        <div class="mdl-tabs__tab-bar">
          <a href="#dashboard2-panel" class="mdl-tabs__tab is-active">Dashboard 1 Php</a>
          <a href="#dashboard1-panel" class="mdl-tabs__tab">Dashboard 2 - Ajax</a>
          <a href="#aboutus-panel" class="mdl-tabs__tab">About Us</a>
          <a href="#visitbrowser-panel" class="mdl-tabs__tab">Visit Browser</a>
          <a href="#graphs-panel" class="mdl-tabs__tab">Graphs</a>
        </div>


       

        <!-- End of The first panel -->


        <!-- Panel 2 that will contain raw php produced Dashboard -->

        <div class="mdl-tabs__panel is-active" id="dashboard2-panel">

          <div class="mdl-grid">


            <div class="browser-card mdl-card mdl-shadow--2dp mdl-cell mdl-cell--middle mdl-cell--6-col">
              <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">Visits by Browser</h2>
              </div>

              <table class='mdl-data-table mdl-js-data-table mdl-card__supporting-text'>
                <thead>
                  <tr>
                    <th class='mdl-data-table__cell--non-numeric'>Browser</th>
                    <th>Percentage</th>
                  </tr>
                </thead>
                <tbody>

                  <?php echo genBrowserTableRows($resultA); ?>

                </tbody>
              </table>
            </div>

            <div class="brand-card mdl-card mdl-shadow--2dp mdl-cell mdl-cell--top mdl-cell--6-col">
              <div class="mdl-card__title mdl-card--expand">
                <h2 class="mdl-card__title-text">Visits by Location</h2>
              </div>

              <div class="mdl-card__actions mdl-card--border">
                <select id="continent-card__select">
                  <option value="Select Continent">Select Cont.</option>
                  <?php echo genContinentOptions($resultsC); ?>
                </select>
              </div>
              <div class="mdl-card__supporting-text">
                <h3 id="continent-card__h3"></h3>
              </div>
              <table id="continent-card__table" class='mdl-card__supporting-text mdl-data-table mdl-js-data-table mdl-card__supporting-text'>
              </table>

            </div>


            <div class="mdl-card mdl-shadow--2dp mdl-cell mdl-cell--top mdl-cell--6-col">
              <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">Hits by Brand</h2>
              </div>

              <div class="mdl-card__actions mdl-card--border">

                <select id="brand-card__select">
                  <option value="Select Brand">Select Brand</option>
                  <?php echo genBrandOptions($resultsB); ?>

                </select>

              </div>
              <div class="brand-card mdl-card__supporting-text" id="brand-card__info">
                Select Brand
              </div>
            </div>
          </div>
        </div>



      <!-- End of The second panel -->

   <!-- Dashboard AJax Page, could have made a new .php page however it was more user friendly to add a panel element than and new page -->

        <div class="mdl-tabs__panel" id="dashboard1-panel">
          <div class="mdl-grid demo-content">

            <div class="demo-cards mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing">
              <div class="demo-updates mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop">
                <div class="mdl-card__title mdl-card--expand ">
                  <div id="chart_div"></div>
                </div>
              </div>


              <div class="demo-separator mdl-cell--1-col"></div>

              <div class="demo-options mdl-card  mdl-shadow--2dp  mdl-cell--4-col mdl-cell--3-col-tablet mdl-cell--12-col-desktop">


                <div>
                  <label>Visits by Device Brands</label>
                  <select id="device-Brands">
                    <option value="" disabled selected>Choose your device</option>
                    
                    <?php makeLists($result2); ?>
                    
                  </select>
                </div>
                <h3 id="brand">Visits:</h3>
              </div>





            </div>

            <div class="demo-options mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--6-col">

              <div>
                <label>Continents</label>
                <select id="continents">
                  <option value="" disabled selected>Choose your option</option>
                  <?php makeLists($result3); ?>
                </select>
              </div>

              <div id="spinner" class="mdl-spinner mdl-js-spinner is-active"></div>


              <table id="table" class="mdl-data-table mdl-js-data-table">
                <thead>
                  <tr>
                    <th class="mdl-data-table__cell--non-numeric">City</th>
                    <th>Visits</th>
                  </tr>
                </thead>
                <tbody id="tbody">

                </tbody>
              </table>



            </div>

          </div>


        </div>

      <!-- About Us Panel -->

      <div class="mdl-tabs__panel" id="aboutus-panel">
        <div class="mdl-card mdl-cell mdl-cell--8-col mdl-shadow--4dp">
          
          <div class="mdl-card--title">
            <h1>About Us</h1>
            <h4>Group Members</h4>
            <p>Brandon, Alex, Zeyad, Julianna</p>
            <h4>GitHub</h4>
            <a href="https://github.com/vire220/WEB-III-Assignment-01.git">GitHub Link</a>
            <h4>Resources</h4>
            <a href="https://jquery.com/">jQuery</a><br>
            <a href="https://jqueryui.com/">jQuery UI</a><br>
            <a href="https://www.getmdl.io/">MDL</a>
            
            
          </div>
        </div>
      </div>

      <!-- End of About Us panel -->



      <!-- Visits Filter Panel -->

      <div class="mdl-tabs__panel" id="visitbrowser-panel">
        <div class="mdl-grid demo-content">

                            <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--3-col">

                                           <div id="filter-card-dropdowns">
                                                 
                                                    <?php 
                                                    echo "<br><label>Device Type</label>";
                                                    genDeviceTypeDropdown($dbAdapter);
                                                    echo "<br><label>Device Brand</label>";
                                                    genDeviceBrandDropdown($dbAdapter);
                                                    echo "<br><label>Browser Used </label>";
                                                    genBrowserDropdown($dbAdapter);
                                                    echo "<br><label>Referrer Info </label>";
                                                    genReferrerDropdown($dbAdapter);
                                                    echo "<br><label>Operating System</label>";
                                                    genOSDropdown($dbAdapter);
                                                    ?>
                                          </div>

                                          
                                        <div >
                                          <label>Country Name</label>
                                          <input id="tags" >
                                          
                                        </div>


                             </div>
                               
                            <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--9-col">

                            
                                            <table id="table2" class="mdl-data-table mdl-js-data-table">
                                                    <thead>
                                                    <tr>
                                                      <th class="mdl-data-table__cell--non-numeric">Visit Date</th>
                                                      <th class="mdl-data-table__cell--non-numeric">Visit Time</th>
                                                      <th class="mdl-data-table__cell--non-numeric">IP</th>
                                                      <th class="mdl-data-table__cell--non-numeric">Country Names</th>
                                                      <th class="mdl-data-table__cell--non-numeric">Info</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody id="tbody2">
                                                 
                                                  </tbody>
                                                </table>
                                                 <div id="spinner2" class="mdl-spinner mdl-js-spinner is-active"></div>

                            </div> 

                        </div>

      </div>

      <!-- End of Visits Filter panel -->

      <div class="mdl-tabs__panel" id="graphs-panel">
        <div class="mdl-grid">
        <div class="mdl-card mdl-cell mdl-cell--6-col mdl-shadow--2dp" >
          <select id="area-month-list">
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
          
          <div class="mdl-card__actions">
        <div id="area_chart_div"></div>
        
        </div>
        </div>
        
        <div class="bar-chart-card mdl-card mdl-cell mdl-cell--6-col mdl-shadow--2dp">
          <select id="regions-month-list">
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
          
          <div class="mdl-card__actions">
        
        <div id="regions_div"></div>
        </div>
        </div>
    
    <div class="mdl-card mdl-cell mdl-cell--8-col mdl-shadow--2dp">
      <div class="mdl-card__actions">
      <?php topCountryDropdown($dbAdapter, "country1");
      topCountryDropdown($dbAdapter, "country2");
      topCountryDropdown($dbAdapter, "country3");?>
      <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="chart-it" disabled>
      Chart It!
      </button>
      <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="switch-it">
      Switch It!
      </button>
      </div>
      <div class="mdl-card__actions">
      <div id="bar_div"></div>
      </div>
      </div>
   </div>
        
      </div>
  </div>


  </main>
  </div>







</body>

 <script type="text/javascript">

      // Load the Visualization API and the corechart package.
     
      // Set a callback to run when the Google Visualization API is loaded.
      

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawAreaChart() {

        var xhr = new XMLHttpRequest();
        //console.log("select value: " +document.getElementById("month-list").value);
        xhr.open('GET', 'chartData.php?type=area&id=' + document.getElementById("area-month-list").value);
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
        var chart = new google.visualization.AreaChart(document.getElementById('area_chart_div'));
        chart.draw(data, options);
        };
      }
      
      function drawRegionsMap() {

        var xhr = new XMLHttpRequest();
        //console.log("select value: " +document.getElementById("month-list").value);
        xhr.open('GET', 'chartData.php?type=region&id=' + document.getElementById("regions-month-list").value);
        xhr.send(null);
    
        xhr.onload = function () {
          
        // Create the data table.
        var areaArray = JSON.parse(xhr.responseText);
        //console.log("response text: " + areaArray);
        var editArray = [["country", "hits"]];
        
        for(var i = 0; i < areaArray.length; i++)
        {
            console.log("loop #" + i + ": " + areaArray[i]);
            editArray.push([areaArray[i].CountryName, parseInt(areaArray[i].hits)]);
            
        }
        console.log("Edit array: " + editArray);
        var data = google.visualization.arrayToDataTable(editArray);

        var options = {};

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }
      }
      
      function drawBarChart(alt) {

        var xhr = new XMLHttpRequest();
        //console.log("select value: " +document.getElementById("month-list").value);
        xhr.open('GET', 'chartData.php?type=bar&id1=' + document.getElementById("country1").value + '&id2=' + document.getElementById("country2").value + '&id3=' + document.getElementById("country3").value);
        xhr.send(null);
    
        xhr.onload = function () {
          
          console.log("Response: " + xhr.responseText);
        // Create the data table.
        var dataObj = JSON.parse(xhr.responseText);
        //console.log("response text: " + areaArray);
        var editArray = "";
        if(alt == false)
        {
        editArray = [["month", dataObj.id1[0].CountryName,dataObj.id2[0].CountryName, dataObj.id3[0].CountryName]];
        
        
            editArray.push(["JAN", parseInt(dataObj.id1[0].hits), parseInt(dataObj.id2[0].hits), parseInt(dataObj.id3[0].hits)]);
            editArray.push(["MAY", parseInt(dataObj.id1[1].hits), parseInt(dataObj.id2[2].hits), parseInt(dataObj.id3[1].hits)]);
            editArray.push(["SEP", parseInt(dataObj.id1[2].hits), parseInt(dataObj.id2[2].hits), parseInt(dataObj.id3[2].hits)]);
        }
        else
        {
          editArray = [["country", "JAN", "MAY", "SEP"]];
        
        
            editArray.push([dataObj.id1[0].CountryName, parseInt(dataObj.id1[0].hits), parseInt(dataObj.id1[1].hits), parseInt(dataObj.id1[2].hits)]);
            editArray.push([dataObj.id2[0].CountryName, parseInt(dataObj.id2[0].hits), parseInt(dataObj.id2[1].hits), parseInt(dataObj.id2[2].hits)]);
            editArray.push([dataObj.id3[0].CountryName, parseInt(dataObj.id1[0].hits), parseInt(dataObj.id3[1].hits), parseInt(dataObj.id3[2].hits)]);
        }
            
            
        console.log("Edit array: " + editArray);
        
        var data = google.visualization.arrayToDataTable(editArray);

        var options = {orientation: 'vertical', legend: {position: "left"}};

        var chart = new google.charts.Bar(document.querySelector('#bar_div'));

        chart.draw(data, options);
      }
      }
      
       var google;
      google.charts.setOnLoadCallback(drawAreaChart);
      google.charts.setOnLoadCallback(drawRegionsMap);
      
    google.charts.load('current', {'packages':['corechart', 'bar']});
    console.log("charts loaded");
      
      document.getElementById("area-month-list").addEventListener("change", function(){
        drawAreaChart();
        
      });
      
      document.getElementById("regions-month-list").addEventListener("change", function(){
        drawRegionsMap();
        
      });
      
      document.getElementById("chart-it").addEventListener("click", function(){
        if(document.getElementById("country1").value != "unselected" && document.getElementById("country2").value != "unselected" && document.getElementById("country3").value != "unselected" )
        {
          drawBarChart(false);
        }
      });
      
      document.getElementById("switch-it").addEventListener("click", function(){
        if(document.getElementById("country1").value != "unselected" && document.getElementById("country2").value != "unselected" && document.getElementById("country3").value != "unselected" )
        {
          if(document.getElementById("bar_div").classList.contains("alt"))
          {
            drawBarChart(true);
             document.getElementById("bar_div").classList.remove("alt");
          }
          else
          {
            drawBarChart(false);
            document.getElementById("bar_div").classList.add("alt");
          }
         
        }
      });
      
      var nodes = document.getElementsByClassName("bar-drop");
      for(var i = 0; i < nodes.length; i++)
      {
        nodes[i].addEventListener("change", function(){
          if(document.getElementById("country1").value != "unselected" && document.getElementById("country2").value != "unselected" && document.getElementById("country3").value != "unselected" )
        {
          document.getElementById("chart-it").disabled = false;
        }
        else{
          document.getElementById("chart-it").disabled = true;
        }
        });
      }
      
      
    </script>

<script type="text/javascript" language="javascript" src="js/indexScript.js"></script>

<script type="text/javascript">
  $(document).ready(function() {


    $("#table").hide();
    $("#spinner").hide();


    $("#continents").change(function() {
      var x = $('#continents option:selected').val();
      $("#table").hide();
      $("#spinner").show();

      $.get("query.php", {
        id: x
      }, function(data, status) {
        //alert("Data: " + data + "\nStatus: " + status);

        var parent = $("#tbody");
        parent.html("");

        for (var i = 0; i < data.length; i++) {
          var tr = $("<tr></tr>");
          parent.append(tr);
          tr.attr("class", "mdl-data-table__cell--non-numeric")
          tr.html(data[i].id);

          var td = $("<td></td>");
          tr.append(td);
          td.html(data[i].num);

          // console.log(data[i].id);
          //console.log(data[i].num);
          $("#spinner").hide();
          $("#table").show(1000);

        }
      });
    });

    $('#device-Brands').change(function() {
      var y = $('#device-Brands option:selected').val();


      $('#brand').html("Visits: " + y);
    });




  });







  

  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(drawChart);

  // Callback that creates and populates a data table,
  // instantiates the pie chart, passes in the data and
  // draws it.
  function drawChart() {

    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Topping');
    data.addColumn('number', 'Slices');
    data.addRows([ <?php makeChart($result); ?> ]);

    // Set chart options
    var options = {
      'title': 'Most Used Browsers',
      'width': 400,
      'height': 400
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }



  $(function() {




    $("#tags").autocomplete({
      source: 'searchOptions.php'
    });


  });
  
  function filterTable(event, ui) {

                    $("#table2").hide();
                    $("#spinner2").show();

                  var countryVal = "null";

                  if($("#tags").val() != "")
                  {
                    countryVal = $("#tags").val();  
                  }

                    $.get("filter.php", {
                        CountryName: countryVal,
                        device_type_id: $("#device-type-dropdown").val(),
                        device_brand_id: $("#device-brand-dropdown").val(),
                        browser_id: $("#browser-dropdown").val(),
                        referrer_id: $("#referrer-dropdown").val(),
                        os_id: $("#OS-dropdown").val()
                    }, function (data, status) {
                        var parent = $("#tbody2");
                        parent.html("");
                        for (var i = 0; i < data.length; i++) {
                            var tr = $("<tr></tr>");
                            parent.append(tr);
                            tr.attr("class", "mdl-data-table__cell--non-numeric");

                            var td = $("<td></td>");
                            td.html(data[i].date);
                            tr.append(td);

                            var td1 = $("<td></td>");
                            td1.html(data[i].time);
                            tr.append(td1);

                            var td2 = $("<td></td>");
                            td2.html(data[i].ip);
                            tr.append(td2);

                            var td3 = $("<td></td>");
                            td3.html(data[i].country);
                            tr.append(td3);

                            var td4 = $("<td></td>");
                            var btn = $("<button>More</button>");
                            btn.attr("class", "mdl-button mdl-button--raised");
                            btn.attr("type", "button");
                            td4.html(btn);
                            tr.append(td4);

                            /*   // var dialog= $("<dialog></dialog>");
                               dialog.attr("class","mdl-dialog");
                               tr.append(dialog);
                               var div= $("<div></div>");
                               div.attr("class","mdl-dialog__content");
                               dialog.append(div);
                               var p= $("<p></p>");
                               p.html(" Allow this site to collect usage data to improve your experience?");
                               div.append(p);
                                var div2= $("<div></div>");
                               dialog.append(div2);
                               div2.attr("class","mdl-dialog__actions");
                                var btn2= $("<button></button>");
                                btn2.attr("class", "mdl-button close");
                                div2.append(btn2);
                                                     */







                            document.getElementById('table2').onclick = function (e) {
                                e = e || event
                                var target = e.target || e.srcElement
                                if (target.tagName == "DIV") {
                                    console.log("itsadiv");
                                }

                            };


                            $("#spinner2").hide();
                            $("#table2").show(1000);
                        }
                    });
                }
                
                document.getElementById("filter-card-dropdowns").addEventListener("change", filterTable);
  
  $(function () {

            $("#tags").autocomplete({
                source: 'searchOptions.php',
                change: filterTable
            });
        });
        
        $("#table2").hide();
  $("#spinner2").hide();
</script>
</html>
