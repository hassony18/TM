<?php 
	require 'header.php';
	include_once $_SERVER['DOCUMENT_ROOT']."/backend/score.backend.php";
    if (!isset($_SESSION['email'])) {
        die(header("location: index.php"));
    }
	$_SESSION["user_page"] = "drapeaux.php";
?>

<?
	$filename = 'styles/drapeaux.css';
	$fileModified = substr(md5(filemtime($filename)), 0, 6);
?>
<link rel="stylesheet" href="<?php echo $filename."?v=".$fileModified;?>">

<body>
	<div id="drapeaux_choisir_container">
		<h1 style="text-align: center;">Drapeaux du monde</h1>
		<p>Vous souhaitez donc apprendre les drapeaux du monde. Le mode test prendre la forme d’un qcm où un drapeaux vous sera donné et vous devrez choisir parmi 4 possibilités de réponses. Si vous vous trompez, on vous donnera la bonne réponse à droite de l’écran.</p>
		<h2 style="text-align: center;">Choix de mode d'apprentissage</h2>
		<form action="backend/drapeaux.backend.php" method="post">
			<label class="radio_style_container">Apprendre
			  <input type="radio" name="apprendreOuTest" id="testmap" value="apprendre" required>
			  <span class="radio_style_checkmark"></span>
			</label>
			<label class="radio_style_container">Test
			  <input type="radio" name="apprendreOuTest" id="nbPays" value="test" >
			  <span class="radio_style_checkmark"></span>
			</label>
			<input type="submit" name="commencer_test" value="Soumettre">
		</form>
	</div>
	
	<div id="drapeaux_learning_container">
		<form action="backend/drapeaux.backend.php" method="post"><input type="submit" style="margin: 0; margin-bottom: 10px;" name="requestReturnToDrapeaux"  value="←"></form>
		<div id="cardContainer" class="cardContainer">
			<div class="theCard" id="flippingCard" onclick="">
				<div class="theFront">
					<img id="faceImg" src="" alt="country flag">
				</div>
				<div class="theBack">
					<h1 id="backText">BACK</h1>
				</div>
			</div>
			<h2 id="words_counter_learning" style="text-align: center;">COUNTER</h2>
			<table style="width:80%; margin-left: 10%;">
				<tr>
					<td><button onclick="nextVoc('previous')" type="button" class="floated"> ← </button></td>
					<td><button onclick="nextVoc('next')" type="button" class="floated"> → </button></td>
				</tr>
			</table>
			<button onclick="nextVoc('done')" type="button"> Fini! </button>
			<button id="flipButton" onclick="flipCard()" type="button"> Flip! </button>
		</div>
	</div>

	<div id="countries-game">
		<form action="backend/drapeaux.backend.php" method="post"><input type="submit" style="margin: 0; margin-bottom: 10px;" name="requestReturnToDrapeaux"  value="←"></form>
		<form action="drapeaux.php" method="post">
			<img id="countryFlag" src="" alt="flag">
			<div id="centered_options">
				<input type="submit" class="options" name="submit_country" id="option0" value="">
				<input type="submit" class="options" name="submit_country" id="option1" value="">
				<input type="submit" class="options" name="submit_country" id="option2" value="">
				<input type="submit" class="options" name="submit_country" id="option3" value="">
			</div>
		</form>
	</div>

	<script src="./js/countries.js"></script>
</body>

<?php
	$content = file_get_contents("data/pays.json");
	$baseCountriesTable = json_decode($content, true);
	
	
	if (isset($_GET["success"])) {
		$success = $_GET["success"];
		if ($success == "learn") {
			echo "<script>startLearning(".$content.");</script>";
		} elseif ($success == "test") {				
			setupMultipleChoices();
		}
	}
	
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
?>

<?php
	require 'footer.php';
?>