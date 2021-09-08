<?php

if (isset($_POST["commencer_test"])) {
	if (!isset($_POST["apprendreOuTest"])) {
		header("location: ../drapeaux.php?success=error");
		die();
	}
	if ($_POST["apprendreOuTest"] == "apprendre") {
		header("location: ../drapeaux.php?success=learn");
		exit();
	} elseif ($_POST["apprendreOuTest"] == "test") {
		header("location: ../drapeaux.php?success=test");
		exit();
	}
}

if (isset($_POST["requestReturnToDrapeaux"])) {
	header("location: ../drapeaux.php");
	exit();
}
