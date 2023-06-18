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
<h2>DATA FROM <?php echo $_POST["fromdate"];?> TO <?php echo $_POST["todate"];?> </h2>

</form>
<?php
		$fromdate= $_POST["fromdate"];
		$todate= $_POST["todate"];
		
	    $simp = "SELECT * FROM monitoring WHERE date_time BETWEEN '$fromdate 00:00:00' AND '$todate 23:59:59'";
		$aidcon = mysqli_query($conn, $simp);
		
		$simp1 = "SELECT DATE_FORMAT(date_time, '%M %d %Y') AS DATE FROM monitoring WHERE date_time BETWEEN '$fromdate 00:00:00' AND '$todate 23:59:59';";
		$aidcon1 = mysqli_query($conn, $simp1);
		
		$simp2 = "SELECT TIME_FORMAT(date_time, '%H:%i:%s %p') AS TIME FROM monitoring WHERE date_time BETWEEN '$fromdate 00:00:00' AND '$todate 23:59:59';";
		$aidcon2 = mysqli_query($conn, $simp2);
		
		$i = 0;
		while ($row = mysqli_fetch_array($aidcon1))
		{
			$date[] = $row['DATE'];
				$i++;
		}
		
		$j = 0;
		while ($row = mysqli_fetch_array($aidcon2))
		{
			$time[] = $row['TIME'];
				$j++;
		}
		
		$jk = 0;
		echo "<TABLE>";
		echo "<TABLE border='1'>";
		echo "<TR><TD>";
		echo "NUMBER";
		echo "</TD><TD>";
		echo "DATE";
		echo "</TD><TD>";
		echo "TIME";
		echo "</TD><TD>";
		echo "TEMPERATURE";
		echo "</TD><TD>";
		echo "CO VOLT";
		echo "</TD><TD>";
		echo "CO DENSITY";
		
		while ($row = mysqli_fetch_array($aidcon))
		{
			$id[] = $row['monitor_id'];
			
			$datetime[] = $row['date_time'];

			
			$temp[] = $row['temperature'];
			
			$cov[] = $row['co_volt']; 
			
			$cod[] = $row['co_density']; 
			
				echo "<TR><TD>";
				echo $id[$jk];
				echo "</TD><TD>";
				echo $date[$jk];
				echo "</TD><TD>";
				echo $time[$jk];
				echo "</TD><TD>";
				echo $temp[$jk];
				echo "</TD><TD>";
				echo $cov[$jk];
				echo "</TD><TD>";
				echo $cod[$jk];
				
				$jk++;
		}
		echo "</TABLE>";
		echo "<br>";	
				

			
		
?>
</div>
</div>
</body>
</html>





