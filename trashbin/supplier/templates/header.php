<?php 

session_start(); 
$_SESSION['username'];
$_SESSION['ID'] ;
$_SESSION['usertype'];
$_SESSION['Firstname'];
$_SESSION['Lastname'];
$_SESSION['Email'];
$_SESSION['Contact'];
$_SESSION['Address'];
$CompanyName = $_SESSION['CompanyName'];
include_once("../includes/Crud.php");
$crud = new Crud();

if(empty($_SESSION['ID'])){
	header("location:../index.php");
}	
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Techie Product</title>
	<link rel="stylesheet" href="templates/header.css">
	<link rel="stylesheet" href="templates/form.css">
<script>
		function logout(){
			
		
			var r = confirm("Do you want to logout?");
			if (r == true) {
				window.location ="../logout.php";
			} else {
				
			}			
						
		}
	</script>
</head>

<body>
<header><!-- This is the start of the navigation bar for users who visits the website-->
         <div  style="background:#8b9dc3; overflow:auto;">		
           
              <h2><a href="index.php"><img src="../images/logo.jpg" href="index.php" style="width:180px; margin-top:12px; margin-left:5px;"></a></h2>
                  
					<ul class="navright"> 
					<li><a href="index.php">Product List</a></li>
					<li><a href="addproduct.php"> Add Product</a></li>
					<li><a href="logs.php"> Logs</a></li>
					<li><a href="javascript:void();" onclick="logout()">Logout</a></li>
                </ul>
            </div>
 
</header><br>
  <center> <h1><?php echo $CompanyName;?></h1></center>
   
	<br>