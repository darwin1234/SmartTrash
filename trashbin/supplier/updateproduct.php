<?php require_once('templates/header.php'); ?>
<?php
$query = "SELECT * FROM product WHERE ID = '".$_GET['ID']."'";
$result = $crud->getData($query);
?>

<?php 
	$message = "";
	$method = ""; //Global Variable
	if(sizeof($result) >=1){
		$method ="Update";
		if(isset($_POST['Update']))
		{
		
			$productCat								= strip_tags($_POST['productCat']);
			$productprice									= strip_tags($_POST['productprice']);
			$Description							= strip_tags($_POST['Description']);
			
			if(!empty($roomsImage)){
				$t = $crud->execute("UPDATE product SET productCat='".$productCat."' , productprice= '".$productprice."', Description = '".$Description."' WHERE ID='".$_GET['ID']."';");
				if($t == true){
						$message = "<div class='alert alert-success'><strong>Successfully Updated!</strong></div>";
				}
			}	
			else{
				$t = $crud->execute("UPDATE product SET productCat='".$productCat."' , productprice= '".$productprice."', Description = '".$Description."' WHERE ID='".$_GET['ID']."';");
				if($t == true){
						$message = "<div class='alert alert-success'><strong>Successfully Updated!</strong></div>";
				}
				
			}
			
			 header("location: updateproduct.php?ID=".$_GET['ID']);
			  $date = date('Y-m-d h:i:s');
				$result = $crud->execute("INSERT INTO logs(userID,action,time) VALUES($userID, 'updated a product','". $date ."')");	
		}
		
	}

?>

<div class="container">
	<div class="row">
		
		<form action="updateproduct.php?ID=<?php echo $_GET['ID'];?>" method="POST" enctype="multipart/form-data">
		<?php  echo $message; ?>
	
	
		 <div style="width:100%; height:50px;"></div>
		  <div class="form-group">
			<label for="productCat">productCat:</label>
			<input type="text" class="form-control" name="productCat" id="productCat" value="<?php echo $result[0]['productCat']; ?>">
		  </div>
		  <div class="form-group">
			<label for="productprice">Price:</label>
			<input type="text" class="form-control" id="productprice" name="productprice" value="<?php echo $result[0]['productprice']; ?>">
		  </div>
		  <div class="form-group">
			<label for="pwd">Detail:</label>
			<textarea class="form-control" style="height:250px;" name="Description"><?php echo $result[0]['Description']; ?></textarea>
		  </div>
		  
		  <button type="submit" name="Update" class="btn btn-default">Submit</button>
		</form>

	</div>
</div>

<?php require_once('templates/footer.php'); ?>