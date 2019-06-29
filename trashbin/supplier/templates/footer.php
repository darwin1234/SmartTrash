
	
	<script>
	var j = jQuery.noConflict();
	j(function(){
		var autosearch ={	
				autosearch: function(){
						j("#autosearch").on('submit',function(){
							
							alert(1);
			
						});
				},
				search: function(){
						j("#search").on("change", function(){
							
							alert(2);
		
						});
							
				}
		}
		//alert(1);
		autosearch.autosearch();
	});
	</script>

    
</body>

</html>
