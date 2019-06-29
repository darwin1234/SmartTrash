<?php 
include_once("../includes/Crud.php");
$crud = new Crud();		
$query = "SELECT * FROM devices";
$result = $crud->getData($query);
echo json_encode($result); 
die();
?>
		