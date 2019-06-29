<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
require_once('template/header.php'); 
$mail = new PHPMailer(true);   
?>
<?php 
	include_once("includes/Crud.php");  
	$crud = new Crud();
?>
	
	
  <?php if(isset($_GET['hash'])) { ?>
		<?php if(@$hash_data  == $_GET['hash']) {  ?>
		<form action="forgotpassword.php" method="POST">
			<label for="newpassword">New Password</label>
			<input type="password" name="new_password" class="form-control" value="">
			<label for="newpassword">Retype Password</label>
			<input type="password" name="retype_password" class="form-control" value="">
			<input type="submit" name="change_password" class="btn btn-default" value="Change Password">
		</form>	
		<?php } ?>
  <?php } else{?>
	
	 
		<div class="container" style="margin-top:80px;">
			
				
				
						<div class="forgotpassword">
							
								<div class="text-center">
								  <h3><i class="fa fa-lock fa-4x"></i></h3>
								  <h2 class="text-center">Forgot Password?</h2>
								  <p>You can reset your password here.</p>
									<div class="panel-body">
									  <?php 
										if(isset($_POST['Retrieve'])){
											$email = $_POST["email"];
											$emailcheck = "SELECT * FROM users WHERE email = '" . $email . "'";
											$emailcheck = $crud->getData($emailcheck);	
											$counter = 0;	
												if(count($emailcheck) == 1){
														
													
														try{
															$counter++;
															if($counter == 1){
																$token =  md5(rand(5,10)); 					 					// Generate token
																$tttt = $token; 
																$t = $crud->execute("UPDATE users SET Token = '".$token ."' WHERE email = '".$email ."'");
																//create token
																//Server settings
																$mail->SMTPDebug = 2;                                 // Enable verbose debug output
																$mail->isSMTP();                                      // Set mailer to use SMTP
																$mail->Host = 'smtp.sendgrid.net';  // Specify main and backup SMTP servers
																$mail->SMTPAuth = true;                               // Enable SMTP authentication
																$mail->Username = 'grabhotel';                 // SMTP username
																$mail->Password = 'donmock123';                           // SMTP password
																$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
																$mail->Port = 587;                                    // TCP port to connect to

																//Recipients
																$mail->setFrom('help@grabhotel.com', 'Mailer');
																$mail->addAddress($email, 'Joe User');     // Add a recipient

																//Attachments
															   // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
															   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

																//Content
																$mail->isHTML(true);                                  // Set email format to HTML
																$mail->Subject = 'Password Retrieved';
																$mail->Body    = 'Please click the link:   ' .  "<a href='#'>" ."http://$_SERVER[HTTP_HOST]/grabhotel/" . "changepassword.php?hash=$tttt" . "</a>";
																$mail->send();
																echo 'Message has been sent';
																
															}
															
															
														} catch (Exception $e) {
															echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
														}
												}else{
												
															$response = "<h5>Email not exist</h5>";
											
													}
										  
										  
											}else{
												
												$response = "<h5>Email not exist</h5>";
											
											}
										
									  ?>
									  <form class="form" action="forgotpassword.php" method="POST">
										<p><?php echo @$response; ?></p>
										<fieldset>
										  <div class="form-group">
											<div class="input-group">
											  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
											  
											 <input type="email" class="form-control" id="email" name="email" required="" placeholder="Enter email">
											</div>
										  </div>
										  <div class="form-group">
											<input class="btn btn-lg btn-primary btn-block"  name="Retrieve" value="Retrieve My Password" type="submit">
										  </div>
										</fieldset>
									  </form>								  															
								</div>
							</div>
						</div>
					</div>
 
  
  <?php } ?>

<?php require_once('template/footer.php'); ?>