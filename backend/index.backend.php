<?php

include_once $_SERVER['DOCUMENT_ROOT']."/db/config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['email'])) {
	die(header("location: index.php"));
}


if (isset($_POST["submit_review"])) { // on submit request learning or testing
    $stars = isset($_POST["reviewStars"]); 
	$message = isset($_POST["reviewMessage"]); 
    if (!$stars || !$message) {
        header("Location: ../index.php");
        exit();
    }
    $stars = $_POST["reviewStars"]; 
	$message = $_POST["reviewMessage"]; 
	if ($stars > 5) {
		$stars = 5;
	} elseif ($stars < 1) {
		$stars = 1;
	}
	$sql = "INSERT INTO reviews (id, message, stars, displayed) VALUES (?, ?, ?, 0) ON DUPLICATE KEY UPDATE message = ?, stars = ?;";
	$stmt = $conn->prepare($sql); 
	$stmt->bind_param('sssss', $_SESSION['user_id'], $message, $stars, $message, $stars);
	$stmt->execute();
	header("Location: ../index.php?success=reviewed".$status);
}
