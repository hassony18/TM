<?php

	require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
	include_once $_SERVER['DOCUMENT_ROOT']."/db/config.php";

	//$jwt = new \Firebase\JWT\JWT;
	//$jwt::$leeway = 10;
	
	$verifiyAccess = array(
		"hassonyalobaidy01@gmail.com" => true,
		"scarpettajordan@gmail.com" => true,
		"hasan.albd@eduge.ch" => true
	);
	
	if (!isset($_POST["idtoken"])) {
		exit();
	}
	$id_token = $_POST["idtoken"];
	$CLIENT_ID = '467170103073-1t65koimd2m4jd4npjtoopmdtrboec6u.apps.googleusercontent.com';

	$client = new Google_Client(['client_id' => $CLIENT_ID]); 
	$payload = $client->verifyIdToken($id_token);
	if ($payload) {
		if (empty($payload["family_name"]) || !isset($payload["family_name"])) {
			$payload["family_name"] = "";
		}
		//if (!$verifiyAccess[$payload["email"]]) {
			//die();
		//}

		//log in
 		session_start();
		
		$_SESSION['userFirstName'] = $payload["given_name"];
		$_SESSION['userLastName'] = $payload["family_name"];
		$_SESSION['userFullName'] = $payload["name"];
		$_SESSION['email'] = $payload["email"];
		$_SESSION['user_image'] = $payload["picture"];
		
		$stmt = $conn->prepare('SELECT id from users WHERE email= ?');
		$stmt->bind_param('s', $_SESSION['email']);
		$stmt->execute();
		$result = $stmt->get_result();
		$data = $result->fetch_assoc();
		if (empty($data)) { 
			$sql = "INSERT INTO users (first_name, last_name, user_image, email) VALUES (?, ?, ?, ?);";
		} else {
			$sql = "UPDATE users SET first_name = ?, last_name = ?, user_image = ? WHERE email = ?;";
		}
		//error_log( print_r($payload, true) );
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('ssss', $payload["given_name"], $payload["family_name"], $payload["picture"], $payload["email"]);
		$stmt->execute();
		if (empty($data)) {
			$stmt = $conn->prepare('SELECT id from users WHERE email= ?');
			$stmt->bind_param('s', $_SESSION['email']);
			$stmt->execute();
			$result = $stmt->get_result();
			$data = $result->fetch_assoc();
		}
		$_SESSION['user_id'] = $data['id'];
		exit();
	
	} else {
		echo "<h1>ERROR</h1>";
	}