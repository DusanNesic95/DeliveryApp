<?php
	header('Access-Control-Allow-Methods: POST');
	include("functions.php");

	$post = file_get_contents('php://input');
	$data = json_decode($post);

	$name = $data->name;
	$number = $data->number;
	$latitude = $data->latitude;
	$longitude = $data->longitude;
	$role = $data->role;
	
	echo addUser($name, $number, $latitude, $longitude, $role);
?>
