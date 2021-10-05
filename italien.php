<?php 
	require 'header.php';
	require_once 'backend/italien.backend.php';

    if (!isset($_SESSION['email'])) {
        die(header("location: index.php"));
    }
	$_SESSION["user_page"] = "italien.php";

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

<?
	$filename = 'styles/italien.css';
	$fileModified = substr(md5(filemtime($filename)), 0, 6);
?>
<link rel="stylesheet" href="<?php echo $filename."?v=".$fileModified;?>">

<body>
	<!-- Home page -->

	<div id="italien_apprentissage_container">
		
		<div id="learningChoiceContainer">
			<form action="backend/italien.backend.php" method="post">
				<h1>Le vocabulaire d’italien</h1>
				<p>Vous souhaitez donc apprendre l’italien. Pour cela, nous vous offrons le vocabulaire d’italien progetto italiano 1 et 2. Ce vocabulaire est séparé par différentes unités. Les unités du premier livre sont notées 1.X et celle du deuxième, 2.X. Il existe également des phrases accompagnant ces unités, même si ces phrases restent rares. Pour les voir, il vous suffit de sélectionner l’option « phrases ».</p>
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
				
				
				<div id="testOptionsContainer" style="margin-left: 5%;">
					<label class="radio_style_container">Choix multiples
						<input type="radio" name="choixMultiplesOuEcrire" value="choixMultiples" id="radio_choix_multiple" onchange="onVocRadioValueChange()">
						<span class="radio_style_checkmark"></span>
					</label>
					<div id="multipleChoicesOptionsContainer" style="margin-left: 5%;">
						<label class="radio_style_container">Cherche le mot francais
							<input type="radio" value="francais" name="francaisOuItalien" id="radio_cherche_francais">
							<span class="radio_style_checkmark"></span>
						</label>
						<label class="radio_style_container">Cherche le mot italien
							<input type="radio" value="italien" name="francaisOuItalien" id="radio_cherche_italien">
							<span class="radio_style_checkmark"></span>
						</label>
					</div>
					<label class="radio_style_container">Ecrire
						<input type="radio" name="choixMultiplesOuEcrire" value="ecrire" id="radio_ecrire" onchange="onVocRadioValueChange()">
						<span class="radio_style_checkmark"></span>
					</label>
					<div id="ecrireOptionsContainer" style="margin-left: 5%;">
						<label class="radio_style_container">Ecrire en francais
							<input type="radio" value="francais" name="francaisOuItalien" id="radio_ecrire_francais" onchange="onVocRadioValueChange()">
							<span class="radio_style_checkmark"></span>
						</label>
						<label class="radio_style_container">Ecrire en italien
							<input type="radio" value="italien" name="francaisOuItalien" id="radio_ecrire_italien" onchange="onVocRadioValueChange()">
							<span class="radio_style_checkmark"></span>
						</label>
					</div>	
				</div>
				<!--
				<h2 style="color: crimson;">Options:</h2>
				<label class="checkbox_container_style">Avec les phrases normales
					<input id="normalPhrasesOption" name="phrasesNormales" type="checkbox">
					<span class="checkbox_checkmark"></span>
				</label>
				-->
				<input type="submit" name="submit_vocSession" value="On y va!">
			</form>
		</div>
		
		<div id="learningCardContainerBackground">
			<form action="backend/italien.backend.php" method="post"><input type="submit" style="margin: 0; margin-bottom: 10px;" name="requestReturnToItalien"  value="←"></form>
			<div id="cardContainer" class="cardContainer">
				<div class="theCard" id="flippingCard" onclick="">
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
				<img onclick="listenToWord()" id="listenTo" src="styles/img/speaker.png">
				<button onclick="nextVoc('done')" type="button"> Fini! </button>
				<button id="flipButton" onclick="flipCard()" type="button"> Flip! </button>
				<button id="voirLaListe" onclick="showList()" type="button"> Voir la liste entière </button>
			</div>
			
			
			<!-- The Modal -->
			<div id="previewContainer">
				<img id="closePreview" src="styles/img/close.png"></span>
				<div id="previewImage">
					<table id="vocTableList"></table>
				</div>
			</div>
		</div>

		<form action="backend/italien.backend.php" method="post" id="multipleChoicesContainer">
			<input type="submit" style="margin: 0; margin-bottom: 10px;" name="requestReturnToItalien"  value="←">
			<h1 id="shownVocText">WORD HERE</h1>
			<h1 id="words_counter_multipleChoices">COUNTER</h1>
			<input type="submit" name="submit_multipleChoices" id="choix_multiple_option0" value="">
			<input type="submit" name="submit_multipleChoices" id="choix_multiple_option1" value="">
			<input type="submit" name="submit_multipleChoices" id="choix_multiple_option2" value="">
			<input type="submit" name="submit_multipleChoices" id="choix_multiple_option3" value="">
		</form>
		
		<form action="backend/italien.backend.php" method="post" id="writingContainer">
			<!-- ENTER BUG FIX -->
			<input type="submit" name="submit_ecrire_test" value="Soumettre" style="opacity: 0; float: left;" />
			<input type="submit" style="margin: 0; margin-bottom: 10px;" name="requestReturnToItalien"  value="←">
			<h1 id="shownVocText_ecrire">WORD HERE</h1>
			<h1 id="words_counter_ecrire">COUNTER</h1>
			<label for="textAEcrire">Traduction:</label>
			<input type="text" class="input_text" id="textAEcrire" name="textAEcrire" autofocus>
			<input type="submit" name="submit_ecrire_test" value="Soumettre">
		</form>
		
		
	</div>
	
	<script src="js/italien.js"></script>

	<?php
		if (isset($_GET["success"])) {

			$success = $_GET["success"];
			if ($success == "apprendre" && !$_SESSION["learningTable"]) {
				echo "<script>window.location.replace('italien.php');</script>";
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
				//echo "<script>showNotification('error', 'hello world');</script>";
				//echo "<script>startCelebration();</script>";
			} 
		}

		if (isset($_GET["answer"])) {
			$answer = $_GET["answer"];
			if ($answer == "correct") {
				echo "<script>showNotification('success', 'Bien joué! Tu étais à ".round($_GET["percentage"])."% de la bonne réponse, La bonne réponse était: ".$_GET["correctAnswer"]."');</script>";
			} elseif ($answer == "incorrect") {
				echo "<script>showNotification('error', 'Aïe aïe! La bonne réponse était: ".$_GET["correctAnswer"]." ');</script>";

			}
		}

	?>

</body>


<?php 
	require 'footer.php';
?>