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
			$rarray = getUsers($latitude, $longitude, $role);
		} else {
			$rarray = "Database connection error";
		}

		return json_encode($rarray);
	}

	function getUsers($latitude, $longitude, $role){
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
		$rarray = $users;
		$newAray = array();
		for ($i = 0; $i < count($rarray); $i++) {
			if ($role != $rarray[$i]['role']) {
				if (getDistance($latitude, $longitude, $rarray[$i]['latitude'], $rarray[$i]['longitude']) <= 2000) {
					array_push($newAray, $rarray[$i]);
				}
			}
		}
		return $newAray;
	}

	function getDistance($lat1, $long1, $lat2, $long2) {
		$r = 6371;
		$dLat = degToRad($lat2-$lat1);
		$dLong = degToRad($long2-$long1);
		$a = sin($dLat/2) * sin($dLat/2) + cos(degToRad($lat1)) * cos(degToRad($lat2)) * sin($dLong/2) * sin($dLong/2);
		$c = 2 * atan2(sqrt($a), sqrt(1-$a));
		$d = $r * $c;
		return $d;
	}

	function degToRad($deg) {
		return $deg * (M_PI/180);
	}
?>
