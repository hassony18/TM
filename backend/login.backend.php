<?php

	require_once $_SERVER['DOCUMENT_ROOT'].'/TM/vendor/autoload.php';

	$jwt = new \Firebase\JWT\JWT;
	$jwt::$leeway = 10;

	$id_token = $_POST["idtoken"];
	$CLIENT_ID = '467170103073-1t65koimd2m4jd4npjtoopmdtrboec6u.apps.googleusercontent.com';

	$client = new Google_Client(['client_id' => $CLIENT_ID]); 
	$payload = $client->verifyIdToken($id_token);
	if ($payload) {
		var_dump($payload);

		//log in
 		session_start();
		
		$_SESSION['userFirstName'] = $payload["given_name"];
		$_SESSION['userLastName'] = $payload["family_name"];
		$_SESSION['userFullName'] = $payload["name"];
		$_SESSION['email'] = $payload["email"];
		$_SESSION['user_image'] = $payload["picture"];
		
		include_once "../db/config.php";
		
				
		$email = mysqli_real_escape_string($conn, $payload["email"]);
		$first = mysqli_real_escape_string($conn, $payload["given_name"]);
		$last_name = mysqli_real_escape_string($conn, $payload["family_name"]);
		$user_image = mysqli_real_escape_string($conn, $payload["picture"]);
		
		$sql = "INSERT INTO users (email, first_name, last_name, user_image) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE first_name=?, last_name=?, user_image=?;";
		
		// execute without parameters
		mysqli_query($conn, $sql);
		
		// security 
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			echo "SQL ERROR";
		} else {
			mysqli_stmt_bind_param($stmt, "sssssss", $email, $first, $last_name, $user_image, $first, $last_name, $user_image);
			mysqli_stmt_execute($stmt);
		}
					
		
	
	} else {
		echo "<h1>ERROR</h1>";
	}