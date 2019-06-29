<?php 	
session_start();
$token = $_GET['hash'];
include_once("includes/Crud.php");  
$crud = new Crud();
$_SESSION['emailtoken'] = $token;

$checkuser = "SELECT * FROM users WHERE Token = '" . $token . "'";
$checkuser = $crud->getData($checkuser);

if(count($checkuser)>0)	{
	
	?>
		<form action="updateuserpassword.php" method="post">
			
			<input type="text" name="newpassword">
			<input type="submit" name="changepassword">
			
		</form>
	
	<?php
	
}else{
		header("location:login.php");
}