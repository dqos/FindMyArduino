<?php
/*
FindMyArduino Project
Tested with ESP32 and GY-GPS6MV2 module
Version: 1.0
Authors: Tamer
Updated: 25-09-2017
*/

// API for Smart Room. You should implement some authentication here.
if (isset($_GET['api'])) {
	$getData = file_get_contents("gps.json");
	// Return lattitude and longitude.

	if ($_GET['api'] == 'raw') {
		$toArray = json_decode($getData);
		echo $toArray[1].'-'.$toArray[0];
		die();
	}

	if ($_GET['api'] == 'json') {
		echo $getData;
		die();
	}

}

// Stop the script if the lon parameter is empty/not set.
if (empty($_GET['lon'])) {
	die('Status: Longtitude parameter missing...');
}

// Stop the script if the lat parameter is empty/not set.
if (empty($_GET['lat'])) {
	die('Status: Lattitude parameter missing...');
}

// Stop the script if the default coordinates are used.
if ($_GET['lon'] == '1000.00000') {
	die('Status: GPS is still trying to find coordinates...');
}

// Stop the script if the default coordinates are used.
if ($_GET['lat'] == '1000.00000') {
	die('Status: GPS is still trying to find coordinates...');
}

// Get parameter values.
// WARNING: For security reasons, this input MUST be sanitized and validated. Not doing that now, sorry.
$getLon = $_GET['lon'];
$getLat = $_GET['lat'];

// Build array.
$data = array($getLon, $getLat, strtotime(date("H:i:s d-m-Y")));

// Convert array to JSON data and write to temp file.
file_put_contents("gps.json", json_encode($data));

// Return OK status to the Arduino Serial Monitor.
echo 'Status: OK!';