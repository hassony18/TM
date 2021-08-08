<?php
	$dbServerName = "localhost";
	$dbServerUsername = "swisicfc_tm";
	$dbPassword = "#Nv]&GxqSL[x";
	$dbName = "swisicfc_tm";
	
	$conn = mysqli_connect($dbServerName, $dbServerUsername, $dbPassword, $dbName);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
?>