<?php

include_once $_SERVER['DOCUMENT_ROOT']."/backend/score.backend.php";
	
$content = file_get_contents($_SERVER['DOCUMENT_ROOT']."/data/pays.json");

$baseCountriesTable = json_decode($content, true);

if (isset($_POST["commencer_test"])) {
	if (!isset($_POST["apprendreOuTest"])) {
		header("location: ../carte.php?success=error");
	//	echo "<script>showNotification('error', 'Choisis le mode d'apprentissage.');</script>";
		die();
	}
	if ($_POST["apprendreOuTest"] == "apprendre") {
		header("location: ../carte.php?success=learn");
		exit();
	} elseif ($_POST["apprendreOuTest"] == "test") {
		header("location: ../carte.php?success=test");
		exit();
	}
}

if (isset($_POST["requestReturnToCarte"])) {
	header("location: ../carte.php");
	exit();
}
