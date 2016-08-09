<?php
define('BEGIN', dirname(__FILE__));

if(!function_exists('logged_in')) {
	require(BEGIN .'/../includes/api.php');
}
if(!isset($con)) {
	require(BEGIN .'/../config.php');
}
if(!isset($titles)) {
	require(BEGIN .'/../lang/'. $language .'.php');
}
if(!function_exists('getSetting')) {
	require(BEGIN .'/../includes/functions.php');
}

@session_set_cookie_params(0, '/', getCurrentDomain()); 
@session_start();


// Check if paypal posted the custom value back
if(!empty($_POST['custom'])) {
	// Assign the posted value to variables and escape it for mysql
	$amount = mysqli_real_escape_string($con,$_POST['mc_gross']);
	$currency = mysqli_real_escape_string($con,$_POST['mc_currency']);
	$txn_id = mysqli_real_escape_string($con,$_POST['txn_id']);
	$receiver = mysqli_real_escape_string($con,$_POST['receiver_email']);
	$payer = mysqli_real_escape_string($con,$_POST['payer_email']);
	$custom = mysqli_real_escape_string($con,$_POST['custom']);
	
	
	// Check if txn_id already exists
	$txn_check = mysqli_query($con,"SELECT * FROM login_payments WHERE txn_id='$txn_id'");
	if(mysqli_num_rows($txn_check) == 0) {
		$txn_id_valid = true;
	} else {
		$txn_id_valid = false;
	}
	
	// Check if activate_code exists
	$custom_check = mysqli_query($con,"SELECT * FROM login_users WHERE activate_code='$custom'");
	if(mysqli_num_rows($custom_check) == 1) {
		$custom_valid = true;
	} else {
		$custom_valid = false;
	}
	
	
	// Check if both checks are true
	if($txn_id_valid == true && $custom_valid == true) {
		$u = mysqli_fetch_array($custom_check);
		$uid = $u['id'];
		$time = time();
		
		
		$raw_post_data = file_get_contents("php://input");
		$raw_post_array = explode("&", $raw_post_data);
		$post = array();
		foreach($raw_post_array as $keyval) {
			$keyval = explode ("=", $keyval);
			if (count($keyval) == 2) {
				$post[$keyval[0]] = urldecode($keyval[1]);
			}
		}
		
		$req = "cmd=_notify-validate";
		foreach($post as $key => $value) {
			if(function_exists("get_magic_quotes_gpc") && get_magic_quotes_gpc() == 1) {
				$value = urlencode(stripslashes($value));
			} else {
				$value = urlencode($value);
			}
			$req .= "&". $key ."=". $value;
		}
		
		$ch = curl_init("https://www.sandbox.paypal.com/cgi-bin/webscr");
		
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
		
		$res = curl_exec($ch);
		
		
		if($res == "VERIFIED") {
			// Insert payment in MySQL
			mysqli_query($con,"INSERT INTO login_payments(uid, time, amount, currency, payer, receiver, txn_id)
			VALUES ('$uid','$time','$amount','$currency','$payer','$receiver','$txn_id')");
			
			if(getSetting("activation", "text") == "1") {
				// Send activation mail if email validation is enabled
				$val_url = getTypeUrl("activation") . $custom;
				
				$subject = getSetting("validation_mail_subject", "text");
				$subject = str_replace("{val_url}", $val_url, $subject);
				$subject = str_replace("{name}", $u['username'], $subject);
				$subject = str_replace("{email}", $u['email'], $subject);
				$subject = str_replace("{date}", date("j-n-Y", $u['registered_on']), $subject);
				
				$message = getSetting("validation_mail", "text");
				$message = str_replace("{val_url}", $val_url, $message);
				$message = str_replace("{name}", $u['username'], $message);
				$message = str_replace("{email}", $u['email'], $message);
				$message = str_replace("{date}", date("j-n-Y", $u['registered_on']), $message);
				$message = nl2br($message);
				$message = html_entity_decode($message);
				
				// Send mail through PHPMailer
				sendMail($u['email'], $subject, $message, $uid);
				
				// Update user to remove paypal link
				mysqli_query($con,"UPDATE login_users SET paypal='' WHERE id='$uid'");
			} else {
				// Update user to remove paypal link and activate it
				mysqli_query($con,"UPDATE login_users SET paypal='', active='1' WHERE id='$uid'");
			}
		}
		
		curl_close($ch);
	}
}
?>