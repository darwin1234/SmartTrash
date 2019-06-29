<?php require_once('templates/header.php'); ?>
<?php 
	include_once("../includes/Crud.php");  
	$crud = new Crud();
	if(isset($_POST['submit']))
	{
	
		
		$productname						= strip_tags($_POST['productname']);
		$productCat						= strip_tags($_POST['productCat']);
		$Description					= strip_tags($_POST['Description']);
		$productprice							= strip_tags($_POST['productprice']);

		$result = $crud->execute("INSERT INTO `product` (`ID`, `userID`,`productname`, `productCat`, `Description`, `productprice`,`CompanyName`) VALUES  ('','".$_SESSION['ID']."','".$productname."','". $productCat ."', '" .$Description ."','".$productprice."','".$_SESSION['CompanyName']."')");
		$message = "<div class='alert alert-success'><strong>Successfully Added!</strong></div>";
		$date = date('Y-m-d h:i:s');
		$result = $crud->execute("INSERT INTO logs(userID,action,time) VALUES($userID, 'added a product','". $date ."')");	
	}
	
	
?>

<div class="wrapper">
    <div class="wrapperform"> 
	<form method="POST" action="addproduct.php" >
				
				<?php echo @$message?>

						<!--Product Name--> 	
                        <label class="control-label" for="name-input-field" >Product Name </label>
						<input class="form-control" required="" type="text" name="productname">
						<!--First Name-->
                        <label class="control-label" for="name-input-field" >Product Type</label>
                        <input class="form-control" required="" type="text" name="productCat">
						<!--Last Name-->
                        <label class="control-label" for="name-input-field" >Description</label>
                        <input class="form-control" required="" type="text" name="Description">
						<!--Contact Number-->
                        <label class="control-label" required="" for="name-input-field" >Price</label>                   
                        <input class="form-control" type="text" name="productprice">
						
                
				<br><br><hr>
			
			
					 <button class="btn btn button2" type="submit" name="submit">Add Product</button>

    </form>


</div>
</div>

<?php require_once('templates/footer.php'); ?>
