<?php

$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "childmonitor";
$conn = new mysqli($servername, $username, $password,$dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<html>
<head>
<?php
 $dates = "SELECT  CURRENT_DATE() AS DATE;";
 $aidcon1 = mysqli_query($conn, $dates);
 while ($row = mysqli_fetch_array($aidcon1))
		{
			$curdate = $row['DATE'];
		}

 $simp = "SELECT * FROM monitoring WHERE date_time BETWEEN '$curdate 00:00:00' AND '$curdate 23:59:59'";
		$aidcon = mysqli_query($conn, $simp);
		$jk = 0;
		
		while ($row = mysqli_fetch_array($aidcon))
		{
			$datetime[] = $row['date_time'];
			$temp[] = $row['temperature'];
			$cod[] = $row['co_density'];
				$jk++;
		}
foreach ($datetime as $x => $y) {
	
	$dataPoints[] = array("y" => $temp[$x],"label"=> $y ); 
	$dataPoints2[] = array("y" => $cod[$x],"label"=> $y ); 
}
 

?>

<style>
.button {
  display: inline-block;
  border-radius: 4px;
  background-color: rgb(152, 166, 221);
  border: none;
  color: #000000;
  text-align: center;
  font-size: 25px;
  padding: 10px;
  width: 200px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}
</style>
<script>
window.onload = function () {
 
var chart1 = new CanvasJS.Chart("chartContainer1", {
	backgroundColor: "rgba(235, 242, 247,0.9)",
	title: {
		text: "Temperature Data Graph"
	},
	axisY: {
		title: "Temperature (°C)"
	},
	data: [{
		markerColor: "red",
		type: "area",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart1.render();
var chart2 = new CanvasJS.Chart("chartContainer2", {
	backgroundColor: "rgba(235, 242, 247,0.9)",
	title: {
		text: "CO Density Data Graph"
	},
	axisY: {
		title: "CO Density (%)"
	},
	data: [{
		markerColor: "red",
		type: "area",
		dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
	}]
});

chart2.render();
 
}
</script>
   
<script>            
setTimeout(function(){location.href="index.php"} , 600000);         
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
	  google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['°C', <?php 		$sql= "SELECT temperature FROM monitoring ORDER BY monitor_id DESC LIMIT 1";
								$con = mysqli_query($conn, $sql);
								$row = mysqli_fetch_assoc($con);
								$temper = $row['temperature'];
								echo $temper; ?>],
								
		  ['CO%', <?php 		$sql3= "SELECT co_density FROM monitoring ORDER BY monitor_id DESC LIMIT 1";
								$con3 = mysqli_query($conn, $sql3);
								$row3 = mysqli_fetch_assoc($con3);
								$de = $row3['co_density'];
								echo $de; ?>],					
        ]);

        var options = {
          width: 1600, height: 480,
          redFrom: 50, redTo: 70,
          yellowFrom:40, yellowTo: 50,
          minorTicks: 10, majorTicks: [0,10,20,30,40,50,60,70],
		  max:70
        };
		
        var chart = new google.visualization.Gauge(document.getElementById('chart_div2'));

        chart.draw(data, options);
	  }
		
    </script>

<link rel="stylesheet" type="text/css" href="tempcss.css">
<title>CHILD MONITORING</title>
</head>
<body>
<div id="wrapper">
<div id="header">
<h1>IOT BASED CHILD MONITORING SYSTEM IN VEHICLE</h1>
<h4> Megat Muhammad Firdaus Bin Sahrir<br> 
	B031710325
</h4>
</div>

<div id="navigation">
<ul>
<li><a href="index.php">MAIN PAGE</a></li>
<li><a href="contact.php">EMERGENCY CONTACT</a></li>
</ul>
</div>

<div id="content-container">
<h1> MONITORING PAGE </h1><a href="logpage.php"><button class="button" style="vertical-align:middle">DATA LOG</button></a>
<div id="main">

<table style="width:100%;">
  <tr>
    <th><h1>TEMPERATURE</h1></th>
    <th><h1>&nbsp &nbsp CO DENSITY</h1></th>
  </tr>
</table>

<div id="chart_div2" align="center" ></div>

<?php
 $simp = "SELECT * FROM `monitoring` ORDER BY `monitoring`.`monitor_id` DESC limit 1";
		$aidcon1 = mysqli_query($conn, $simp);
		
		
		while ($row1 = mysqli_fetch_array($aidcon1))
		{
			 $datetime = $row1['date_time'];
			 $temp = $row1['temperature'];
			 $cod = $row1['co_density'];

		}
?>

<h1 id="demo"></h1><br>

<script>
var today = new Date();
var time = "CURRENT TIME = "+ today.getHours() + ":" + today.getMinutes();
document.getElementById("demo").innerHTML = time;
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<div id="chartContainer1" style="width: 100%; height: 400px;display: inline-block;" ></div></br></br>
<div id="chartContainer2" style="width: 100%; height: 400px;display: inline-block;"></div>


</div>
</div>
</body>
</html>





