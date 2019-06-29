<?php require_once('templates/header.php'); ?>
<style>
.wrapper{width:100%;}
/*.wrapper .trashcan{display:inline-block; width:300px; height:500px;  margin:0 20px 0 20px; border:1px solid #ccc;}
.wrapper .trashcan .level6{height:70px; width:100%; /*background:green;*/ margin-bottom:2px;}
.wrapper .trashcan .level5{height:70px; width:100%; /*background:green;*/ margin-bottom:2px;}
.wrapper .trashcan .level4{height:70px; width:100%; /*background:green;*/ margin-bottom:2px;}
.wrapper .trashcan .level3{height:70px; width:100%; /*background:green;*/ margin-bottom:2px;}
.wrapper .trashcan .level2{height:70px; width:100%; /*background:green;*/ margin-bottom:2px;}
.wrapper .trashcan .level1{height:70px; width:100%; /*background:green;*/ margin-bottom:2px;}
.wrapper .trashcan h2{text-align:center; padding:5px 0 5px 0; margin:0; border-bottom:1px solid #ccc;}*/
.trashwrapper{width:80%; margin:80px auto;}
h1.device_name{text-align:left; }
#trashbins{clear:both; width: 95%; overflow:auto; margin:0; }
#trashbins .trashcan{width:31%; display:inline-block; /*border:1px solid #ccc;*/ padding:10px;}
#trashbins .trashcan h4{font-weight:bold; text-align:left; text-transform: capitalize; display:block;}
#trashbins .trashcan h4 span{font-size:14px; color:red;  font-weight:normal; }
#trashbins .trashcan a{text-align:right; display:block; text-decoration:none; color:#000; text-transform: capitalize; }
</style>

<div class="wrapper" id="trashbins">

</div>


<!--<div class="wrapper">

	<div class="trashwrapper">
	<h1 class="device_name">Device Name</h1>
		<div class="trashcan">
		<h2>Non Biogradable</h2>
			<div id="level6_nB" class="level6">Level 6</div>
			<div id="level5_nB" class="level5">Level 5</div>
			<div id="level4_nB" class="level4">Level 4</div>
			<div id="level3_nB" class="level3">Level 3</div>
			<div id="level2_nB" class="level2">Level 2</div>
			<div id="level1_nB" class="level1">Level 1</div>
		</div>
		<div class="trashcan">
		<h2>Biogradable</h2>
			<div id="level6_B" class="level6">Level 6</div>
			<div id="level5_B" class="level5">Level 5</div>
			<div id="level4_B" class="level4">Level 4</div>
			<div id="level3_B" class="level3">Level 3</div>
			<div id="level2_B" class="level2">Level 2</div>
			<div id="level1_B" class="level1">Level 1</div>
		</div>
		<div class="trashcan">
		<h2>Recycle</h2>
			<div id="level6_R" class="level6">Level 6</div>
			<div id="level5_R" class="level5">Level 5</div>
			<div id="level4_R" class="level4">Level 4</div>
			<div id="level3_R" class="level3">Level 3</div>
			<div id="level2_R" class="level2">Level 2</div>
			<div id="level1_R" class="level1">Level 1</div>
		</div>
	</div>	
</div>
<script>

setInterval(function(){

 var xhttp = new XMLHttpRequest();
 /** NON Biogradable **/
 var level1_nB = document.getElementById("level1_nB"); 
 var level2_nB = document.getElementById("level2_nB"); 
 var level3_nB = document.getElementById("level3_nB");
 var level4_nB = document.getElementById("level4_nB"); 
 var level5_nB = document.getElementById("level5_nB");
 var level6_nB = document.getElementById("level6_nB");
 
 /**Biogradable **/
 
 var level1_B = document.getElementById("level1_B"); 
 var level2_B = document.getElementById("level2_B"); 
 var level3_B = document.getElementById("level3_B");
 var level4_B = document.getElementById("level4_B"); 
 var level5_B = document.getElementById("level5_B");
 var level6_B = document.getElementById("level6_B");
 
 /**Recycle **/
 var level1_R = document.getElementById("level1_R"); 
 var level2_R = document.getElementById("level2_R"); 
 var level3_R = document.getElementById("level3_R");
 var level4_R = document.getElementById("level4_R"); 
 var level5_R = document.getElementById("level5_R");
 var level6_R = document.getElementById("level6_R");
 
 var LevelValue = 0;
 var result, HTML = "";

 
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) 
	{
		LevelValue =  this.responseText;
       
	     
	     result = this.responseText;
	     result = JSON.parse(result);
		 
		 console.log(result); //DEBUGGER
		
		
		if(result.Non_Biogradable_level <= 30){
			level1_nB.style.backgroundColor="red";
			level2_nB.style.backgroundColor="yellow";
			level3_nB.style.backgroundColor="gray";
			level4_nB.style.backgroundColor="green";
			level5_nB.style.backgroundColor="pink";
			level6_nB.style.backgroundColor="violet";
		} 
			
			
		if(result.Biogradable_level <= 30){
			level1_B.style.backgroundColor="red";
			level2_B.style.backgroundColor="yellow";
			level3_B.style.backgroundColor="gray";
			level4_B.style.backgroundColor="green";
			level5_B.style.backgroundColor="pink";
			level6_B.style.backgroundColor="violet";
		} 
		
			
		if(result.Recycle_level <= 500){
			level1_R.style.backgroundColor="red";
			//level2_R.style.backgroundColor="yellow";
			//level3_R.style.backgroundColor="gray";
			//level4_R.style.backgroundColor="green";
			//level5_R.style.backgroundColor="pink";
			//level6_R.style.backgroundColor="violet";
		} 
		
	  
	}
  };
  xhttp.open("POST", "http://192.168.254.100/trashbin/fetch.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("type_1=1&type_2=2&type_3=3");

}, 4000);
 
</script>-->

<?php require_once('templates/footer.php'); ?>