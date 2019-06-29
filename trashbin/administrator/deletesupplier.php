<?php 
include_once("../includes/Crud.php");
$crud = new Crud();
$result = $crud->delete($_GET['ID'],'users');
$result = $crud->delete($_GET['hotelID'],'hotels');
 header("location: index.php");
//echo var_dump($result);
