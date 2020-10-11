<?php

if (isset($_POST['login-submit'])) {
	include_once '../db/config.php';
	
	$mailuid = $_POST["mailuid"];
	$password = $_POST["pwd"];
	
	if (empty($mailuid) or empty($password)) {
		
		header("Location: ../signup.php?error=emptyfields");
		exit();
		
	} else {
		
			$sql = "SELECT * FROM users WHERE username=? OR email=?;";
			$stmt = mysqli_stmt_init($conn);
			
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../signup.php?error=sqlerror");
			exit();
			
		} else {
			
			mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			
			if ($row = mysqli_fetch_assoc($result)) {
				
				$pwdCheck = password_verify($password, $row["password"]);
				
				if ($pwdCheck == false) {
					
					header("Location: ../signup.php?error=wrongpwd");
					exit();
					
				} else if ($pwdCheck == true) {
					// logged in
					session_start();
					$_SESSION['userId'] = $row["id"];
					$_SESSION['userUid'] = $row["username"];
					
					header("Location: ../index.php?login=success");
					exit();
					
				} else { 
				
					header("Location: ../signup.php?error=wrongpwd");
					exit();
					
				}
			} else {
				
				header("Location: ../signup.php?error=nouser");
				exit();
				
			}
		}
	}
} else {
	header("Location: ../index.php");
	exit();
}