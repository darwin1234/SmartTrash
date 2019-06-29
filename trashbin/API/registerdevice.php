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
$dName = @$_GET['dName'];

$sql = "INSERT INTO devices (id, DeviceName) VALUES ('', '".$dName."')";
$data_arr = array();
$count = 0;
if ($conn->query($sql) === TRUE) {
	//echo "ADDED SUCCESSFULLY";
	$sqlSelect = "SELECT * FROM devices WHERE id='".$conn->insert_id."'";
	//mysqli_insert_id
	$result = $conn->query($sqlSelect);
	$row = $result->fetch_assoc();
	echo json_encode($row);
	
} else {
   // echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();

