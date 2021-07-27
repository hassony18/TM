<?php
	$score = $_POST["score"];
	$type = $_POST["gType"];
	echo $score;
	echo $type;

	//log in
	session_start();	
	include_once "../db/config.php";
	
	$email = mysqli_real_escape_string($conn, $_SESSION["email"]);
	if ($type == "allemand") {
		$sql = "UPDATE `users` set scoreAllemand=scoreAllemand+? WHERE email=?;";
	} else if ($type == "drapeaux") {
		$sql = "UPDATE `users` set scoreDrapeaux=scoreDrapeaux+? WHERE email=?;";
	} else if ($type == "carte") {
		$sql = "UPDATE `users` set scoreCarte=scoreCarte+? WHERE email=?;";
	} else if ($type == "italien") {
		$sql = "UPDATE `users` set scoreItalien=scoreItalien+? WHERE email=?;";
	} else if ($type == "anglais") {
		$sql = "UPDATE `users` set scoreAnglais=scoreAnglais+? WHERE email=?;";
	}
	
	// execute without parameters
	mysqli_query($conn, $sql);
	
	// security 
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "SQL ERROR";
	} else {
		mysqli_stmt_bind_param($stmt, "ss", $score, $email);
		mysqli_stmt_execute($stmt);
	}
