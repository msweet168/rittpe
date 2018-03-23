<?php
	
	ini_set('display_errors', 1);

	//require 'vendor/autoload.php';


	$db = include('config.php');
	
	// $host = $db['host'];
	// $user = $db['user'];
	// $pass = $db['pass'];
	// $name = $db['name'];

	$mysqli = mysqli_init();
	mysqli_ssl_set($mysqli, NULL, NULL, '/etc/ssl/certs/ca-bundle.crt', NULL, NULL);

	mysqli_real_connect($mysqli, $db['host'], $db['user'], $db['pass'], $db['name'], 3306, MYSQLI_CLIENT_SSL);

	$msg = "";

	if (!$mysqli) {
		$msg = "Error: Could not connect to the database: " . mysqli_connect_error();
		die();

		// die("Connection failed: " . mysqli_connect_error());
	}

	session_start();
?>

<!doctype html>
<html lang='en'>
<head>
	<meta charset="utf-8">