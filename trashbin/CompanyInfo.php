<?php require_once('connection.php'); ?>
<?php require_once('template/header.php');?>


<?php  $res = mysqli_query($mysqli, "SELECT * FROM product WHERE ID="  .$_GET['ID']);  ?>
<?php  $row = mysqli_fetch_assoc($res); ?>
	
			
<div>			
    <div class="row">
	<center><h1><?php 	echo $row['CompanyName'];?></h1></center>
	<?php  $product = mysqli_query($mysqli, "SELECT * FROM product WHERE ID='".$_GET['ID']."'");
					
					while($productData = mysqli_fetch_assoc($product)){
					echo "<center>";	
					echo "<div class='container'>";
					echo "<h4>Product name: " .$productData['productname']. " </h4>";
					echo "<h4>Product type: " .$productData['productCat']. " </h4>";
					echo "<p>Price: " .$productData['productprice']. "</p>";
					echo "</div>";
					echo "</center>";
				}		 
		 ?>	
		 
	</div>
</div>
<?php require_once('template/footer.php');?>