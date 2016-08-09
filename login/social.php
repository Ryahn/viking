<?php
include('includes/api.php');
include('head.php');

if(getSetting("disable_login", "text") != "true" && getSetting("disable_register", "text") != "true") {
if(is_logged_in()) {
	$on_login = explode("|||", getTypeUrl("on_login"));
	if($on_login[0]) {
		header('Location: '. $on_login[1]);
		exit;
	} else {
		echo $on_login[1];
	}
} else {
?>

<div class='container'>
	<noscript>
		<div class='alert alert-danger' role='alert'><?php echo $m['enable_javascript']; ?></div>
	</noscript>
</div>

<div class='container-small'>
	<div class='row row-1 light-dark-top'>
		<h2 class='text-center'><?php echo $m['social_register_title']; ?></h2>
		<div id='social_response'><h5 class='text-center'><?php echo $m['social_register_info']; ?></h5></div>
	</div>
	
	<?php
	// Check if login is set
	if(!empty($_GET['login'])) {
		// Check if login method is google
		if($_GET['login'] == "google" && getSetting("enable_google", "text") == "true") {
			$client = google(); // Initialize Google
			
			$authUrl = $client->createAuthUrl(); // Create login URL
			
			header('Location: '. $authUrl); // Redirect to login URL
		}
		
		
		
		// Check if login method is facebook
		if($_GET['login'] == "facebook" && getSetting("enable_facebook", "text") == "true") {
			$facebook = facebook(); // Initialize Facebook
			
			$returnurl = getTypeUrl("facebook_callback"); // Create callback URL
			
			$params = array("redirect_uri" => $returnurl,
			"scope" => "public_profile, email");
			
			header('Location: '. $facebook->getLoginUrl($params)); // Request login URL and redirect to it
		}
		
		
		
		// Check if login method is twitter
		if($_GET['login'] == "twitter" && getSetting("enable_twitter", "text") == "true") {
			unset($_SESSION['oauth_token']); // Remove old oauth_token session, just to make sure it won't use them
			unset($_SESSION['oauth_token_secret']); // Same
			
			$twitter = twitter(); // Initialize Twitter
			
			$callback = getTypeUrl("twitter_callback"); // Create callback URL
			
			$request_token = $twitter->oauth('oauth/request_token', array('oauth_callback' => $callback)); // Request request token
			$_SESSION['oauth_token'] = $request_token['oauth_token']; // Save oauth_token in session, for callback
			$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret']; // Same
			
			try {
				$url = $twitter->url('oauth/authenticate', array('oauth_token' => $request_token['oauth_token'])); // Request login URL
				
				header('Location: '. $url); // Redirect to login URL
			} catch(Abraham\TwitterOAuth\TwitterOAuthException $e) { // Something went wrong
				?>
				<div class='col-sm-12'>
					<div class='alert alert-danger' role='alert'><?php echo $m['social_error']; ?></div>
				</div>
				<?php
			}
		}
	}
	
	
	
	
	
	// Check if return is set
	if(!empty($_GET['return'])) {
		// Check if it is a callback from Google
		if($_GET['return'] == "google" && getSetting("enable_google", "text") == "true") {
			if(!empty($_GET['code'])) { // Check if the code is set
				$client = google(); // Initialize Google
				
				$objOAuthService = new Google_Service_Oauth2($client); // Set OAuth object
				
				try {
					$client->authenticate($_GET['code']); // Authenticate the given code
					$_SESSION['access_token'] = $client->getAccessToken(); // Save access token in session
					$client->setAccessToken($_SESSION['access_token']); // Set access token
					
					$userData = $objOAuthService->userinfo->get(); // Get user info from access token
					
					if(!empty($userData)) { // Check if user info is given
						$sid = mysqli_real_escape_string($con,$userData->id);
						$_SESSION['sid'] = $sid; // Save social ID to session
						$usercheck = mysqli_query($con,"SELECT * FROM login_users WHERE type='google' AND sid='$sid'");
						if(mysqli_num_rows($usercheck) > 0) { // Check if user exists
							$login = explode("|||", socialLogin($sid, "google")); // Login
							if($login[0]) {
								header('Location: '. $login[1]);
								exit;
							} else {
								echo "<div class='col-sm-12'>". $login[1] ."</div>";
							}
						} else { // Show registration form
							?>
							<form method='post' id='social_register'>	
								<div class='row'>
									<div class='col-md-12'>
										<div class='form-group'>
											<label class='col-sm-4 control-label'><?php echo $m['username']; ?>*</label>
											<div class='col-sm-8'>
												<input type='text' class='form-control' name='username'>
											</div>
										</div>
										
										<?php
										// Check if the email is found, normally it should be found
										if(empty($userData->email)) {
										?>
										<br><br>
										
										<div class='form-group'>
											<label class='col-sm-4 control-label'><?php echo $m['email']; ?>*</label>
											<div class='col-sm-8'>
												<input type='email' class='form-control' name='email'>
											</div>
										</div>
										<?php
										} else {
										?>
										<input type='hidden' name='email' value='<?php echo $userData->email; ?>'>
										<?php
										}
										?>
										
										<br><br>
										
										<?php
										// Get the extra inputs, empty
										getExtraInputs();
										?>
										
										<?php
										// Check for multiple payment gateways
										if(getSetting("enable_paypal", "text") == "true" && getSetting("enable_stripe", "text") == "true") {
										?>
										<div class='row row-6'>
											<div class='form-group'>
												<label class='col-sm-4 control-label'><?php echo $m['payment_method']; ?>*</label>
												<div class='col-sm-8'>
													<div class='radio'>
														<label>
															<input type='radio' name='pay_method' value='Paypal' checked> <img src='<?php echo $script_path; ?>assets/images/paypal.png' width='100px' height='26px'>
														</label>
													</div>
													<div class='radio'>
														<label>
															<input type='radio' name='pay_method' value='Stripe'> <img src='<?php echo $script_path; ?>assets/images/stripe_logo.png' width='100px' height='34px'>
														</label>
													</div>
												</div>
											</div>
										</div>
										<?php
										}
										?>
									</div>
								</div>
								
								<div class='row light-dark-bottom'>
									<div class='form-group special-form-group text-center'>
										<div class='row'>
											<input type='hidden' name='type' value='google'>
											<input type='hidden' name='token' value='<?php echo md5(session_id()); ?>'>
											<input type='submit' name='register' value='<?php echo $m['register']; ?>' id='social_register_button' class='btn btn-primary btn-large'>
										</div>
									</div>
								</div>
							</form>
							<?php
						}
					} else {
						?>
						<div class='col-sm-12'>
							<div class='alert alert-danger' role='alert'><?php echo $m['social_error']; ?></div>
						</div>
						<?php
					}
				} catch(Google_Auth_Exception $e) {
					?>
					<div class='col-sm-12'>
						<div class='alert alert-danger' role='alert'><?php echo $m['social_error']; ?></div>
					</div>
					<?php
				}
			} else {
				header('Location: '. $script_path .'login.php');
			}
		}
		
		
		
		// Check if it is a callback from Facebook
		if($_GET['return'] == "facebook" && getSetting("enable_facebook", "text") == "true") {
			$facebook = facebook(); // Initialize Facebook
			
			$sid = mysqli_real_escape_string($con,$facebook->getUser());
			$logged_in = false;
			if($sid) {
				try {
					$me = $facebook->api('/me');
					if($me) { // Check if login is successful
						$logged_in = true;
					}
				} catch(FacebookApiException $e) {
					$logged_in = false;
				}
			}
			
			if($logged_in) { // Check if user is logged in at Facebook
				$_SESSION['fb_access_token'] = $facebook->getAccessToken(); // Save access token to session
				$_SESSION['sid'] = $sid; // Save social ID to session
				
				$usercheck = mysqli_query($con,"SELECT * FROM login_users WHERE type='facebook' AND sid='$sid'");
				if(mysqli_num_rows($usercheck) > 0) { // Check if user exists
					$login = explode("|||", socialLogin($sid, "facebook")); // Login
					if($login[0]) {
						header('Location: '. $login[1]);
						exit;
					} else {
						echo "<div class='col-sm-12'>". $login[1] ."</div>";
					}
				} else {
					$info = $facebook->api('/me'); // Retrieve user info
					?>
					<form method='post' id='social_register'>	
						<div class='row'>
							<div class='col-md-12'>
								<div class='form-group'>
									<label class='col-sm-4 control-label'><?php echo $m['username']; ?>*</label>
									<div class='col-sm-8'>
										<input type='text' class='form-control' name='username'>
									</div>
								</div>
								
								<?php
								// Check if the email is found, normally it should be found
								if(empty($info['email'])) {
								?>
								<br><br>
								
								<div class='form-group'>
									<label class='col-sm-4 control-label'><?php echo $m['email']; ?>*</label>
									<div class='col-sm-8'>
										<input type='email' class='form-control' name='email'>
									</div>
								</div>
								<?php
								} else {
								?>
								<input type='hidden' name='email' value='<?php echo $info['email']; ?>'>
								<?php
								}
								?>
								
								<br><br>
								
								<?php
								// Get the extra inputs, empty
								getExtraInputs();
								?>
								
								<?php
								// Check for multiple payment gateways
								if(getSetting("enable_paypal", "text") == "true" && getSetting("enable_stripe", "text") == "true") {
								?>
								<div class='row row-6'>
									<div class='form-group'>
										<label class='col-sm-4 control-label'><?php echo $m['payment_method']; ?>*</label>
										<div class='col-sm-8'>
											<div class='radio'>
												<label>
													<input type='radio' name='pay_method' value='Paypal' checked> <img src='<?php echo $script_path; ?>assets/images/paypal.png' width='100px' height='26px'>
												</label>
											</div>
											<div class='radio'>
												<label>
													<input type='radio' name='pay_method' value='Stripe'> <img src='<?php echo $script_path; ?>assets/images/stripe_logo.png' width='100px' height='34px'>
												</label>
											</div>
										</div>
									</div>
								</div>
								<?php
								}
								?>
							</div>
						</div>
						
						<div class='row light-dark-bottom'>
							<div class='form-group special-form-group text-center'>
								<div class='row'>
									<input type='hidden' name='type' value='facebook'>
									<input type='hidden' name='token' value='<?php echo md5(session_id()); ?>'>
									<input type='submit' name='register' value='<?php echo $m['register']; ?>' id='social_register_button' class='btn btn-primary btn-large'>
								</div>
							</div>
						</div>
					</form>
					<?php
				}
			} else {
				header('Location: '. $script_path .'login.php');
			}
		}
		
		
		
		// Check if it is a callback from Twitter
		if($_GET['return'] == "twitter" && getSetting("enable_twitter", "text") == "true") {
			if(!empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret']) && !empty($_GET['oauth_verifier'])) {
				$twitter = twitter(); // Initialize Twitter
				
				try {
					$access_token = $twitter->oauth("oauth/access_token", array("oauth_verifier" => $_GET['oauth_verifier'])); // Change OAuth verifier with access code
					$_SESSION['twitter_token'] = $access_token['oauth_token']; // Save new OAuth token
					$_SESSION['twitter_token_secret'] = $access_token['oauth_token_secret']; // Same
					unset($_SESSION['oauth_token']); // Remove old OAuth token
					unset($_SESSION['oauth_token_secret']); // Same
					
					$twitter = twitter(); // Initialize Twitter again with the new OAuth token
					
					$get = $twitter->get("account/verify_credentials"); // Retrieve user info
					$get = (array) $get;
					$sid = $get['id'];
					$_SESSION['sid'] = $sid; // Save social ID to session
					
					$usercheck = mysqli_query($con,"SELECT * FROM login_users WHERE type='twitter' AND sid='$sid'");
					if(mysqli_num_rows($usercheck) > 0) { // Check if user exists
						$login = explode("|||", socialLogin($sid, "twitter")); // Login
						if($login[0]) {
							header('Location: '. $login[1]);
							exit;
						} else {
							echo "<div class='col-sm-12'>". $login[1] ."</div>";
						}
					} else { // Show registration form
					?>
					<form method='post' id='social_register'>	
						<div class='row'>
							<div class='col-md-12'>
								<div class='form-group'>
									<label class='col-sm-4 control-label'><?php echo $m['username']; ?>*</label>
									<div class='col-sm-8'>
										<input type='text' class='form-control' name='username'>
									</div>
								</div>
								
								<br><br>
								
								<div class='form-group'>
									<label class='col-sm-4 control-label'><?php echo $m['email']; ?>*</label>
									<div class='col-sm-8'>
										<input type='email' class='form-control' name='email'>
									</div>
								</div>
								
								<br><br>
								
								<?php
								// Get the extra inputs, empty
								getExtraInputs();
								?>
								
								<?php
								// Check for multiple payment gateways
								if(getSetting("enable_paypal", "text") == "true" && getSetting("enable_stripe", "text") == "true") {
								?>
								<div class='row row-6'>
									<div class='form-group'>
										<label class='col-sm-4 control-label'><?php echo $m['payment_method']; ?>*</label>
										<div class='col-sm-8'>
											<div class='radio'>
												<label>
													<input type='radio' name='pay_method' value='Paypal' checked> <img src='<?php echo $script_path; ?>assets/images/paypal.png' width='100px' height='26px'>
												</label>
											</div>
											<div class='radio'>
												<label>
													<input type='radio' name='pay_method' value='Stripe'> <img src='<?php echo $script_path; ?>assets/images/stripe_logo.png' width='100px' height='34px'>
												</label>
											</div>
										</div>
									</div>
								</div>
								<?php
								}
								?>
							</div>
						</div>
						
						<div class='row light-dark-bottom'>
							<div class='form-group special-form-group text-center'>
								<div class='row'>
									<input type='hidden' name='type' value='twitter'>
									<input type='hidden' name='token' value='<?php echo md5(session_id()); ?>'>
									<input type='submit' name='register' value='<?php echo $m['register']; ?>' id='social_register_button' class='btn btn-primary btn-large'>
								</div>
							</div>
						</div>
					</form>
					<?php
					}
				} catch(Abraham\TwitterOAuth\TwitterOAuthException $e) {
					?>
					<div class='col-sm-12'>
						<div class='alert alert-danger' role='alert'><?php echo $m['social_error']; ?></div>
					</div>
					<?php
				}
			} else {
				header('Location: '. $script_path .'login.php');
			}
		}
	}
	?>
</div>

<?php
}
}

include('footer.php');
?>