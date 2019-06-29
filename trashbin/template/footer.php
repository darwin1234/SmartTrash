
<footer id="footer"></footer>
<script type="text/javascript">

var result, HTML = "";
xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
	   result = this.responseText;
	   result = JSON.parse(result);
	  
	   for(var i=0; i < result.length; i++){
			HTML +=  "<div class='ProductData'>";
			HTML +=  "<h3>" + result[i].HotelName + "</h3>";
			HTML +=  "<a href='#'>View Product</a>";
			HTML +=  "</div>";
			
	   }	
	
	}else{
		
		 //document.getElementById("productList").innerHTML = "<h2 style='text-align:center;'>Cannot load Product Server Error!</h2>";
	}
	document.getElementById("productList").innerHTML= HTML;
 };
  xhttp.open("POST", "<?php echo $baseurl;?>/lists.php", true);
  xhttp.send();
  

</script>
<script>
	var xhttp = new XMLHttpRequest();
				
	function logout(){		
			var r = confirm("Do you want to logout?");
			if (r == true) {
				window.location ="logout.php";
			} else {
		}			
	}
</script>
</body>
</html>

