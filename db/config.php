<?php
	$dbServerName = "localhost";
	$dbServerUsername = "root";
	$dbPassword = "";
	$dbName = "tm";
	
	$conn = mysqli_connect($dbServerName, $dbServerUsername, $dbPassword, $dbName);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
?>