<?php
//log in
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once $_SERVER['DOCUMENT_ROOT']."/db/config.php";

function addScore($type, $score) {
	global $conn;
	$email = mysqli_real_escape_string($conn, $_SESSION["email"]);
	if ($type == "allemand") {
		$sql = "UPDATE `users` set scoreAllemand=scoreAllemand+? WHERE email=?;";
	} elseif ($type == "drapeaux") {
		$sql = "UPDATE `users` set scoreDrapeaux=scoreDrapeaux+? WHERE email=?;";
	} elseif ($type == "carte") {
		$sql = "UPDATE `users` set scoreCarte=scoreCarte+? WHERE email=?;";
	} elseif ($type == "italien") {
		$sql = "UPDATE `users` set scoreItalien=scoreItalien+? WHERE email=?;";
	} elseif ($type == "anglais") {
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
}
