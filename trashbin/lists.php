<?php
include_once("includes/Crud.php");
$crud = new Crud();
$query = "SELECT * FROM users WHERE usertype='2'";
$result = $crud->getData($query);

?>
<div class="row">
			<?php foreach ($result as $key => $row) { ?>
					
					<div class="container">  					
                            <center><h1><?php echo ($row['CompanyName']);?></h1>
                            <p>supplier name:<?php echo ($row['firstname']);?> </p>					
                            <a href="CompanyInfo.php?ID=<?php echo $row['ID']; ?>" >View Products </a></center>
                    </div>
                
			<?php } ?>
</div>
