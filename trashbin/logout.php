<?php  
ob_start();
session_start();
unset($_SESSION['ID']);
unset($_SESSION['username']);
unset($_SESSION['usertype']); 
unset($_SESSION['Firstname']);
unset($_SESSION['token']);
unset($_SESSION['Firstname']);
unset($_SESSION['Lastname']);
unset($_SESSION['Email']);
unset($_SESSION['Contact']);
unset($_SESSION['Address']);
session_destroy();
header("location:index.php");

?>