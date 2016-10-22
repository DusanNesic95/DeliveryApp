<?php
	header('Access-Control-Allow-Methods: POST');
	include("functions.php");

	if(isset($_POST['name']) && isset($_POST['number']) && isset($_POST['latitude'])  && isset($_POST['longitude']) && isset($_POST['role'])){
    echo("helo");
		$name = $_POST['name'];
		$number = $_POST['number'];
		$latitude = $_POST['latitude'];
		$longitude = $_POST['longitude'];
		$role = $_POST['role'];
		echo addUser($name, $number, $latitude, $longitude, $role);
	}
?>
