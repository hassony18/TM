<?php 
	require 'header.php';
?>


<link rel="stylesheet" href="styles/allemand.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

<body>
	<!-- Home page -->
	<div id="allemand_apprentissage_container">
		
		<div id="learningChoiceContainer">
			<form action="">
				<h1>Choisis ton mode d'apprentissage</h1>

				<h2>Choisis un ou plusieurs chapitres:</h2>
				<div id="vocCheckBoxesList"></div>
				<h2>Choisis le type d'apprentissage:</h2>
				<input type="radio" id="apprendreRadio" name="radio" onchange="onVocRadioValueChange()">
				<label for="apprendreRadio">Apprendre</label><br>
				<input type="radio" id="testRadio" name="radio" onchange="onVocRadioValueChange()">
				<label for="testRadio">Test</label><br>
				<div id="testOptionsContainer">
					-><input type="radio" id="radio_choix_multiple" name="radio2" onchange="onVocRadioValueChange()">
					<label for="radio_choix_multiple">Choix multiples</label><br>
					<div id="multipleChoicesOptionsContainer">
						--><input type="radio" id="radio_cherche_francais" name="radio3">
						<label for="radio_cherche_francais">Cherche le mot francais</label><br>
						--><input type="radio" id="radio_cherche_allemand" name="radio3">
						<label for="radio_cherche_allemand">Cherche le mot allemand</label><br>
					</div>
					-><input type="radio" id="radio_ecrire" name="radio2" onchange="onVocRadioValueChange()">
					<label for="radio_ecrire">Ecrire</label><br>
					<div id="ecrireOptionsContainer">
						--><input type="radio" id="radio_ecrire_francais" name="radio3">
						<label for="radio_ecrire_francais">Ecrire en francais</label><br>
						--><input type="radio" id="radio_ecrire_allemand" name="radio3">
						<label for="radio_ecrire_allemand">Ecrire en allemand</label><br>
					</div>
				</div>
				
				<h2>Options:</h2>
				<input type="checkbox" id="normalPhrasesOption">
				<label for="normalPhrasesOption">Avec les phrases normales</label><br>
				<input type="checkbox" id="blueOption">
				<label for="blueOption">Avec les bleues</label><br>
				<input type="checkbox" id="bluePhrasesOption">
				<label for="bluePhrasesOption">Avec les phrases bleues</label><br>
				
				<button onclick="prepareVocSession()" type="button">On y va!</button>
			</form>
		</div>
		
		<div id="cardContainer" class="cardContainer">
			<div class="theCard">
				<div class="theFront">
					<h1 id="faceText">FACE</h1>
				</div>
				<div class="theBack">
					<h1 id="backText">BACK</h1>
				</div>
			</div>
			<button onclick="nextVoc('next')" type="button"> => </button>
			<h2 id="words_counter_learning">COUNTER</h2>
			<button onclick="nextVoc('previous')" type="button"> <= </button>
			<br>
			<button onclick="nextVoc('done')" type="button"> Fini! </button>
		</div>
		
		<div id="multipleChoicesContainer">
			<h1 id="shownVocText">WORD HERE</h1>
			<h1 id="words_counter_multipleChoices">COUNTER</h1>
			<button id="choix_multiple_option1" onclick="verifyWord_multipleChoices(this)" type="button"> OPTION 1 </button>
			<button id="choix_multiple_option2" onclick="verifyWord_multipleChoices(this)" type="button"> OPTION 2 </button>
			<button id="choix_multiple_option3" onclick="verifyWord_multipleChoices(this)" type="button"> OPTION 3 </button>
			<button id="choix_multiple_option4" onclick="verifyWord_multipleChoices(this)" type="button"> OPTION 4 </button>
		</div>
		
		<div id="writingContainer">
			<h1 id="shownVocText_ecrire">WORD HERE</h1>
			<h1 id="words_counter_ecrire">COUNTER</h1>
			<label for="textAEcrire">Traduction:</label>
			<input type="text" id="textAEcrire" name="textAEcrire">
			<button id="verifyWord_ecrire_button" onclick="verifyWord_ecrire()" type="button"> ENTRER </button>
		</div>
		
		
	</div>
	
	<script src="js/allemand.js"></script>
</body>


<?php 
	require 'footer.php';
?>