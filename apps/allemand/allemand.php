<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="allemand.css">
	<title>test</title>
</head>
<body>
	<!-- Home page -->
	
	<div id="maincontainer" class="maincontainer">
		<div class="thecard">
			<div class="thefront">
				<h1>Der Mann</h1>
			</div>
			<div class="theback">
				<h1>L'homme</h1>
			</div>

		</div>
    </div>
	
	<form action="">
		<h1>Choisis ton mode d'apprentissage</h1>

		<h2>Choisis un ou plusieurs chapitres:</h2>
		<div id="vocCheckBoxesList"></div>
		<h2>Choisis le type d'apprentissage:</h2>
		<input type="radio" id="apprendreRadio" name="radio">
		<label for="apprendreRadio">Apprendre</label><br>
		<input type="radio" id="testRadio" name="radio">
		<label for="testRadio">Test</label><br>
		
		<h2>Options:</h2>
		<input type="checkbox" id="normalPhrasesOption">
		<label for="normalPhrasesOption">Avec les phrases normales</label><br>
		<input type="checkbox" id="blueOption">
		<label for="blueOption">Avec les bleues</label><br>
		<input type="checkbox" id="bluePhrasesOption">
		<label for="bluePhrasesOption">Avec les phrases bleues</label><br>
		
		<button onclick="prepareVocSession()" type="button">On y va!</button>
	</form>
	
	<script src="allemand.js"></script>
</body>
</html>