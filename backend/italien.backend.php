<?php
	/*
		*	PROJECT:		swisslearns.ch
		*	FILE:			italien.backend.php
		*	DEVELOPERS:		Hassan & Jordan
		* 	PURPOSE:		La page backend de l'italien
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

if (session_status() === PHP_SESSION_NONE) { // verifier s'il y a une session, sinon, en initier une.
    session_start();
}

if (!function_exists('str_contains')) { // créer la fonction "str_contains" qui permet de verifier si certain string contient un string donné
    function str_contains(string $haystack, string $needle): bool
    {
        return '' === $needle || false !== strpos($haystack, $needle);
    }
}

$content = file_get_contents($_SERVER['DOCUMENT_ROOT']."/data/italien.json"); // chercher le contenu du fichier allemand.json où se trouve la liste du voc

$baseVocTable = json_decode($content, true); // convertir le string du voc en une liste php
    
if (isset($_POST["submit_vocSession"])) { //  Quand on soumet le requêt d'apprentissage ou de test
    prepareVocSession();
}

if (isset($_POST["requestReturnToItalien"])) {  // Quand on clique sur le bouton 'retour' on va à la page italien.php
    header("Location: ../italien.php");
    exit();
}

function prepareVocSession() { // fonction permettant d'initer soit le test soit la session d'apprentissage
    global $baseVocTable;
	
	// voir et récuperer les parametres de l'utilisateur
    $learningChoice = isset($_POST["apprendreOuTest"]); // apprendre ou test
    if (!$learningChoice) {
        header("Location: ../italien.php?error=chooseLearningOption");
        exit();
    }
    $learningChoice = $_POST["apprendreOuTest"];// apprendre ou test

    $testChoice = isset($_POST["choixMultiplesOuEcrire"]); // choixMultiples ou ecrire
    if ($learningChoice == "test" && !$testChoice) {
        header("Location: ../italien.php?error=chooseTestOption");
        exit();
    }
    $langue = isset($_POST["francaisOuItalien"]); // francais ou italien
    if ($learningChoice == "test" && !$langue) {
        header("Location: ../italien.php?error=chooseLanguage");
        exit();
    }
	if ($learningChoice == "test") {
		$language = $_POST["francaisOuItalien"]; // francais ou italien
		$testChoice = $_POST["choixMultiplesOuEcrire"]; // choixMultiples ou ecrire
	}
	
	// faire une liste des chapitres de voc selectionnes
    $selectedVocNums = array();
    foreach ($baseVocTable as $key => $value){
        $key = str_replace(".", "_", $key); // remplacer . par _ pour éviter des problèmes avec le côté HTML
        if (isset($_POST[$key])) {
            $key = str_replace("_", ".", $key);
            array_push($selectedVocNums, $key);
        }
    }
	//var_dump($selectedVocNums);
    if (empty($selectedVocNums)) { // si on choisit aucun chapitre, on retourne à la page d'allemand en montrant un message d'erreur
        header("Location: ../italien.php?error=chooseChapter");
        exit();
    }
	
	// récuprer les parametres du voc
    $includePhrases = isset($_POST["phrasesNormales"]);
	
	// rajouter  phrase sur demande
    $finalTable = array();
    foreach($selectedVocNums as $index => $vocNumber) {
        foreach ($baseVocTable[$vocNumber] as $vocType => $localVocTable) {
            if ($vocType == "phrase" && $includePhrases) {
                foreach ($localVocTable as $italian => $french) {
                    array_push($finalTable, [$italian, $french]);
                }
            } 
			elseif ($vocType == "normal") {
                foreach ($localVocTable as $italian => $french) {
                    array_push($finalTable, [$italian, $french]);
                }
            }
        }
    }
	
	// si l'utilisateur a choisi d'apprendre ou de faire un test, on l'envoie a la page correcte.
    if ($learningChoice == "apprendre") {
        $_SESSION["learningTable"] = $finalTable;
        header("Location: ../italien.php?success=apprendre");
        exit();
    } elseif ($learningChoice == "test") {
        shuffle($finalTable);
        $_SESSION["learningTable"] = $finalTable;
        $_SESSION["test_choice"] = $testChoice;
        $_SESSION["test_language"] = $language;
        // reset settings
        $_SESSION["currentNumberInQueue"] = 0;
        $_SESSION["errorNumber"] = 0;
        $_SESSION["errorTable"] = array();
        if ($_SESSION["test_choice"] == "choixMultiples") {
            setupMultipleChoices();
        } elseif ($_SESSION["test_choice"] == "ecrire") {
            startWritingTest();
        }
        header("Location: ../italien.php?success=test");
        exit();
    }

}

// MULTIPLE CHOICES CODE

if (!isset($_SESSION["currentNumberInQueue"])) {  // initer les paramètres s'ils ne sont pas la
    $_SESSION["currentNumberInQueue"] = 0;
}

if (isset($_POST["submit_multipleChoices"])) { // quand on soumet la réponse du test choix multiple
    verifyMultipleChoicesAnswer($_POST["submit_multipleChoices"]);
}

// on vérifie si la réponse est correcte ou pas.
function verifyMultipleChoicesAnswer($answer) {
    $_SESSION["currentNumberInQueue"] = $_SESSION["currentNumberInQueue"] + 1;
	if ($answer == $_SESSION["correctAnswer"]) {
		addScore("italien", 1);
        header("Location: ../italien.php?success=correctAnswer");
       // enlever la réponse de la liste d'erreur si la réponse est correcte
        if (isset( $_SESSION["errorTable"]) && !empty($_SESSION["errorTable"])) {
            foreach ($_SESSION["errorTable"] as $key => $value) {
                if ($value[0] == $answer || $value[1] == $answer) {
                    unset($_SESSION["errorTable"][$key]);
                }
            }
        }

        setupMultipleChoices("&answer=correct");
	} else {
		addScore("italien", -1);
        header("Location: ../italien.php?success=wrongAnswer");
        // add to error list
        if (!isset( $_SESSION["errorTable"]) || empty($_SESSION["errorTable"])) { 
            $tempArray = array();
        } else {
            $tempArray = $_SESSION["errorTable"];
        }
        array_push($tempArray, [$_SESSION["question"], $_SESSION["correctAnswer"]]);
        $_SESSION["errorTable"] = $tempArray;
        setupMultipleChoices("&answer=incorrect&correctAnswer=".$_SESSION["correctAnswer"]);
    }
}

// créer le test choix multiples
function setupMultipleChoices($status = "") {
	$num = $_SESSION["currentNumberInQueue"];
    $localLearningTable = $_SESSION["learningTable"];
    // if done normal table start error table
	if ($num >= count($localLearningTable)) {
        if (isset($_SESSION["errorTable"])) { 
            $errorTable = $_SESSION["errorTable"];
            if (count($errorTable) > 0) {
                if (!isset($_SESSION["errorNumber"]) && $_SESSION["errorNumber"] !== 0) {
                    $_SESSION["errorNumber"] = 0;
                }
                $question = $errorTable[$_SESSION["errorNumber"]][0]; // question
                $answer = $errorTable[$_SESSION["errorNumber"]][1]; // answer
                if (str_contains($question, "%")) {
                    $question = str_replace("%", "", $question);
                }
                if (str_contains($answer, "%")) {
                    $answer = str_replace("%", "", $answer);
                }
                $_SESSION["correctAnswer"] = $answer;
                $_SESSION["question"] = $question;
                $tempAnswerArray = array();
                $rand_keys = array_rand($errorTable, 3);
                if ($_SESSION["test_language"] == "italien") {
                    array_push($tempAnswerArray, $errorTable[$rand_keys[0]][0]);
                    array_push($tempAnswerArray, $errorTable[$rand_keys[1]][0]);
                    array_push($tempAnswerArray, $errorTable[$rand_keys[2]][0]);
                    array_push($tempAnswerArray, $answer); // correct answer
                } elseif ($_SESSION["test_language"] == "francais") {
                    array_push($tempAnswerArray, $errorTable[$rand_keys[0]][1]);
                    array_push($tempAnswerArray, $errorTable[$rand_keys[1]][1]);
                    array_push($tempAnswerArray, $errorTable[$rand_keys[2]][1]);
                    array_push($tempAnswerArray, $answer); // correct answer
                }
                shuffle($tempAnswerArray); // rendre la liste aleatoire
				$tempAnswerArray = array_unique($tempAnswerArray); // enlever toutes repetitions
				$tempAnswerArray = array_values($tempAnswerArray); // mettre dans l'ordre
                $_SESSION["answersList"] = json_encode($tempAnswerArray);
                $_SESSION["errorNumber"] = $_SESSION["errorNumber"] + 1;
                header("Location: ../italien.php?success=multipleChoices".$status);
                exit();
           } else { header("Location: ../italien.php?success=doneStudying"); exit(); }
         } else { header("Location: ../italien.php?success=doneStudying"); exit(); }
    } else {
        // if normal table ->
		$italianWord = $localLearningTable[$_SESSION["currentNumberInQueue"]][0]; // italien text
		$frenchWord = $localLearningTable[$_SESSION["currentNumberInQueue"]][1]; // french text
		if (str_contains($italianWord, "%")) {
            $italianWord = str_replace("%", "", $italianWord);
		}
		if (str_contains($frenchWord, "%")) {
            $frenchWord = str_replace("%", "", $frenchWord);
		}
	}
    $tempAnswerArray = array();
    $rand_keys = array_rand($localLearningTable, 3);
	if ($_SESSION["test_language"] == "italien") {
		$_SESSION["correctAnswer"] = $italianWord;
        $_SESSION["question"] = $frenchWord;
        array_push($tempAnswerArray, $localLearningTable[$rand_keys[0]][0]);
        array_push($tempAnswerArray, $localLearningTable[$rand_keys[1]][0]);
        array_push($tempAnswerArray, $localLearningTable[$rand_keys[2]][0]);
        array_push($tempAnswerArray, $italianWord); // correct answer
	} elseif ($_SESSION["test_language"] == "francais") {
        $_SESSION["correctAnswer"] = $frenchWord;
        $_SESSION["question"] = $italianWord;
        array_push($tempAnswerArray, $localLearningTable[$rand_keys[0]][1]);
        array_push($tempAnswerArray, $localLearningTable[$rand_keys[1]][1]);
        array_push($tempAnswerArray, $localLearningTable[$rand_keys[2]][1]);
        array_push($tempAnswerArray, $frenchWord); // correct answer
	}
	shuffle($tempAnswerArray); // rendre la liste aleatoire
	$tempAnswerArray = array_unique($tempAnswerArray); // enlever toutes repetitions
	$tempAnswerArray = array_values($tempAnswerArray); // mettre dans l'ordre
    $_SESSION["answersList"] = json_encode($tempAnswerArray);
    header("Location: ../italien.php?success=multipleChoices".$status);
    exit();

}

// test ecrire

if (isset($_POST["submit_ecrire_test"])) {
    if (isset($_POST["textAEcrire"])) {
        $answer = $_POST["textAEcrire"];
    }

    verifyWritingTestAnswer($answer);
}

// vérifier la réponse du test d'écriture
function verifyWritingTestAnswer($answer) {
    $_SESSION["currentNumberInQueue"] = $_SESSION["currentNumberInQueue"] + 1;
    $answer = preg_replace("/\s+/", "", $answer); // remove all spaces from answer
    $question = $_SESSION["question"];
    $correctAnswer = preg_replace("/\s+/", "", $_SESSION["correctAnswer"]); // remove all spaces from answer
    $skipCommas = false;
    $canPass = false;
    if (str_contains($correctAnswer, "%")) {
        $skipCommas = true;
        $correctAnswer = str_replace("%", "", $correctAnswer);
    }
    if (!$skipCommas) { 
        $correctAnswersTable = explode(",", $correctAnswer);
        foreach ($correctAnswersTable as $index => $text){
            $correctAnswerPart = $text;
            if (!preg_match("#\((.*?)\)#", $answer)) { // s'il ne possede pas ()
                $correctAnswerPart = preg_replace("#\((.*?)\)#", "", $correctAnswerPart);  // retirer les parantheses dans la reponse
            }
            $correctAnswerPart = preg_replace("/\s+/", "", $correctAnswerPart); // remove all spaces
            if ($answer == $correctAnswerPart) {
                $canPass = true;
            }
        }
    }
    // search for synonymes
    $table = $_SESSION["learningTable"];
    foreach ($table as $index => $list) {
        if ($table[$index][0] == $question || $table[$index][1] == $question) {
            if ($table[$index][0] == $answer || $table[$index][1] == $answer) {
                $canPass = true;
            }
        }
    }
	$similarities = similar_text($answer, $correctAnswer, $percentage);
    if ($canPass || $percentage >= 90) { // was  $canPass || $answer == $correctAnswer
        addScore("italien", 1);
        header("Location: ../italien.php?success=correctAnswer");
        // remove from error list if the answer is correct
        if (isset($_SESSION["errorTable"]) && !empty($_SESSION["errorTable"])) {
            foreach ($_SESSION["errorTable"] as $key => $value) {
                if ($value[0] == $answer || $value[1] == $answer) {
                    unset($_SESSION["errorTable"][$key]);
                }
            }
        }
        startWritingTest("&answer=correct&correctAnswer=".$_SESSION["correctAnswer"]."&percentage=".$percentage);
    } else {
        addScore("italien", -1);
        header("Location: ../italien.php?success=wrongAnswer");
        // remove from error list if the answer is correct
        if (isset($_SESSION["errorTable"]) && !empty($_SESSION["errorTable"])) {
            foreach ($_SESSION["errorTable"] as $key => $value) {
                if ($value[0] == $answer || $value[1] == $answer) {
                    unset($_SESSION["errorTable"][$key]);
                }
            }
        }
        // add to error list
        if (!isset( $_SESSION["errorTable"]) || empty($_SESSION["errorTable"])) { 
            $tempArray = array();
        } else {
            $tempArray = $_SESSION["errorTable"];
        }
        array_push($tempArray, [$_SESSION["question"], $_SESSION["correctAnswer"]]);
        $_SESSION["errorTable"] = $tempArray;
        startWritingTest("&answer=incorrect&correctAnswer=".$_SESSION["correctAnswer"]);
    }
}

// commencer le test d'écriture
function startWritingTest($status = "") {
    $num = $_SESSION["currentNumberInQueue"];
    $localLearningTable = $_SESSION["learningTable"];
    // if done normal table start error table
    if ($num >= count($localLearningTable)) {
        if (isset($_SESSION["errorTable"])) { 
            $errorTable = $_SESSION["errorTable"];
            if (count($errorTable) > 0 && $_SESSION["errorNumber"] <= count($errorTable)) {
                if (!isset($_SESSION["errorNumber"]) && $_SESSION["errorNumber"] !== 0) {
                    $_SESSION["errorNumber"] = 0;
                }
                var_dump($errorTable);
                var_dump($_SESSION["errorNumber"]);
                $question = $errorTable[$_SESSION["errorNumber"]][0]; // question
                $answer = $errorTable[$_SESSION["errorNumber"]][1]; // answer
                if (str_contains($question, "%")) {
                    $question = str_replace("%", "", $question);
                }
                if (str_contains($answer, "%")) {
                    $answer = str_replace("%", "", $answer);
                }
                $_SESSION["correctAnswer"] = $answer;
                $_SESSION["question"] = $question;
                header("Location: ../italien.php?success=writingTest".$status);
                $_SESSION["errorNumber"] = $_SESSION["errorNumber"] + 1;
                exit();
            } else { header("Location: ../italien.php?success=doneStudying"); exit(); }
            } else { header("Location: ../italien.php?success=doneStudying"); exit(); }
    } else {
        // if normal table ->
        $italianWord = $localLearningTable[$_SESSION["currentNumberInQueue"]][0]; // italian text
        $frenchWord = $localLearningTable[$_SESSION["currentNumberInQueue"]][1]; // french text
        if (str_contains($italianWord, "%")) {
            $italianWord = str_replace("%", "", $italianWord);
        }
        if (str_contains($frenchWord, "%")) {
            $frenchWord = str_replace("%", "", $frenchWord);
        }
    }
    if ($_SESSION["test_language"] == "italien") {
        $_SESSION["correctAnswer"] = $italianWord;
        $_SESSION["question"] = $frenchWord;
    } elseif ($_SESSION["test_language"] == "francais") {
        $_SESSION["correctAnswer"] = $frenchWord;
        $_SESSION["question"] = $italianWord;
    }
    header("Location: ../italien.php?success=writingTest".$status);
    exit();
}
