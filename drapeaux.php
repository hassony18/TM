<?php 
	require 'header.php';
	include_once $_SERVER['DOCUMENT_ROOT']."/TM/backend/score.backend.php";
    if (!isset($_SESSION['email'])) {
        die(header("location: index.php"));
    }
	$_SESSION["user_page"] = "drapeaux.php";
?>

<link rel="stylesheet" href="./styles/drapeaux.css" />

<body>
	<form action="drapeaux.php" method="post" id="countries-game">
		<img id="countryFlag" src="" alt="flag">
		<div id="centered_options">
			<input type="submit" class="options" name="submit_country" id="option0" value="">
			<input type="submit" class="options" name="submit_country" id="option1" value="">
			<input type="submit" class="options" name="submit_country" id="option2" value="">
			<input type="submit" class="options" name="submit_country" id="option3" value="">
		</div>
	</form>

	<script src="./js/countries.js"></script>
</body>

<?php
	$content = file_get_contents("http://localhost/TM/data/pays.json");
	$baseCountriesTable = json_decode($content, true);
	
	if (isset($_POST["submit_country"])) {
		verifyMultipleChoicesAnswer($_POST["submit_country"]);
	}

	function verifyMultipleChoicesAnswer($answer) {
		if ($answer == $_SESSION["correctAnswer"]) {
			addScore("drapeaux", 1);
			echo "<script>showNotification('success', 'Bien joué!');</script>";
			setupMultipleChoices();
		} else {
			addScore("drapeaux", -1);
			echo "<script>showNotification('error', 'Aïe aïe! La bonne réponse était ".addslashes($_SESSION["correctAnswer"])."');</script>";
			setupMultipleChoices();
		}
	}
	
	function setupMultipleChoices() {
		global $baseCountriesTable;
		$tempAnswerArray = array();
		$rand_keys = array_rand($baseCountriesTable, 4);
		$_SESSION["correctAnswer"] = $baseCountriesTable[$rand_keys[0]]["name"];
		array_push($tempAnswerArray, $_SESSION["correctAnswer"]);
		array_push($tempAnswerArray, $baseCountriesTable[$rand_keys[1]]["name"]);
		array_push($tempAnswerArray, $baseCountriesTable[$rand_keys[2]]["name"]);
		array_push($tempAnswerArray,  $baseCountriesTable[$rand_keys[3]]["name"]); // correct answer
		shuffle($tempAnswerArray);
		$_SESSION["answersList"] = json_encode($tempAnswerArray);
		$_SESSION["question"] = $baseCountriesTable[$rand_keys[0]]["alpha2"];
		echo "<script>showGame('".$_SESSION['question']."', ".$_SESSION['answersList'].");</script>";
	}
	setupMultipleChoices();
?>

<?php
	require 'footer.php';
?>