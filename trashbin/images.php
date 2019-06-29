<?php 
include_once("includes/Crud.php");
$crud = new Crud();
$query ="SELECT * FROM hotels WHERE ID ='".$_GET['ID']."'";
$result = $crud->getData($query);
//echo var_dump($result);
echo $result[0]['HotelLogo'];