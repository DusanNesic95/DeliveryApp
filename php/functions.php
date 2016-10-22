<?php
	include("config.php");

	function addUser($name, $number, $latitude, $longitude,  $role) {
		global $conn;
		$insert = "INSERT INTO user (name, number, latitude, longitude, , role) VALUES (?,?,?,?, ?)";
		$query = $conn->prepare($insert);
		$query->bind_param('sssss', $name, $number, $latitude, $longitude, $role);
		$query->execute();
		$query->close();
	}

	function getUsers(){
		global $conn;
		$rarray = array();
		$result = $conn->query("SELECT * FROM user");
		$num_rows = $result->num_rows;
		$users = array();
		if($num_rows > 0) {
			$result2 = $conn->query("SELECT * FROM user");
			while($row = $result2->fetch_assoc()) {
				array_push($users,$row);
			}
		}
		$rarray['users'] = $users;
		return json_encode($rarray);
	}
?>
