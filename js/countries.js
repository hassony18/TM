
var correctCountry = null; 
function runCountriesGame() {
	var randomKey = getRandomCountryKey() // un nombre aléatoire dans la liste de pays
	correctCountry = countriesList[randomKey]["name"]; // on cherche le nom du pays à partir du nombre aléatoire trouvé auparavant
	document.getElementById("countryFlag").src = "./styles/img/countries/"+countriesList[randomKey]["alpha2"]+".png"; // afficher le pays cible.
	var randomOption = getRandomInteger(1, 5) // choisis un nombre entre 1 et 4
	// générer aléatoirement les positions des boutons
	var listToUpdate = [1, 2, 3, 4] //liste qui va pouvoir être modifiée pour selectionner la position de la réponse
	for( var i = 0; i < listToUpdate.length; i++){  // boucle 
		if ( listToUpdate[i] === randomOption) {  // if statement
			listToUpdate.splice(i, 1);  // splice 
		}
	}
	document.getElementById("option" + randomOption ).innerHTML = correctCountry;
	for (var key in listToUpdate) {
		var randomShit = getRandomCountryKey()
		document.getElementById("option" + listToUpdate[key] ).innerHTML = countriesList[randomShit]["name"];
	}
}
function verify(element) { // appelé en choissisant un pays.
	var value = element.innerHTML
	if (value == correctCountry) { // si la bonne réponse, rajouter un point et relancer le jeu
		runCountriesGame()
		addScore("drapeaux", 1)
	} else {
		alert("Mince! La bonne réponse était '" + correctCountry +"'")
		runCountriesGame()
		addScore("drapeaux", -1)
	}

}
function getRandomCountryKey() {
	var keys = countriesList.length
	var randomKey = getRandomInteger(1, keys)
	return randomKey
}
function getRandomInteger(min, max) { // trouver un nombre aléatoire entre 2 valeurs.
	return Math.floor(Math.random() * (max - min) ) + min;
}

function addScore(gType, amount) { 
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'http://localhost/TM/backend/score.backend.php');
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.onload = function() {
		console.log('score request sent: ' + xhr.responseText);
	};
	xhr.send('score=' + amount + '&gType=' + gType);
}

runCountriesGame()