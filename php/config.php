<?php
	header("Access-Control-Allow-Origin: *");
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization, Token, token, TOKEN');
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$database = "deliveryApp";

	$conn = new mysqli($servername, $username, $password, $database);

	if (!$conn->set_charset("utf8")) {
		printf("Error loading character set utf8: %s\n", $mysqli->error);
		exit();
	}
?>
