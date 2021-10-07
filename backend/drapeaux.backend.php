<?php
	/*
		*	PROJECT:		swisslearns.ch
		*	FILE:			drapeaux.backend.php
		*	DEVELOPERS:		Hassan & Jordan
		* 	PURPOSE:		La page backend des drapeaux
				o    o     __ __
				 \  /    '       `
				  |/   /     __    \
				(`  \ '    '    \   '
				  \  \|   |   @_/   |
				   \   \   \       /--/
					` ___ ___ ___ __ '
			
			Written with ♥ for the The Republic of Geneva. 		
	*/
	
// commencer le test/l'apprentissage
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

// retour à drapeaux.php
if (isset($_POST["requestReturnToDrapeaux"])) {
	header("location: ../drapeaux.php");
	exit();
}
