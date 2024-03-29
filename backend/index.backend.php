<?php
	/*
		*	PROJECT:		swisslearns.ch
		*	FILE:			index.backend.php
		*	DEVELOPERS:		Hassan & Jordan
		* 	PURPOSE:		La page backend de l'index
				o    o     __ __
				 \  /    '       `
				  |/   /     __    \
				(`  \ '    '    \   '
				  \  \|   |   @_/   |
				   \   \   \       /--/
					` ___ ___ ___ __ '
			
			Written with ♥ for the The Republic of Geneva. 		
	*/
	
include_once $_SERVER['DOCUMENT_ROOT']."/db/config.php";

if (session_status() === PHP_SESSION_NONE) { // verifier s'il y a une session, sinon, en initier une.
    session_start();
}

if (!isset($_SESSION['email'])) { // si pas connecté, virer.
	die(header("location: index.php"));
}


if (isset($_POST["submit_review"])) { // on submit request learning or testing
    $stars = isset($_POST["reviewStars"]); 
	$message = isset($_POST["reviewMessage"]); 
    if (!$stars || !$message) {
        header("Location: ../index.php");
        exit();
    }
    $stars = intval($_POST["reviewStars"]); 
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
	header("Location: ../avis.php");
}
