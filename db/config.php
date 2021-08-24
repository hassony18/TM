<?php
	$dbServerName = "localhost";
	$dbServerUsername = "swisicfc_tm";
	$dbPassword = "#Nv]&GxqSL[x";
	$dbName = "swisicfc_tm";
	
	//$conn = mysqli_connect($dbServerName, $dbServerUsername, $dbPassword, $dbName);
	$conn = new mysqli($dbServerName, $dbServerUsername, $dbPassword, $dbName);

	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	/*
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	*/
?>