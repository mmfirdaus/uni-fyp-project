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

.button {
  display: inline-block;
  border-radius: 4px;
  background-color: rgb(152, 166, 221);
  border: none;
  color: #000000;
  text-align: center;
  font-size: 23px;
  padding: 10px;
  width: 150px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

#buttons {
  display: inline-block;
  border-radius: 4px;
  background-color: rgb(152, 166, 221);
  border: none;
  color: #000000;
  text-align: center;
  font-size: 20px;
  padding: 5px;
  width: 100px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
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
<h1> DATA LOG PAGE </h1>
<div id="main">
<h2> ALL DATA </h2><a href="newlogpage.php"><button class="button">All Data Log</button></a>

</br></br></br></br>

<form method="post" action="searchdata.php">
<h2> SEARCH DATA ON </h2>
<input type = date name = fromdate required >
<input type = submit button id="buttons"></button>
</br></br></br></br>
</form>
--------------------------------------------------------------------------------
<form method="post" action="searchdatatime.php">
<h2> SEARCH DATA ON </h2>
<input type = date name = fromdate required >
<h2> FROM 
<input type = time name = fromtime required ></h2>
<h2> TO
<input type = time name = totime required ></h2>
<input type = submit button id="buttons"></button>
</br></br></br></br>
</form>
--------------------------------------------------------------------------------
<form method="post" action="searchfromdata.php">
<h2> SEARCH DATA </h2>
<h2> FROM  <input type = date name = fromdate required></h2>

<h2> TO <input type = date name = todate required></h2>

<input type = submit button id="buttons">
</form>


</div>
</div>
</body>
</html>





