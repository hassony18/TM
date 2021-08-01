<?php

	require_once $_SERVER['DOCUMENT_ROOT'].'/TM/vendor/autoload.php';
	include_once $_SERVER['DOCUMENT_ROOT']."/TM/db/config.php";

	$jwt = new \Firebase\JWT\JWT;
	$jwt::$leeway = 10;

	if (!isset($_POST["idtoken"])) {
		exit();
	}
	$id_token = $_POST["idtoken"];
	$CLIENT_ID = '467170103073-1t65koimd2m4jd4npjtoopmdtrboec6u.apps.googleusercontent.com';

	$client = new Google_Client(['client_id' => $CLIENT_ID]); 
	$payload = $client->verifyIdToken($id_token);
	if ($payload) {

		//log in
 		session_start();
		
		$_SESSION['userFirstName'] = $payload["given_name"];
		$_SESSION['userLastName'] = $payload["family_name"];
		$_SESSION['userFullName'] = $payload["name"];
		$_SESSION['email'] = $payload["email"];
		$_SESSION['user_image'] = $payload["picture"];
		
				
		$email = mysqli_real_escape_string($conn, $payload["email"]);
		$first = mysqli_real_escape_string($conn, $payload["given_name"]);
		$last_name = mysqli_real_escape_string($conn, $payload["family_name"]);
		$user_image = mysqli_real_escape_string($conn, $payload["picture"]);

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
		mysqli_query($conn, $sql);
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			echo "SQL ERROR";
		} else {
			mysqli_stmt_bind_param($stmt, "ssss", $first, $last_name, $user_image, $email);
			mysqli_stmt_execute($stmt);
		}
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