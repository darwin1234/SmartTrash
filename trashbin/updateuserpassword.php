<?php 

session_start();
include_once("includes/Crud.php");  
$crud = new Crud();
$_SESSION['emailtoken'];
$newpassword	= md5($_POST['newpassword']);
$t = $crud->execute("UPDATE users SET password = '".$newpassword."' WHERE Token = '".$_SESSION['emailtoken'] ."'");