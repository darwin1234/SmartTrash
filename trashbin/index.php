<?php 
	session_start();
	 @$_SESSION['username'];
	 @$_SESSION['ID'];
	 @$_SESSION['usertype'];
?>
<?php 
	if(@$_SESSION['usertype']==1){
		header("location:administrator/index.php");

	}else if(@$_SESSION['usertype']==3){
		header("location:profile/index.php");
	}
	
?>
   <?php require_once('template/header.php'); ?>
    <div>
	<?php require_once('lists.php');?>

	</div>
   
<script type="text/javascript" src="js/autocomplete.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClQwnk_NG4x6ezaiWpAEJrR1PfZTkQq-s&libraries=places&callback=initAutocomplete" async defer></script>
<?php require_once('template/footer.php');?>