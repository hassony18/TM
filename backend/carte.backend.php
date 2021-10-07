<?php
	/*
		*	PROJECT:		swisslearns.ch
		*	FILE:			carte.backend.php
		*	DEVELOPERS:		Hassan & Jordan
		* 	PURPOSE:		La page backend de la carte
				o    o     __ __
				 \  /    '       `
				  |/   /     __    \
				(`  \ '    '    \   '
				  \  \|   |   @_/   |
				   \   \   \       /--/
					` ___ ___ ___ __ '
			
			Written with ♥ for the The Republic of Geneva. 		
	*/
	
include_once $_SERVER['DOCUMENT_ROOT']."/backend/score.backend.php"; // inclure le fichier score où se trouve le code permettant de rajouter de score aux utilisateurs
	
$content = file_get_contents($_SERVER['DOCUMENT_ROOT']."/data/pays.json");

$baseCountriesTable = json_decode($content, true);

// commencer le test/l'apprentissage
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

// retourner à la page carte.php
if (isset($_POST["requestReturnToCarte"])) {
	header("location: ../carte.php");
	exit();
}
