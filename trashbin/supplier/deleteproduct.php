<?php 
include_once("../includes/Crud.php");
$crud = new Crud();
$result = $crud->delete($_GET['ID'],'product');
$date = date('Y-m-d h:i:s');
		$result = $crud->execute("INSERT INTO logs(userID,action,time) VALUES($userID, 'deleted a product','". $date ."')");	
 header("location: index.php");

