<?php require_once('connection.php'); ?>
<?php require_once('template/header.php'); ?>

<div class="container" style="overflow:auto;">
	<?php  $res = mysqli_query($mysqli, "SELECT * FROM hotels LEFT JOIN rating ON hotels.ID = rating.HotelID");  ?>
	
		 <table class="table">
			<thead>
			  <tr>
				<th><h2>Hotel Name</h2></th>
			
			  </tr>
			</thead>
			<tbody>
			<?php  while( $row = mysqli_fetch_assoc($res)){ ?>
			 <tr>
				
				<td>
					
					<h3>
						
						
						<a href="HotelInfo.php?ID=<?php echo $row['ID']; ?>"><?php echo $row['HotelName'];?></a></h3>
					  

							<?php  
								if($row['Ratings'] > 0){
									
									$noRating =  5 - $row['Ratings'] ;
									for($i = 0; $i<$row['Ratings']; $i++){
										
											
											echo '<div class="rating" style="background:yellow; height:20px; width:20px; float:left; margin:5px; border:1px solid #ccc;"> </div>';	
							
								
									}
									for($x = 0; $x<$noRating ; $x++){
										
										echo '<div class="rating" style="height:20px; width:20px; float:left; margin:5px; border:1px solid #ccc;"> </div>';
									}
										
								}else{
								
									
									for($i=0; $i<5; $i++){
										
										echo '<div class="rating" style="height:20px; width:20px; float:left; margin:5px; border:1px solid #ccc;"> </div>';
									}
								}
							?> 
							
							</p>		
								
				</td>

				 
				</tr>
			<?php } ?>
			</tbody>
		</table>
</div>
<?php require_once('template/footer.php');?>