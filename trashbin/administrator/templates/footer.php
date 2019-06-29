
<script>

	var result, HTML = "";
	var xhttp = new XMLHttpRequest();
	var ID = [];
	var DS__ = {
		'a': [1,2,3],
		init: function(){
			DS__.Ajax();
			DS__.AjaxOpen(DS__.a);
			setTimeout(function(){  DS__.fillTrashCan(); }, 500);
			
		},
		Ajax: function(){
			xhttp.onreadystatechange = function() 
			{
				if (this.readyState == 4 && this.status == 200)
				{
					//console.log(this.responseText);
					result = this.responseText;
					result = JSON.parse(result);
					 for(var i=0; i < result.length; i++)
					 {
						HTML +=  "<div class='trashcan'>";
						ID[i] =  result[i].id;
						HTML +=  "<h4>Trashcan Name: <span>"+ result[i].DeviceName +"</span></h4>";
						HTML +=  "<canvas id='myCanvas_" + result[i].id +"' width='400' height='200' style='border:1px solid #000000;'></canvas>";
						
						HTML +=  "<a href='trash.php?id='"+ result[i].id +">view</a>";
						HTML +=  "</div>";
					   
					}
					document.getElementById("trashbins").innerHTML = HTML;
				}else{
					//console.log("not working!");
				}
	
			};
			
		},
		AjaxOpen(URL){
			console.log(URL[0]);
			xhttp.open("POST", "http://192.168.254.100/trashbin/administrator/lists.php", true);
			xhttp.send();	
		},
		fillTrashCan(){
			 ID.forEach(function(id) {
				 console.log(id);
				 var c = document.getElementById("myCanvas_" + id);
				 var ctx = c.getContext("2d");
				 
				 /**NON BIOGRADLE**/
				 ctx.rect(10, 20, 110, 160);
				 ctx.font = "21px Arial";
				 ctx.fillText("10%", 50, 110);
				 ctx.fillStyle = "#4285F4";
				 ctx.fillRect(10, 170, 110, 10);
				  
				 /**BIOGRADLE**/
				 ctx.rect(140, 20, 110, 160);
				 ctx.font = "21px Arial";
				 ctx.fillText("15%", 180, 110);
				 ctx.fillStyle = "#34A853";
				 ctx.fillRect(140, 170, 110, 10);
				 /**RECYCLE**/
				 ctx.rect(270, 20, 110, 160);
				 ctx.font = "21px Arial";
				 ctx.fillText("25%", 310, 110);
				 ctx.fillStyle = "#34A853";
				 ctx.fillStyle = "#FBBC05";
				 ctx.fillRect(270, 170, 110, 10);
				 ctx.stroke();
			});
		}
		
		
	}
	DS__.init();

	 
	
	 
	 
	 function drawTrashCan(){
		
		
			 

	 }
	
	

 </script>

</body>

</html>
