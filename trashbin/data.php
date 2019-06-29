<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basurahan";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO trash (id, status, level,type,DeviceID)
VALUES ('', '0', '". @$_GET['level']."', '".(int)@$_GET['type']."','".(int)@$_GET['deviceID']."')";
$data_arr = array();
$count = 0;
if ($conn->query($sql) === TRUE) {
	
	
} else {
   // echo "Error: " . $sql . "<br>" . $conn->error;
}

//echo "asdasdasd";
$conn->close();

