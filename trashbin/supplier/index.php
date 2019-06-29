<?php require_once('templates/header.php'); ?>

	<?php 
	$query = "SELECT * FROM product WHERE ID=ID" ;
	$result = $crud->getData($query);

    ?>
	
	
		 <table class="table table-striped">
			
			  <tr>
				<th>Product Name</th>
				<th>Product Category</th>
				<th>Description</th>
				<th>Price</th>
				
				<th>Action</th>
			  </tr>
			
		    <?php foreach ($result as $key => $row) { ?>
			 <tr >
				
				<td><?php echo $row['productname'];?></td>
				<td><?php echo $row['productCat'];?></td>
				<td><?php echo $row['Description'];?></td>
				<td>₱ <?php echo number_format($row['productprice']);?></td>
				<td>
				  <a  " href="updateproduct.php?ID=<?php echo $row['ID'];?>">Update</a>
				  <a  " href="deleteproduct.php?ID=<?php echo $row['ID'];?>">Delete</a>   
				</td>		 
				</tr>
			<?php } ?>

		</table>

	
	
	<?php require_once('templates/footer.php'); ?>