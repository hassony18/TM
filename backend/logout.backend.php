<?php
	/*
		*	PROJECT:		swisslearns.ch
		*	FILE:			logout.backend.php
		*	DEVELOPERS:		Hassan & Jordan
		* 	PURPOSE:		Supprimer les données à la déconnexion
				o    o     __ __
				 \  /    '       `
				  |/   /     __    \
				(`  \ '    '    \   '
				  \  \|   |   @_/   |
				   \   \   \       /--/
					` ___ ___ ___ __ '
			
			Written with ♥ for the The Republic of Geneva. 		
	*/
session_start();
session_unset();
session_destroy();
foreach($_SESSION as $key => $value) { // détruire toutes les données de la session
    $_SESSION[$key] = null;
}
header("Location: ../index.php");