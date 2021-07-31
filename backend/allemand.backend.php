<?php

include_once $_SERVER['DOCUMENT_ROOT']."/TM/backend/score.backend.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!function_exists('str_contains')) {
    function str_contains(string $haystack, string $needle): bool
    {
        return '' === $needle || false !== strpos($haystack, $needle);
    }
}

$content = file_get_contents("http://localhost/TM/data/allemand.json");

$baseVocTable = json_decode($content, true);
    
if (isset($_POST["submit_vocSession"])) { // on submit request learning or testing
    prepareVocSession();
}

if (isset($_POST["requestReturnToAllemand"])) {
    header("Location: ../allemand.php");
    exit();
}

function prepareVocSession() {
    global $baseVocTable;

    $learningChoice = isset($_POST["apprendreOuTest"]); // apprendre ou test
    if (!$learningChoice) {
        header("Location: ../allemand.php?error=chooseLearningOption");
        exit();
    }
    $learningChoice = $_POST["apprendreOuTest"];// apprendre ou test

    $testChoice = isset($_POST["choixMultiplesOuEcrire"]); // choixMultiples ou ecrire
    if ($learningChoice == "test" && !$testChoice) {
        header("Location: ../allemand.php?error=chooseTestOption");
        exit();
    }
    $langue = isset($_POST["francaisOuAllemand"]); // francais ou allemand
    if ($learningChoice == "test" && !$langue) {
        header("Location: ../allemand.php?error=chooseLanguage");
        exit();
    }
    $language = $_POST["francaisOuAllemand"]; // francais ou allemand
    $testChoice = $_POST["choixMultiplesOuEcrire"]; // choixMultiples ou ecrire

    $selectedVocNums = array();
    foreach ($baseVocTable as $key => $value){
        $key = str_replace(".", "_", $key);
        if (isset($_POST[$key])) {
            $key = str_replace("_", ".", $key);
            array_push($selectedVocNums, $key);
        }
    }

    if (empty($selectedVocNums)) {
        echo '<script>alert("Tu dois choisir au moins un chapitre.")</script>';
        header("Location: ../allemand.php?error=chooseChapter");
        exit();
    }

    $includePhrases = isset($_POST["phrasesNormales"]);
    $includeBlue = isset($_POST["bleues"]);
    $includeBluePhrases = isset($_POST["phrasesBleues"]);

    $finalTable = array();
    foreach($selectedVocNums as $index => $vocNumber) {
        foreach ($baseVocTable[$vocNumber] as $vocType => $localVocTable) {
            if ($vocType == "phrase" && $includePhrases) {
                foreach ($localVocTable as $german => $french) {
                    array_push($finalTable, [$german, $french]);
                }
            } elseif ($vocType == "blue" && $includeBlue) {
                foreach ($localVocTable as $german => $french) {
                    array_push($finalTable, [$german, $french]);
                }
            } elseif ($vocType == "bluePhrases" && $includeBluePhrases) {
                foreach ($localVocTable as $german => $french) {
                    array_push($finalTable, [$german, $french]);
                }
            } elseif ($vocType == "normal") {
                foreach ($localVocTable as $german => $french) {
                    array_push($finalTable, [$german, $french]);
                }
            }
        }
    }
    if ($learningChoice == "apprendre") {
        $_SESSION["learningTable"] = $finalTable;
        header("Location: ../allemand.php?success=apprendre");
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
        header("Location: ../allemand.php?success=test");
        exit();
    }

}

// MULTIPLE CHOICES CODE

if (!isset($_SESSION["currentNumberInQueue"])) { 
    $_SESSION["currentNumberInQueue"] = 0;
}

if (isset($_POST["submit_multipleChoices"])) {
    verifyMultipleChoicesAnswer($_POST["submit_multipleChoices"]);
}

function verifyMultipleChoicesAnswer($answer) {
    $_SESSION["currentNumberInQueue"] = $_SESSION["currentNumberInQueue"] + 1;
	if ($answer == $_SESSION["correctAnswer"]) {
		addScore("allemand", 1);
        header("Location: ../allemand.php?success=correctAnswer");
        // remove from error list if the answer is correct
        if (isset( $_SESSION["errorTable"]) && !empty($_SESSION["errorTable"])) {
            foreach ($_SESSION["errorTable"] as $key => $value) {
                if ($value[0] == $answer || $value[1] == $answer) {
                    unset($_SESSION["errorTable"][$key]);
                }
            }
        }

        setupMultipleChoices("&answer=correct");
	} else {
		addScore("allemand", -1);
        header("Location: ../allemand.php?success=wrongAnswer");
        // add to error list
        if (!isset( $_SESSION["errorTable"]) || empty($_SESSION["errorTable"])) { 
            $tempArray = array();
        } else {
            $tempArray = $_SESSION["errorTable"];
        }
        array_push($tempArray, [$_SESSION["question"], $_SESSION["correctAnswer"]]);
        $_SESSION["errorTable"] = $tempArray;
        setupMultipleChoices("&answer=incorrect");
    }
}


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
                if ($_SESSION["test_language"] == "allemand") {
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
                shuffle($tempAnswerArray);
                $_SESSION["answersList"] = json_encode($tempAnswerArray);
                $_SESSION["errorNumber"] = $_SESSION["errorNumber"] + 1;
                header("Location: ../allemand.php?success=multipleChoices".$status);
                exit();
           } else { header("Location: ../allemand.php?success=doneStudying"); exit(); }
         } else { header("Location: ../allemand.php?success=doneStudying"); exit(); }
    } else {
        // if normal table ->
		$germanWord = $localLearningTable[$_SESSION["currentNumberInQueue"]][0]; // german text
		$frenchWord = $localLearningTable[$_SESSION["currentNumberInQueue"]][1]; // french text
		if (str_contains($germanWord, "%")) {
            $germanWord = str_replace("%", "", $germanWord);
		}
		if (str_contains($frenchWord, "%")) {
            $frenchWord = str_replace("%", "", $frenchWord);
		}
	}
    $tempAnswerArray = array();
    $rand_keys = array_rand($localLearningTable, 3);
	if ($_SESSION["test_language"] == "allemand") {
		$_SESSION["correctAnswer"] = $germanWord;
        $_SESSION["question"] = $frenchWord;
        array_push($tempAnswerArray, $localLearningTable[$rand_keys[0]][0]);
        array_push($tempAnswerArray, $localLearningTable[$rand_keys[1]][0]);
        array_push($tempAnswerArray, $localLearningTable[$rand_keys[2]][0]);
        array_push($tempAnswerArray, $germanWord); // correct answer
	} elseif ($_SESSION["test_language"] == "francais") {
        $_SESSION["correctAnswer"] = $frenchWord;
        $_SESSION["question"] = $germanWord;
        array_push($tempAnswerArray, $localLearningTable[$rand_keys[0]][1]);
        array_push($tempAnswerArray, $localLearningTable[$rand_keys[1]][1]);
        array_push($tempAnswerArray, $localLearningTable[$rand_keys[2]][1]);
        array_push($tempAnswerArray, $frenchWord); // correct answer
	}
    shuffle($tempAnswerArray);
    $_SESSION["answersList"] = json_encode($tempAnswerArray);
    header("Location: ../allemand.php?success=multipleChoices".$status);
    exit();

}

// test ecrire

if (isset($_POST["submit_ecrire_test"])) {
    if (isset($_POST["textAEcrire"])) {
        $answer = $_POST["textAEcrire"];
    }

    verifyWritingTestAnswer($answer);
}

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
    if ($canPass || $answer == $correctAnswer) {
        addScore("allemand", 1);
        header("Location: ../allemand.php?success=correctAnswer");
        // remove from error list if the answer is correct
        if (isset($_SESSION["errorTable"]) && !empty($_SESSION["errorTable"])) {
            foreach ($_SESSION["errorTable"] as $key => $value) {
                if ($value[0] == $answer || $value[1] == $answer) {
                    unset($_SESSION["errorTable"][$key]);
                }
            }
        }
        startWritingTest("&answer=correct");
    } else {
        addScore("allemand", -1);
        header("Location: ../allemand.php?success=wrongAnswer");
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
        startWritingTest("&answer=incorrect");
    }
}

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
                header("Location: ../allemand.php?success=writingTest".$status);
                $_SESSION["errorNumber"] = $_SESSION["errorNumber"] + 1;
                exit();
            } else { header("Location: ../allemand.php?success=doneStudying"); exit(); }
            } else { header("Location: ../allemand.php?success=doneStudying"); exit(); }
    } else {
        // if normal table ->
        $germanWord = $localLearningTable[$_SESSION["currentNumberInQueue"]][0]; // german text
        $frenchWord = $localLearningTable[$_SESSION["currentNumberInQueue"]][1]; // french text
        if (str_contains($germanWord, "%")) {
            $germanWord = str_replace("%", "", $germanWord);
        }
        if (str_contains($frenchWord, "%")) {
            $frenchWord = str_replace("%", "", $frenchWord);
        }
    }
    if ($_SESSION["test_language"] == "allemand") {
        $_SESSION["correctAnswer"] = $germanWord;
        $_SESSION["question"] = $frenchWord;
    } elseif ($_SESSION["test_language"] == "francais") {
        $_SESSION["correctAnswer"] = $frenchWord;
        $_SESSION["question"] = $germanWord;
    }
    header("Location: ../allemand.php?success=writingTest".$status);
    exit();
}
