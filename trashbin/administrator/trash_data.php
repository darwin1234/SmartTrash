<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basurahan";


$data___ = array();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
	
	
	if((int)$_POST['type_1'] == 1){
		
		$type =  $_POST['type_1'];
		$result =$conn->query("SELECT * FROM trash WHERE deviceID=1 AND type='".$type."' ORDER BY id DESC LIMIT 1");
		if ($result->num_rows > 0) 
		{	
			$row = $result->fetch_assoc();
			$data___['Non_Biogradable_level']  =  $row['level'];

		}
	}
	
	if((int)$_POST['type_2'] == 2){
		$type =  $_POST['type_2'];
		$result =$conn->query("SELECT * FROM trash WHERE deviceID=1 AND type='".$type."' ORDER BY id DESC LIMIT 1");
		if ($result->num_rows > 0) 
		{	
			$row = $result->fetch_assoc();
			$data___['Biogradable_level']  =  $row['level'];

		}
	}
	
	if((int)$_POST['type_3'] == 3){
		$type =  $_POST['type_3'];
		$result = $conn->query("SELECT * FROM trash WHERE deviceID=1 AND type='".$type."' ORDER BY id DESC LIMIT 1");
		if ($result->num_rows > 0) 
		{	
			$row = $result->fetch_assoc();
			$data___['Recycle_level']  =  $row['level'];

		}
	}
	
	echo json_encode($data___)
	
	
	
?>