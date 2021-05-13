<?php
	// if didn't click submit button
	if (!isset($_POST["signup-submit"])) {
		
		header("Location: ../signup.php?signup=error");
		exit();
		
	} else {
		include_once "../db/config.php";
		// if empty forms
		
		$username = $_POST["username"];
		$password = $_POST["password"];
		$email = $_POST["email"];
		$first = $_POST["first"];
		$last = $_POST["last"];
		
		if (empty($username) or empty($password) or empty($email) or empty($first) or empty($last)) {
			
			header("Location: ../signup.php?signup=empty");
			exit();
			
		} else {

/* 			if (!preg_match("/^[a-zA-Z]*$/", $first) or !preg_match("/^[a-zA-Z]*$/", $last)) {
				// check if invalid characters
				header("Location: ../signup.php?signup=char");
				exit();
				
			} else { */
				// check if email is valid
				if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
					
					header("Location: ../signup.php?signup=invalidemail&first=$first&last=$last&uid=$username");
					exit();
					
				} else {
					
					$username = mysqli_real_escape_string($conn, $_POST["username"]);
					$password = mysqli_real_escape_string($conn, $_POST["password"]);
					$email = mysqli_real_escape_string($conn, $_POST["email"]);
					$first = mysqli_real_escape_string($conn, $_POST["first"]);
					$last = mysqli_real_escape_string($conn, $_POST["last"]);
					$default_img = 'default-user.png';
					
					$sql = "INSERT INTO users (username, password, email, first_name, last_name , user_image) VALUES (?, ?, ?, ?, ? , ?);";
					
					// execute without parameters
					$a7a_kosk_f_tezk = mysqli_query($conn, $sql);
					
					// security 
					$stmt = mysqli_stmt_init($conn);
					if (!mysqli_stmt_prepare($stmt, $sql)) {
						echo "SQL ERROR";
					} else {
						$password = password_hash($password, PASSWORD_DEFAULT);
						mysqli_stmt_bind_param($stmt, "ssssss", $username, $password, $email, $first, $last, $default_img);
						mysqli_stmt_execute($stmt);
					}
					
					header("Location: ../signup.php?signup=success");
					exit();
				}
			}
		}
	/* } */
	


?>