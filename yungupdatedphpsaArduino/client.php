
                <?php
                   
		    @$level_Bio;
		    @$level_NonBio;
		    @$level_Recy;

		    @$link = mysqli_connect("localhost", "root", "", "trashbin");
 

		    if($link === false){
    		    die("ERROR: Could not connect. " . mysqli_connect_error());
		    }

                    if(isset($_GET['type'])){
                        @$type = $_GET['type'];
               

                        if ($type == 1){
                           @$level_Bio = $_GET['level'];

                        }
                        if ($type == 2){
                            @$level_NonBio = $_GET['level'];
                            
                        }
                        if ($type == 3){
                            @$level_Recy = $_GET['level'];
                            
                        }

			@$sql = "INSERT INTO trash (Bio, Non_Bio, Recy) VALUES ('$level_Bio', '$level_NonBio', '$level_Recy')";
				if(mysqli_query($link, $sql)){
 					   echo "successfully.";
				} else{
			  		  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
 
                    }

		
				mysqli_close($link);			
                ?>
               