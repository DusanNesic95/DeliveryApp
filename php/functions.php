<?php
	include("config.php");

	// function addUser($name, $number, $latitude, $longitude,  $role) {
	// 	global $conn;
	// 	$insert = "INSERT INTO user (name, number, latitude, longitude, role) VALUES (?,?,?,?,?)";
	// 	$query = $conn->prepare($insert);
	// 	$query->bind_param('sssss', $name, $number, $latitude, $longitude, $role);
	// 	$query->execute();
	// 	$query->close();

	// 	return json_encode("OKAY");
	// }

	function addUser($name, $number, $latitude, $longitude, $role) {
		global $conn;
		$rarray = array();
		$stmt = $conn->prepare("INSERT INTO user (name, number, latitude, longitude, role) VALUES (?,?,?,?,?)");
		$stmt->bind_param('sssss', $name, $number, $latitude, $longitude, $role);

		if($stmt->execute()) {
			$rarray['sucess'] = "ok";
		} else {
			$rarray['error'] = "Database connection error";
		}
		echo getDistance();
		return json_encode($rarray);
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

	function getDistance(lat1, long1, lat2, long 2) {
		var r = 6371;
		var dLat = degToRad(lat2-lat1);
		var dLong = degToRad(long2-long1);
		var a = sin(dLat/2) * sin(dLat/2) + cons(degToRad(lat1)) * cos(degToRad(lat2)) * sin(dLong/2) * sin(dLong/2);
		var c = 2 * atah2(sqrt(a), sqrt(1-a));
		var d = r * c;
		return d;
	}

	function degToRad(deg) {
		return deg * (M_PI/180);
	}
?>
