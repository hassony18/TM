<?php
	/*
		*	PROJECT:		swisslearns.ch
		*	FILE:			upload.backend.php
		*	DEVELOPERS:		Hassan & Jordan
		* 	PURPOSE:		Upload the banners
				o    o     __ __
				 \  /    '       `
				  |/   /     __    \
				(`  \ '    '    \   '
				  \  \|   |   @_/   |
				   \   \   \       /--/
					` ___ ___ ___ __ '
			
			Written with ♥ for the The Republic of Geneva. 		
	*/
if (session_status() === PHP_SESSION_NONE) { // verifier s'il y a une session, sinon, en initier une.
	session_start();
}

if (!isset($_SESSION["email"])) { // si pas connecté, virer.
	die(header("Location: ../index.php"));
}

$target_file = $_SERVER['DOCUMENT_ROOT']."/styles/img/banners/".$_SESSION["user_id"].".png";
//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//$target_file = $target_dir.".png";
$uploadOk = 1;
$errorType = null;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $uploadOk = 0;
	$errorType = "notImage";
  }
}

// Check file size
if ($uploadOk == 1) {
	if ($_FILES["fileToUpload"]["size"] > 50000000) {
	  $uploadOk = 0;
	  $errorType = "tooLarge";
	}
}

// Allow certain file formats
if ($uploadOk == 1) {
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	  $uploadOk = 0;
	  $errorType = "format";
	}
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  die(header("Location: ../profile.php?u=".$_SESSION["user_id"]."&error=".$errorType));
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	die(header("Location: ../profile.php?u=".$_SESSION["user_id"]."&success"));
  } else {
	die(header("Location: ../profile.php?u=".$_SESSION["user_id"]."&error=unknown"));
  }
}