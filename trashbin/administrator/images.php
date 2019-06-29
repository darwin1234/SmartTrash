<?php 

include_once("../includes/Crud.php");
$crud = new Crud();
$query ="SELECT * FROM hotels WHERE ID ='".$_GET['id']."'";
$result = $crud->getData($query);

//echo var_dump($result);

?>