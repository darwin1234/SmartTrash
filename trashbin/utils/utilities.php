<?php
function limitText($string, $limit){
		
	// strip tags to avoid breaking any html
	$string = strip_tags($string);
	if (strlen($string) > $limit) {
		// truncate string
		$stringCut = substr($string, 0, $limit);
		// make sure it ends in a word so assassinate doesn't become ass...
		$string = substr($stringCut, 0, strrpos($stringCut, ' ')); 
	}
	return  $string;				
}
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function dsDate(){
	//user ip time zone
	// Get IP address
	$ip_address = getenv('HTTP_CLIENT_IP') ?: getenv('HTTP_X_FORWARDED_FOR') ?: getenv('HTTP_X_FORWARDED') ?: getenv('HTTP_FORWARDED_FOR') ?: getenv('HTTP_FORWARDED') ?: getenv('REMOTE_ADDR');
	// Get JSON object
	$jsondata = file_get_contents("http://timezoneapi.io/api/ip/?" . $ip_address);

	// Decode 
	$data = json_decode($jsondata, true);
	$error = '';
	// Request OK?
	if($data['meta']['code'] == '200'){
	$newDate = date("Y-m-d ", strtotime($data['data']['datetime']['date_time']));
	$today = $newDate .' '. $data['data']['datetime']['time'];
	}
	return $today; 
}
?>	