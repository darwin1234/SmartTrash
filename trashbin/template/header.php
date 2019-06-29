<?php require_once("utils/utilities.php");?>
<?php  $baseurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
<head>
	<link rel="stylesheet" href="template/header.css"> 	
	<title>Techie Product</title>	
</head>


<body>
  <header>	<!-- This is the start of the navigation bar for users who visits the website-->
        <div  style="background:#8b9dc3; overflow:auto;">		
           
              <h2><a href="index.php"><img src="images/logo.jpg" href="index.php" style="width:180px; "></a></h2>
               
    
                        <?php if(!isset($_SESSION['username']) && !isset($_SESSION['ID'] )){ ?>
							<ul class="navright">
								<li><a href="Login.php">LOG IN</a></li>			
							</ul>
							
						<?php } else{ ?>
							<?php if($_SESSION['usertype'] == 1) { ?>
							<ul class="navright">
								<li role="presentation"><a href="administrator/index.php">Dashboard</a></li>
								<li role="presentation"><a href="logout.php">Logout</a></li>								
							</ul>
							<?php } ?>
							
							
							<?php if($_SESSION['usertype'] == 2) { ?>
							<ul class="navright">
								<li role="presentation"><a href="supplier/index.php">Account</a></li>	
								<li role="presentation"><a href="javascript:void();" onclick="logout()">Logout</a></li>									
							</ul>
							<?php } ?>
						<?php } ?>
                    </li>
                </ul>
            					<!-- End of the dropdown buttons-->
        </div>
   </header>
		