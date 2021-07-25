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
				<h1>Choix de mode d'apprentissage</h1>

				<h2 style="color: crimson;">Choisis un ou plusieurs chapitres:</h2>
				<div id="vocCheckBoxesList"></div>
				<h2 style="color: crimson;">Choisis le type d'apprentissage:</h2>
				
				<label class="radio_style_container">Apprendre
				  <input type="radio" name="radio" id="apprendreRadio" onchange="onVocRadioValueChange()">
				  <span class="radio_style_checkmark"></span>
				</label>
				<label class="radio_style_container">Test
				  <input type="radio" name="radio" id="testRadio" onchange="onVocRadioValueChange()">
				  <span class="radio_style_checkmark"></span>
				</label>
				
				
				<div id="testOptionsContainer">
				
					<label class="radio_style_container">Choix multiples
					  <input type="radio" name="radio2" id="radio_choix_multiple" onchange="onVocRadioValueChange()">
					  <span class="radio_style_checkmark"></span>
					</label>

						<div id="multipleChoicesOptionsContainer">
							<label class="radio_style_container">Cherche le mot francais
							  <input type="radio" name="radio3" id="radio_cherche_francais">
							  <span class="radio_style_checkmark"></span>
							</label>
							<label class="radio_style_container">Cherche le mot allemand
							  <input type="radio" name="radio3" id="radio_cherche_allemand">
							  <span class="radio_style_checkmark"></span>
							</label>
						</div>
					
					<label class="radio_style_container">Ecrire
					  <input type="radio" name="radio2" id="radio_ecrire" onchange="onVocRadioValueChange()">
					  <span class="radio_style_checkmark"></span>
					</label>
					
						<div id="ecrireOptionsContainer">
							<label class="radio_style_container">Ecrire en francais
							  <input type="radio" name="radio3" id="radio_ecrire_francais" onchange="onVocRadioValueChange()">
							  <span class="radio_style_checkmark"></span>
							</label>
							<label class="radio_style_container">Ecrire en allemand
							  <input type="radio" name="radio3" id="radio_ecrire_allemand" onchange="onVocRadioValueChange()">
							  <span class="radio_style_checkmark"></span>
							</label>
						</div>
						
				</div>
				
				<h2 style="color: crimson;">Options:</h2>
				<label class="checkbox_container_style">Avec les phrases normales
					<input id="normalPhrasesOption" type="checkbox">
					<span class="checkbox_checkmark"></span>
				</label>
				<label class="checkbox_container_style">Avec les bleues
					<input id="blueOption" type="checkbox">
					<span class="checkbox_checkmark"></span>
				</label>
				<label class="checkbox_container_style">Avec les phrases bleues
					<input id="bluePhrasesOption" type="checkbox">
					<span class="checkbox_checkmark"></span>
				</label>
				
				<button onclick="prepareVocSession()" type="button" id="startSessionButton">On y va!</button>
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
			<h2 id="words_counter_learning">COUNTER</h2>
			<button onclick="nextVoc('next')" type="button" class="floated"> → </button>
			<button onclick="nextVoc('previous')" type="button" class="floated"> ← </button>
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