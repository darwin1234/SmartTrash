<?php 

include_once("../includes/Crud.php");  
$crud = new Crud();
$t = $crud->execute("UPDATE users SET Status = '" . $_GET['t'] ."'  WHERE ID = '". $_GET['id'] ."'");
 if($t == true){
 header("location: index.php");
 }
	
	