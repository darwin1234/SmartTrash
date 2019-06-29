<?php require_once('templates/header.php'); ?>
<?php
$query = "SELECT * FROM users WHERE ID = '".$_GET['ID']."'";
$result = $crud->getData($query);
?>

<?php 
	$message = "";
	$method = ""; //Global Variable
	if(sizeof($result) >=1){
		$method ="Update";
		if(isset($_POST['Update']))
		{
		
			$CompanyName								= strip_tags($_POST['CompanyName']);
			$contacno									= strip_tags($_POST['contacno']);
			$address									= strip_tags($_POST['address']);

			
			
			
				$t = $crud->execute("UPDATE users SET CompanyName='".$CompanyName."' , contacno= '".$contacno."', address = '".$address."' WHERE ID='".$_GET['ID']."';");
				if($t == true){
						$message = "<div class='alert alert-success'><strong>Successfully Updated!</strong></div>";
				}
				
			
		}
			 header("location: index.php?ID=".$_GET['ID']);
		}
		
	

?>

<div class="container">
	<div class="row">
		
		<form action="hotelprofile.php?ID=<?php echo $_GET['ID'];?>" method="POST" enctype="multipart/form-data">
		<?php  echo $message; ?>
	
	
		 <div style="width:100%; height:50px;"></div>
		  <div class="form-group">
			<label for="CompanyName">CompanyName:</label>
			<input type="text" class="form-control" name="CompanyName" id="CompanyName" value="<?php echo $result[0]['CompanyName']; ?>">
		  </div>
		  <div class="form-group">
			<label for="contacno">contacno:</label>
			<input type="number" class="form-control" id="contacno" name="contacno" value="<?php echo $result[0]['contacno']; ?>">
		  </div>
		  <div class="form-group">
			 <div class="form-group">
			<label for="address">address:</label>
			<input type="text" class="form-control" name="address" id="address" value="<?php echo $result[0]['address']; ?>">
		  </div>
		  
		  <button type="submit" name="Update" class="btn btn-default">Submit</button>
		</form>

	</div>
</div>

<?php require_once('templates/footer.php'); ?>