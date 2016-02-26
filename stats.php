<?php
require_once('lib/helpers/visits-setup.inc.php');
$visitArray = array();
$visitArray = array();
$countryArray = array();
$viewsArray = array();
$country1Array = array();
$country2Array = array();
$country3Array = array();

function outputLineChart()
{
	$year = date('y');
	$dayCount = 01;
	$visitCount = 0;
	$arrayCount = 0;
	try
	{
		if ( isset($_GET['months']) ) 
		{
		$months = $_GET['months'];
		}
		else
		{
		$months = 01;
		}
		
		$pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$sql = '
				SELECT visit_date
				FROM visits
				WHERE visit_date
				BETWEEN "'.$year.'-'.$months.'-01%"
				AND "'.$year.'-'.$months.'-31%"
				ORDER BY visit_date
				';
				$result = $pdo->query($sql);
				while($row = $result->fetch()) 
				{
					$visitDate = substr($row['visit_date'], 8, 2);
					
					if($visitDate == $dayCount)
					{
						$visitCount++;
					}
					else
					{
						$visitArray[$arrayCount] = $visitCount;
						$visitCount = 1;
						$dayCount++;
						$arrayCount++;
					}
				}
				return $visitArray;
	}
	catch (PDOException $e) 
	{
      die( $e->getMessage() );
    }
}




function outputCountry1Visits()
{
	try
	{
	if ( isset($_GET['country1']) ) 
		{
			$country1 = $_GET['country1'];
			$pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql1 = 'SELECT count(visit_date) as views, CountryName 
			FROM visits
			INNER JOIN countries
			ON country_code = fipsCountryCode
			WHERE CountryName ="'.$country1.'"
			AND visit_date
			BETWEEN "2016-01-01%"
			AND "2016-01-31%"';
			
			$sql2 = 'SELECT count(visit_date) as views, CountryName 
			FROM visits
			INNER JOIN countries
			ON country_code = fipsCountryCode
			WHERE CountryName ="'.$country1.'"
			AND visit_date
			BETWEEN "2016-05-01%"
			AND "2016-05-31%"';
			
			$sql3 = 'SELECT count(visit_date) as views, CountryName 
			FROM visits
			INNER JOIN countries
			ON country_code = fipsCountryCode
			WHERE CountryName ="'.$country1.'"
			AND visit_date
			BETWEEN "2016-09-01%"
			AND "2016-09-31%"';
			$result1 = $pdo->query($sql1);
			$result2 = $pdo->query($sql2);
			$result3 = $pdo->query($sql3);
			
			$row1 = $result1->fetch();
			$row2 = $result2->fetch();
			$row3 = $result3->fetch();
			
			$country1Array[0] = $row1['CountryName'];
			$country1Array[1] = $row1['views'];
			$country1Array[2] = $row2['views'];
			$country1Array[3] = $row3['views'];
			
			return $country1Array;
		}
		}
	catch (PDOException $e) 
	{
      die( $e->getMessage() );
    }
}

function outputCountry2Visits()
{
	try
	{
	if ( isset($_GET['country2']) ) 
		{
			$country2 = $_GET['country2'];
			$pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql1 = 'SELECT count(visit_date) as views, CountryName 
			FROM visits
			INNER JOIN countries
			ON country_code = fipsCountryCode
			WHERE CountryName ="'.$country2.'"
			AND visit_date
			BETWEEN "2016-01-01%"
			AND "2016-01-31%"';
			
			$sql2 = 'SELECT count(visit_date) as views, CountryName 
			FROM visits
			INNER JOIN countries
			ON country_code = fipsCountryCode
			WHERE CountryName ="'.$country2.'"
			AND visit_date
			BETWEEN "2016-05-01%"
			AND "2016-05-31%"';
			
			$sql3 = 'SELECT count(visit_date) as views, CountryName 
			FROM visits
			INNER JOIN countries
			ON country_code = fipsCountryCode
			WHERE CountryName ="'.$country2.'"
			AND visit_date
			BETWEEN "2016-09-01%"
			AND "2016-09-31%"';
			$result1 = $pdo->query($sql1);
			$result2 = $pdo->query($sql2);
			$result3 = $pdo->query($sql3);
			
			$row1 = $result1->fetch();
			$row2 = $result2->fetch();
			$row3 = $result3->fetch();
			
			$country2Array[0] = $row1['CountryName'];
			$country2Array[1] = $row1['views'];
			$country2Array[2] = $row2['views'];
			$country2Array[3] = $row3['views'];
			
			return $country2Array;
		}
		}
	catch (PDOException $e) 
	{
      die( $e->getMessage() );
    }
}

function outputCountry3Visits()
{
	try
	{
	if ( isset($_GET['country3']) ) 
		{
			$country3 = $_GET['country3'];
			$pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql1 = 'SELECT count(visit_date) as views, CountryName 
			FROM visits
			INNER JOIN countries
			ON country_code = fipsCountryCode
			WHERE CountryName ="'.$country3.'"
			AND visit_date
			BETWEEN "2016-01-01%"
			AND "2016-01-31%"';
			
			$sql2 = 'SELECT count(visit_date) as views, CountryName 
			FROM visits
			INNER JOIN countries
			ON country_code = fipsCountryCode
			WHERE CountryName ="'.$country3.'"
			AND visit_date
			BETWEEN "2016-05-01%"
			AND "2016-05-31%"';
			
			$sql3 = 'SELECT count(visit_date) as views, CountryName 
			FROM visits
			INNER JOIN countries
			ON country_code = fipsCountryCode
			WHERE countryName ="'.$country3.'"
			AND visit_date
			BETWEEN "2016-09-01%"
			AND "2016-09-31%"';
			$result1 = $pdo->query($sql1);
			$result2 = $pdo->query($sql2);
			$result3 = $pdo->query($sql3);
			
			$row1 = $result1->fetch();
			$row2 = $result2->fetch();
			$row3 = $result3->fetch();
			
			$country3Array[0] = $row1['CountryName'];
			$country3Array[1] = $row1['views'];
			$country3Array[2] = $row2['views'];
			$country3Array[3] = $row3['views'];
			
			return $country3Array;
		}
		}
	catch (PDOException $e) 
	{
      die( $e->getMessage() );
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
   <title>Travel Template</title>
   
 <script language="javascript" type="text/javascript" 
        src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js">
    </script>
    <!-- Load Google JSAPI -->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
	google.load("visualization", "1", { packages: ["corechart", "geochart"] });
        google.setOnLoadCallback(drawChart);

    function drawChart() {
      // Define the chart to be drawn.
      var data1 = new google.visualization.DataTable();
      data1.addColumn('number', 'Day');
      data1.addColumn('number', 'VisitsPerDay');
	  
	  




	
	// this is for the bar chart with the year as the row
      var data3 = google.visualization.arrayToDataTable([
	  <?php
	  $country1Array = outputCountry1Visits();
	  $country2Array = outputCountry2Visits();
	  $country3Array = outputCountry3Visits();
			echo "['Year', '".$country1Array[0]."', '".$country2Array[0]."', '".$country3Array[0]."'],";
          echo "['Jan', ".$country1Array[1].", ".$country1Array[2].", ".$country1Array[3]."],";
          echo "['May', ".$country2Array[1].", ".$country2Array[2].", ".$country2Array[3]."],";
          echo "['Sept', ".$country3Array[1].", ".$country3Array[2].", ".$country3Array[3]."],";
        echo "]);";
		
	  ?>
	  
          

	  var options3 = {
		  title: 'Site Visits 2016',
        hAxis: {
          title: 'Year'
        },
        vAxis: {
          title: 'Visits Per Year'
        }
	  };
      // Instantiate and draw the chart.
      var chart3 = new google.visualization.ColumnChart(document.getElementById('myBarChart'));
      chart3.draw(data3, options3);
	  
	  //this is for the bar chart with the country as the row
	  var data4 = google.visualization.arrayToDataTable([
	  <?php
	  $country1Array = outputCountry1Visits();
	  $country2Array = outputCountry2Visits();
	  $country3Array = outputCountry3Visits();
			echo "['Country', 'Jan', 'May', 'Sept'],";
          echo "['".$country1Array[0]."', ".$country1Array[1].", ".$country1Array[2].", ".$country1Array[3]."],";
          echo "['".$country2Array[0]."', ".$country2Array[1].", ".$country2Array[2].", ".$country1Array[3]."],";
          echo "['".$country3Array[0]."', ".$country3Array[1].", ".$country3Array[2].", ".$country1Array[3]."],";
        echo "]);";
		
	  ?>
	  
          

	  var options4 = {
		  title: 'Site Visits 2014-2016',
        hAxis: {
          title: 'Country'
        },
        vAxis: {
          title: 'Visits Per Year'
        }
	  };
      // Instantiate and draw the chart.
      var chart4 = new google.visualization.ColumnChart(document.getElementById('myBarChart2'));
      chart4.draw(data4, options3);
	  
	}
		</script>
		</head>
<body>

<?php include 'includes/travel-header.inc.php'; ?>
   
<div class="container">  <!-- start main content container -->
   <div class="row">  <!-- start main content row -->
      <div class="col-md-3">  <!-- start left navigation rail column -->
      </div>  <!-- end left navigation rail --> 
	  	  <form class="form-inline" role="form" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <div class="form-group" >
                <select class="form-control" name="line_months" id="month_name">
                 <option value="0">Months</option>
				 <option value="01">January</option>
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
              </div><button id="submitLineChart" type="submit" class="btn btn-primary" >Area Chart</button>
	  <div id="myLineChart"></div>
 <br>			  
			  <form class="form-inline" role="form" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <div class="form-group" >
                <select class="form-control" name="area_months" id="month_name">
                 <option value="0">Months</option>
				 <option value="01">January</option>
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
              </div><button id="submitAreaChart" type="submit" class="btn btn-primary" >Geo Chart</button>
		</form>
<div id="myGeoChart"></div>
<br>	
		<form class="form-inline" role="form" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <div class="form-group" >
                <select class="form-control" name="country1">
                  <option value="0">Country</option>
                       <?php
					   echo outputPopularCountries();
					   ?>
                  
                </select>
              </div>
              <div class="form-group">
                <select class="form-control" name="country2">
                  <option value="ZZZ">Country</option>
                              <?php
					   echo outputPopularCountries();
					   ?>
                </select>
              </div> 
			   <div class="form-group">
                <select class="form-control" name="country3">
                  <option value="ZZZ">Country</option>
                              <?php
					   echo outputPopularCountries();
					   ?>
                </select>
              </div> 			  
              <button id="submitbutton" type="submit" class="btn btn-primary" >Chart It</button>
            </form>      
<div id="myBarChart"></div>

<form class="form-inline" role="form" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<button onclick="myFunction()">Switch</button>
</form>
<script>
function myFunction() {
    var p = document.getElementById("myBarChart");
	
	p.id = "myBarChart2";
	
	
// Run on page load
    window.onload = function myFunction() {

        // If sessionStorage is storing default values (ex. name), exit the function and do not restore data
        if (sessionStorage.getItem('country1') == "country1") {
            return;
        }

        // If values are not blank, restore them to the fields
        var country1 = sessionStorage.getItem('country1');
        if (country1 !== null) $('#country1').val(country1);

        var country2 = sessionStorage.getItem('country2');
        if (country2 !== null) $('#country2').val(country2);

        var country3= sessionStorage.getItem('country3');
        if (country3 !== null) $('#country1').val(country3);

    }

    // Before refreshing the page, save the form data to sessionStorage
    window.onbeforeunload = function() {
        sessionStorage.setItem("country1", $('#country1').val());
        sessionStorage.setItem("country2", $('#country2').val());
        sessionStorage.setItem("country3", $('#country3').val());
    }

}			
</script>
         </div>
	  </div>  <!-- end main content column -->
   </div>  <!-- end main content row -->
</div>   <!-- end main content container -->
   
   

<?php include 'includes/travel-footer.inc.php'; ?>   

   
   
 <!-- Bootstrap core JavaScript
 ================================================== -->
 <!-- Placed at the end of the document so the pages load faster -->
 <script src="bootstrap3_travelTheme/assets/js/jquery.js"></script>
 <script src="bootstrap3_travelTheme/dist/js/bootstrap.min.js"></script>
 <script src="bootstrap3_travelTheme/assets/js/holder.js"></script>
</body>
</html>