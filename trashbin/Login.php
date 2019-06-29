<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Techie Product</title>
    <link rel="stylesheet" href="template/style.css">

	</head>

<body>
<?php 
session_start();

require_once('connection.php');
if(isset($_POST['login'])){
		
		$username = strip_tags($_POST['username']);
		$password = strip_tags($_POST['password']);
		$res = mysqli_query($mysqli, "SELECT count(id) as total, ID,username,password,usertype,firstname,lastname,contactno,email,address,CompanyName FROM users WHERE username='".$username."' AND password='".md5($password)."'"); 
		$row = mysqli_fetch_assoc($res);
		if($row['usertype']==1){
				$_SESSION['username']			 	= $row['username'];
				$_SESSION['ID'] 				 	= $row['ID'];
				$_SESSION['usertype'] 				= $row['usertype'];
				$_SESSION['token']					=	md5('abcdefghijklmnopqrstuvwxyz123456789');
				$_SESSION['Firstname']				= $row['firstname'];
				$_SESSION['Lastname']				= $row['lastname'];
				$_SESSION['Email']					= $row['email'];
				$_SESSION['Contact']				= $row['contactno'];
				$_SESSION['Address']				= $row['address'];
				//header("location:admin.php");
				header("location:administrator/index.php");
		}

		if($row['usertype']==2){
				$_SESSION['username']			 	= $row['username'];
				$_SESSION['ID'] 				 	= $row['ID'];
				$_SESSION['usertype'] 				= $row['usertype'];
				$_SESSION['token']					= md5('abcdefghijklmnopqrstuvwxyz123456789');
				$_SESSION['Firstname']				= $row['firstname'];
				$_SESSION['Lastname']				= $row['lastname'];
				$_SESSION['Email']					= $row['email'];
				$_SESSION['Contact']				= $row['contactno'];
				$_SESSION['Address']				= $row['address'];
				$_SESSION['CompanyName']				= $row['CompanyName'];
		
				header("location: supplier/index.php");
		}
	
				
}
?>
<?php if(!isset($_SESSION['username']) && !isset($_SESSION['ID'] )){ ?>

	<div class="login">
				<a href="index.php"><img src="images/logo.jpg" style="width:250px; margin:10px auto; display:block; "></a>
					<form action="Login.php" method="POST" >
				
					<label for="email">Username:</label>
					<input type="text" name="username" placeholder="Email address" required="" class="form-control" id="email">				 
					<label for="pwd">Password:</label>
					<input type="password" name="password" placeholder="Password" required="" class="form-control" id="pwd">
				 <br>				  
				  <input type="submit" name="login" class="buttonlogin"  value="Login"><br><br>				 
					<!--<a href="forgotpassword.php" class="button" ><label>Forgot Password</label></a>!-->
				</form>
	</div>
<?php } else{
	if($_SESSION['usertype']  == 1){
	header("location:administrator/index.php");
	}
	
	if($_SESSION['usertype']  == 2){
	header("location:supplier/index.php");
	}

}?>	
 
</body>
</html>
