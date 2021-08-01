<?php 
	require 'header.php';
	require_once 'backend/allemand.backend.php';

    if (!isset($_SESSION['email'])) {
        die(header("location: index.php"));
    }
	$_SESSION["user_page"] = "allemand.php";

	if (isset($_GET["error"])) {
		$error = $_GET["error"];
		if ($error == "chooseChapter") {
			echo "<script>showNotification('error', 'Tu dois choisir un chapitre');</script>";
		} elseif ($error == "chooseLearningOption") {
			echo "<script>showNotification('error', 'Tu dois choisir un mode d\'apprentissage.');</script>";
		}  elseif ($error == "chooseTestOption") {
			echo "<script>showNotification('error', 'Tu dois choisir un mode de test');</script>";
		}  elseif ($error == "chooseLanguage") {
			echo "<script>showNotification('error', 'Tu dois choisir une langue');</script>";
		} 
	}
?>


<link rel="stylesheet" href="styles/allemand.css">

<body>
	<!-- Home page -->

	<div id="allemand_apprentissage_container">
		
		<div id="learningChoiceContainer">
			<form action="backend/allemand.backend.php" method="post">
				<h1>Choix de mode d'apprentissage</h1>

				<h2 style="color: crimson;">Choisis un ou plusieurs chapitres:</h2>
				<div id="vocCheckBoxesList"> 
					<table>
						<?php
							foreach ($baseVocTable as $key => $value){
								echo '
								<td>
									<label class="checkbox_container_style">'.$key.'
											<input type="checkbox" name="'. str_replace(".", "_", $key) .'">
											<span class="checkbox_checkmark"></span>
									</label>
								</td>
								';
							}
						?>
					</table>
				</div>

				<h2 style="color: crimson;">Choisis le type d'apprentissage:</h2>
				
				<label class="radio_style_container">Apprendre
					<input type="radio" value="apprendre" name="apprendreOuTest" id="apprendreRadio" onchange="onVocRadioValueChange()">
					<span class="radio_style_checkmark"></span>
				</label>
				<label class="radio_style_container">Test
					<input type="radio" value="test" name="apprendreOuTest" id="testRadio" onchange="onVocRadioValueChange()">
					<span class="radio_style_checkmark"></span>
				</label>
				
				
				<div id="testOptionsContainer">
					<label class="radio_style_container">Choix multiples
						<input type="radio" name="choixMultiplesOuEcrire" value="choixMultiples" id="radio_choix_multiple" onchange="onVocRadioValueChange()">
						<span class="radio_style_checkmark"></span>
					</label>
					<div id="multipleChoicesOptionsContainer">
						<label class="radio_style_container">Cherche le mot francais
							<input type="radio" value="francais" name="francaisOuAllemand" id="radio_cherche_francais">
							<span class="radio_style_checkmark"></span>
						</label>
						<label class="radio_style_container">Cherche le mot allemand
							<input type="radio" value="allemand" name="francaisOuAllemand" id="radio_cherche_allemand">
							<span class="radio_style_checkmark"></span>
						</label>
					</div>
					<label class="radio_style_container">Ecrire
						<input type="radio" name="choixMultiplesOuEcrire" value="ecrire" id="radio_ecrire" onchange="onVocRadioValueChange()">
						<span class="radio_style_checkmark"></span>
					</label>
					<div id="ecrireOptionsContainer">
						<label class="radio_style_container">Ecrire en francais
							<input type="radio" value="francais" name="francaisOuAllemand" id="radio_ecrire_francais" onchange="onVocRadioValueChange()">
							<span class="radio_style_checkmark"></span>
						</label>
						<label class="radio_style_container">Ecrire en allemand
							<input type="radio" value="allemand" name="francaisOuAllemand" id="radio_ecrire_allemand" onchange="onVocRadioValueChange()">
							<span class="radio_style_checkmark"></span>
						</label>
					</div>	
				</div>
					
				<h2 style="color: crimson;">Options:</h2>
				<label class="checkbox_container_style">Avec les phrases normales
					<input id="normalPhrasesOption" name="phrasesNormales" type="checkbox">
					<span class="checkbox_checkmark"></span>
				</label>
				<label class="checkbox_container_style">Avec les bleues
					<input id="blueOption" name="bleues" type="checkbox">
					<span class="checkbox_checkmark"></span>
				</label>
				<label class="checkbox_container_style">Avec les phrases bleues
					<input id="bluePhrasesOption" name="phrasesBleues" type="checkbox">
					<span class="checkbox_checkmark"></span>
				</label>
					
				<input type="submit" name="submit_vocSession" value="On y va!">
			</form>
		</div>
		
		<div id="learningCardContainerBackground">
			<form action="backend/allemand.backend.php" method="post"><input type="submit" style="margin: 0; margin-bottom: 10px;" name="requestReturnToAllemand"  value="←"></form>
			<div id="cardContainer" class="cardContainer">
				<div class="theCard">
					<div class="theFront">
						<h1 id="faceText">FACE</h1>
					</div>
					<div class="theBack">
						<h1 id="backText">BACK</h1>
					</div>
				</div>
				<h2 id="words_counter_learning">COUNTER</h2>
				<table style="width:80%; margin-left: 10%;">
					<tr>
						<td><button onclick="nextVoc('previous')" type="button" class="floated"> ← </button></td>
						<td><button onclick="nextVoc('next')" type="button" class="floated"> → </button></td>
					</tr>
				</table>
				<button onclick="nextVoc('done')" type="button"> Fini! </button>
			</div>
		</div>

		<form action="backend/allemand.backend.php" method="post" id="multipleChoicesContainer">
			<input type="submit" style="margin: 0; margin-bottom: 10px;" name="requestReturnToAllemand"  value="←">
			<h1 id="shownVocText">WORD HERE</h1>
			<h1 id="words_counter_multipleChoices">COUNTER</h1>
			<input type="submit" name="submit_multipleChoices" id="choix_multiple_option0" value="">
			<input type="submit" name="submit_multipleChoices" id="choix_multiple_option1" value="">
			<input type="submit" name="submit_multipleChoices" id="choix_multiple_option2" value="">
			<input type="submit" name="submit_multipleChoices" id="choix_multiple_option3" value="">
		</form>
		
		<form action="backend/allemand.backend.php" method="post" id="writingContainer">
			<input type="submit" style="margin: 0; margin-bottom: 10px;" name="requestReturnToAllemand"  value="←">
			<h1 id="shownVocText_ecrire">WORD HERE</h1>
			<h1 id="words_counter_ecrire">COUNTER</h1>
			<label for="textAEcrire">Traduction:</label>
			<input type="text" id="textAEcrire" name="textAEcrire" autofocus>
			<input type="submit" name="submit_ecrire_test" value="Soumettre">
			<div id="keyboard_container">
				<table style="width:80%; margin-left: 10%;">
					<tr>
						<td colspan="5"><button id="changeCaseButton" onclick="changeCase()" type="button">↑</button></td>
					</tr>
					<tr>
						<td colspan="5"><h1 style="justify-content: center;">ALLEMAND</h1></td>
					</tr>
					<tr>
						<td><button class="keyboard_button" onclick="insertText(this)" type="button">ä</button></td>
						<td><button class="keyboard_button" onclick="insertText(this)" type="button">ö</button></td>
						<td><button class="keyboard_button" onclick="insertText(this)" type="button">ü</button></td>
						<td><button class="keyboard_button" onclick="insertText(this)" type="button">ß</button></td>
						<td><button class="keyboard_button" onclick="insertText(this)" type="button">¨</button></td>
					</tr>
					<tr>
						<td colspan="5"><h1>FRANÇAIS</h1></td>
					</tr>
					<tr>
						<td><button class="keyboard_button" onclick="insertText(this)" type="button">à</button></td>
						<td><button class="keyboard_button" onclick="insertText(this)" type="button">â</button></td>
						<td><button class="keyboard_button" onclick="insertText(this)" type="button">æ</button></td>
						<td><button class="keyboard_button" onclick="insertText(this)" type="button">ç</button></td>
					</tr>
					<tr>
						<td><button class="keyboard_button" onclick="insertText(this)" type="button">é</button></td>
						<td><button class="keyboard_button" onclick="insertText(this)" type="button">ê</button></td>
						<td><button class="keyboard_button" onclick="insertText(this)" type="button">ë</button></td>
						<td><button class="keyboard_button" onclick="insertText(this)" type="button">î</button></td>
					</tr>
					<tr>
						<td><button class="keyboard_button" onclick="insertText(this)" type="button">ô</button></td>
						<td><button class="keyboard_button" onclick="insertText(this)" type="button">œ</button></td>
						<td><button class="keyboard_button" onclick="insertText(this)" type="button">ù</button></td>
						<td><button class="keyboard_button" onclick="insertText(this)" type="button">û</button></td>
					</tr>
					<tr>
						<td><button class="keyboard_button" onclick="insertText(this)" type="button">è</button></td>
						<td><button class="keyboard_button" onclick="insertText(this)" type="button">ï</button></td>
						<td><button class="keyboard_button" onclick="insertText(this)" type="button">ü</button></td>
					</tr>

				</table>
			</div>
		</form>
		
		
	</div>
	
	<script src="js/allemand.js"></script>

	<?php
		if (isset($_GET["success"])) {

			$success = $_GET["success"];
			if ($success == "apprendre" && !$_SESSION["learningTable"]) {
				echo "<script>window.location.replace('allemand.php');</script>";
				return true;
			}
			if ($success == "apprendre") {
				echo "<script>startLearningSession(".json_encode($_SESSION['learningTable']).")</script>";
			} elseif ($success == "test") {
				echo "<script>startTestSession(".json_encode($_SESSION['learningTable']).", '".$_SESSION['test_choice']."', '".$_SESSION['test_language']."');</script>";
			} elseif ($success == "multipleChoices") {
				$tableToSend = null;
				$counter = null;
				if ($_SESSION["currentNumberInQueue"] >= count($_SESSION["learningTable"])) {
					$errorTable = $_SESSION["errorTable"];
					if (count($errorTable) > 0) {
						$tableToSend = $errorTable;
						$counter = $_SESSION['errorNumber'];
					}
				} else {
					$tableToSend = $_SESSION['learningTable'];
					$counter = $_SESSION['currentNumberInQueue'];
				}
				$num = count($tableToSend);
				echo "<script>showMultipleChoices('".addslashes($_SESSION['question'])."', ".$_SESSION['answersList'].", '".$counter."', '".$num."');</script>";
			} elseif ($success == "writingTest") {
				$tableToSend = null;
				$counter = null;
				if ($_SESSION["currentNumberInQueue"] >= count($_SESSION["learningTable"])) {
					$errorTable = $_SESSION["errorTable"];
					if (count($errorTable) > 0) {
						$tableToSend = $errorTable;
						$counter = $_SESSION['errorNumber'];
					}
				} else {
					$tableToSend = $_SESSION['learningTable'];
					$counter = $_SESSION['currentNumberInQueue'];
				}
				$num = count($tableToSend);
				echo "<script>showWritingTest('".addslashes($_SESSION['question'])."', '".$counter."', '".$num."');</script>";
			} elseif ($success == "doneStudying") {
				echo "<script>showNotification('error', 'hello world');</script>";
				//echo "<script>startCelebration();</script>";
			} 
		}

		if (isset($_GET["answer"])) {
			$answer = $_GET["answer"];
			if ($answer == "correct") {
				echo "<script>showNotification('success', 'Bien joué!');</script>";
			} elseif ($answer == "incorrect") {
				echo "<script>showNotification('error', 'Aïe aïe!');</script>";

			}
		}

	?>

</body>


<?php 
	require 'footer.php';
?>