<?php
	header('Access-Control-Allow-Methods: POST');
	include("functions.php");

	if(isset($_POST['name']) && isset($_POST['number']) && isset($_POST['location']) && isset($_POST['role'])){
    echo("helo");
		$name = $_POST['name'];
		$number = $_POST['number'];
		$location = $_POST['location'];
		$role = $_POST['role'];
		echo addUser($name, $number, $location, $role);
	}
?>
