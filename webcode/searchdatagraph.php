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
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: center;
  font-weight: bold;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: #4CAF50;
  color: white;
}
</style>
<?php
 $fromdate= $_POST["fromdate"];
 

 $simp = "SELECT * FROM monitoring WHERE date_time BETWEEN '$fromdate 00:00:00' AND '$fromdate 23:59:59'";
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

<div id="main">
<h2>GRAPH ON <?php echo $fromdate;?></h2>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<div id="chartContainer1" style="width: 100%; height: 400px;display: inline-block;" ></div></br></br>
<div id="chartContainer2" style="width: 100%; height: 400px;display: inline-block;"></div>	


</div>
</div>
</body>
</html>





