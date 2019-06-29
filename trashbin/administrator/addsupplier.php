<?php require_once('templates/header.php'); ?>
<?php 
	include_once("../includes/Crud.php");  
	$crud = new Crud();
	if(isset($_POST['submit']))
	{
	
		$username							= strip_tags($_POST['username']);
		$password							= md5(strip_tags($_POST['password']));
		$firstname							= strip_tags($_POST['firstname']);
		$lastname							= strip_tags($_POST['lastname']);
		$address							= strip_tags($_POST['address']);
		$contactno							= strip_tags($_POST['contactno']);
		$email								= strip_tags($_POST['email']);
		$CompanyName						= strip_tags($_POST['CompanyName']);		
		$result = $crud->execute("INSERT INTO `users` (`ID`, `username`, `password`, `usertype`, `firstname`, `lastname`, `address`, `contactno`, `email`,`CompanyName`) VALUES  ('', '". $username . "', '" . $password ."', 2, '". $firstname ."', '" .$lastname ."', '" . $address ."', '". $contactno . "', '". $email ."','".$CompanyName."')");
		$message = "<div class='alert alert-success'><strong>Successfully Added!</strong></div>";
	}
	
	
?>

<div class="wrapper">
    <div class="wrapperform"> 
	<form id="dsform"method="POST" action="addsupplier.php" >
				
				<?php echo @$message?>
			
				
						<!--Company Name--> 	
                        <label class="control-label" for="name-input-field" >Company Name </label>
						<input class="form-control" required="" type="text" name="CompanyName">
						<!--First Name-->
                        <label class="control-label" for="name-input-field" >Supplier FirstName</label>
                        <input class="form-control" required="" type="text" name="firstname">
						<!--Last Name-->
                        <label class="control-label" for="name-input-field" >Supplier Last Name</label>
                        <input class="form-control" required="" type="text" name="lastname">
						<!--Contact Number-->
                        <label class="control-label" required="" for="name-input-field" >Contact Number</label>                   
                        <input class="form-control" type="text" name="contactno">
						<!--Email Add. -->
                        <label class="control-label" for="name-input-field" >Email Address</label>                
                        <input class="form-control" required="" type="text" name="email">
						<!--Address-->
                        <label class="control-label" for="email-input-field">Address</label>
                        <input class="form-control" required="" type="text" name="address">
						<!--Username-->
                        <label class="control-label" for="email-input-field">Username</label>                 
                        <input class="form-control" required="" type="text" name="username">
						<!-- Password-->
						<label class="control-label" for="ClientImage">Password</label>
						<input class="form-control" required="" type="password" name="password">
                
			
			
			
					 <button class="button2" type="submit" name="submit">Add Supplier</button>

    </form>


</div>
</div>

<?php require_once('templates/footer.php'); ?>
