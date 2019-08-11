<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
$username =  strip_tags(@$_POST['username']);
$password =  strip_tags(md5(@$_POST['password']));

$mysqli = new mysqli("localhost", "root", "", "trashbin");


if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

if($result = $mysqli->query("SELECT * FROM users where username='".$username."' AND password='".$password."'")) {
	
	$data = json_encode($result->fetch_assoc());
	
}else{
	$data = 0; //not registered
}


echo $data;

$mysqli->close();