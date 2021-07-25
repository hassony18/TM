
// load voc
// apprendre => Cartes tournantes
// Test => Choix Multiples ET ecrire (RANDOM)

var isLearning = false;
var learningTable = null;
var currentNumberInQueue = 0;
var correctAnswer = null;
var language = null;

document.getElementById("learningChoiceContainer").style.display = "block"
document.getElementById("cardContainer").style.display = "none"
document.getElementById("multipleChoicesContainer").style.display = "none"
document.getElementById("testOptionsContainer").style.display = "none"
document.getElementById("multipleChoicesOptionsContainer").style.display = "none"
document.getElementById("writingContainer").style.display = "none"
document.getElementById("ecrireOptionsContainer").style.display = "none"

var vocTable = false

fetch('./data/allemand.json').then(function(response) {
	return response.json();
}).then(function(data){
	runVocScript(data)
})


function onVocRadioValueChange() {
	var checkedTest = document.getElementById("testRadio").checked;	
	var checkedChoixMultiple = document.getElementById("radio_choix_multiple").checked;	
	var checkedEcrire = document.getElementById("radio_ecrire").checked;	
	if (checkedTest) {
		document.getElementById("testOptionsContainer").style.display = "block"
	} else {
		document.getElementById("testOptionsContainer").style.display = "none"
	}
	if (checkedChoixMultiple) {
		document.getElementById("multipleChoicesOptionsContainer").style.display = "block"
	} else {
		document.getElementById("multipleChoicesOptionsContainer").style.display = "none"
	}
	if (checkedEcrire) {
		document.getElementById("ecrireOptionsContainer").style.display = "block"
	} else {
		document.getElementById("ecrireOptionsContainer").style.display = "none"
	}
}; 

function runVocScript(json) {
	var data = json
	// add voc lists into div
	for (key in data) {
		var input = document.createElement("INPUT");
		var label = document.createElement("LABEL");
		input.setAttribute("type", "checkbox");
		input.setAttribute("class", "vocListCheckboxes");
		input.setAttribute("name", key);
		label.setAttribute("for", key);
		label.setAttribute("id", "Label: " + key);
		document.getElementById("vocCheckBoxesList").appendChild(label);
		document.getElementById("vocCheckBoxesList").appendChild(input);
		document.getElementById("Label: " + key).innerHTML = key;
	}
	
	vocTable = data
	//document.getElementById("test").innerHTML = JSON.stringify(data["1.1"]["normal"]["Hallo"])
}

function prepareVocSession() {
	// radio buttons
	var learnOption = document.getElementById('apprendreRadio').checked;
	var testOption = document.getElementById('testRadio').checked;	
	if (!testOption && !learnOption) {
		alert("Tu dois choisir un mode d'apprentissage.");
		return false;
	}
	// checkboxes, extra options
	var includePhrases = document.getElementById('normalPhrasesOption').checked;
	var includeBlue = document.getElementById('blueOption').checked;
	var includeBluePhrases = document.getElementById('bluePhrasesOption').checked;
	var localVocTable = [];
    var checkbox = document.getElementsByClassName("vocListCheckboxes");
	var selectedAnything = false
 	for (var i = 0; i < checkbox.length; i++) {
	   var isChecked = checkbox[i].checked
	   if (isChecked) {
			selectedAnything = true
			localVocTable[i] = vocTable[checkbox[i].name]
	   }
	}
	if (!selectedAnything) {
		alert("Tu dois choisir au moins un chapitre.");
		return false;
	}
	var tableToSend = [];
	// mix all tables
	for (key in localVocTable) {
		for (index in localVocTable[key]) {			
			if (index == "phrase" && includePhrases) {
				tableToSend.push(localVocTable[key][index]);
			} else if (index == "blue" && includeBlue) {
				tableToSend.push(localVocTable[key][index]);
			} else if (index == "bluePhrases" && includeBluePhrases) {
				tableToSend.push(localVocTable[key][index]);
			} else if (index == "normal") {
				tableToSend.push(localVocTable[key][index]);
			}
		}
	}
	// create my final table
	var finalTable = [];
	for (var i = 0; i < tableToSend.length; i++) {
		for (germanKey in tableToSend[i]) {
			finalTable.push([germanKey, tableToSend[i][germanKey]])
		}
	}
	if (learnOption) {
		startLearningSession(finalTable)
	} else if (testOption) {
		var checkedChoixMultiple = document.getElementById("radio_choix_multiple").checked;	
		var checkedEcrire = document.getElementById("radio_ecrire").checked;	
		if (!checkedEcrire && !checkedChoixMultiple) {
			alert("Choisis un mode de test.")
			return true;
		}
		if (checkedEcrire) {
			var checkedFrench = document.getElementById("radio_ecrire_francais").checked;	
			var checkedGerman = document.getElementById("radio_ecrire_allemand").checked;	
			if (!checkedFrench && !checkedGerman) {
				alert("Choisis un mode de test.")
				return true;
			}
			if (checkedFrench) {
				startTestSession(finalTable, "ecrire", "french")
			} 
			else if (checkedGerman) {
				startTestSession(finalTable, "ecrire", "german")
			}
			return true;
		}
		if (checkedChoixMultiple) {
			var checkedFrench = document.getElementById("radio_cherche_francais").checked;	
			var checkedGerman = document.getElementById("radio_cherche_allemand").checked;	
			if (!checkedFrench && !checkedGerman) {
				alert("Choisis un mode de test.")
				return true;
			}
			if (checkedFrench) {
				startTestSession(finalTable, "multipleChoices", "french")
			} 
			else if (checkedGerman) {
				startTestSession(finalTable, "multipleChoices", "german")
			}
			return true;
		}
	}
}

function getRandomInteger(min, max) { // trouver un nombre aléatoire entre 2 valeurs.
	return Math.floor(Math.random() * (max - min) ) + min;
}

// testing

function verifyWord_ecrire() {
	var answer = document.getElementById("textAEcrire").value;
	var answer1 = correctAnswer.split(",")[0]
	var answer2 = correctAnswer.split(", ")[1]
	console.log(language)
	if (answer == correctAnswer || (answer == answer1) || (answer == answer2 && language == "german") ) {
		alert("GJ")
		setupEcrire(currentNumberInQueue++)
	} else {
		alert("NO")
	}
}

function verifyWord_multipleChoices(e) {
	var answer = e.innerHTML
	if (answer == correctAnswer) {
		alert("GJ")
		setupMultipleChoices(currentNumberInQueue++)
	} else {
		alert("NO")
	}
}

function setupMultipleChoices(num) {
	var germanWord = learningTable[currentNumberInQueue][0] // german text
	var frenchWord = learningTable[currentNumberInQueue][1] // french text
	document.getElementById("learningChoiceContainer").style.display = "none"
	document.getElementById("multipleChoicesContainer").style.display = "block"
	document.getElementById("words_counter_multipleChoices").innerHTML = (currentNumberInQueue+1)+"/"+ learningTable.length
	if (language == "french") {
		document.getElementById("shownVocText").innerHTML = frenchWord
		correctAnswer = germanWord
	} else if (language == "german") {
		document.getElementById("shownVocText").innerHTML = germanWord
		correctAnswer = frenchWord
	}
	var randomOption = getRandomInteger(1, 5) // choisis un nombre entre 1 et 4
	// générer aléatoirement les positions des boutons
	var listToUpdate = [1, 2, 3, 4] //liste qui va pouvoir être modifiée pour selectionner la position de la réponse
	for( var i = 0; i < listToUpdate.length; i++){  // boucle 
		if ( listToUpdate[i] === randomOption) {  // if statement
			listToUpdate.splice(i, 1);  // splice 
		}
	}
	document.getElementById("choix_multiple_option" + randomOption ).innerHTML = correctAnswer;
	for (var key in listToUpdate) {
		var randomWord = getRandomInteger(0, learningTable.length)
		if (language == "french") {
			document.getElementById("choix_multiple_option" + listToUpdate[key] ).innerHTML = learningTable[randomWord][0];
		} else if (language == "german") {
			document.getElementById("choix_multiple_option" + listToUpdate[key] ).innerHTML = learningTable[randomWord][1];
		}
	}
}

function setupEcrire(num) {
	var germanWord = learningTable[currentNumberInQueue][0] // german text
	var frenchWord = learningTable[currentNumberInQueue][1] // french text
	document.getElementById("learningChoiceContainer").style.display = "none"
	document.getElementById("writingContainer").style.display = "block"
	document.getElementById("words_counter_ecrire").innerHTML = (currentNumberInQueue+1)+"/"+ learningTable.length
	if (language == "french") {
		document.getElementById("shownVocText_ecrire").innerHTML = frenchWord
		correctAnswer = germanWord
	} else if (language == "german") {
		document.getElementById("shownVocText_ecrire").innerHTML = germanWord
		correctAnswer = frenchWord
	}
}

function startTestSession(table, testType, lng) {
	learningTable = table
	currentNumberInQueue = 0
	language = lng
	if (testType == "multipleChoices") {
		setupMultipleChoices(currentNumberInQueue)
	} else if (testType == "ecrire") {
		setupEcrire(currentNumberInQueue)
	}
}



// learning 

function startLearningSession(table) {
	if (isLearning) {
		return false;
	}
	learningTable = table
	isLearning = true;
	document.getElementById("learningChoiceContainer").style.display = "none"
	document.getElementById("cardContainer").style.display = "block"
	nextVoc("start")
}

function nextVoc(type) {
	if (!isLearning) {
		return false
	}
	if (type == "start") {
		currentNumberInQueue = 0
	}
	else if (type == "next") {
		if (currentNumberInQueue == learningTable.length) {
			currentNumberInQueue = learningTable.length
		} else {
			currentNumberInQueue++
		}
	}
	else if (type == "previous") {
		if (currentNumberInQueue == 0) {
			currentNumberInQueue = 0
		} else {
			currentNumberInQueue--
		}
	}
	else if (type == "done") {
		document.getElementById("learningChoiceContainer").style.display = "block"
		document.getElementById("cardContainer").style.display = "none"
		isLearning = null;
		learningTable = null;
	}
	document.getElementById("faceText").innerHTML = learningTable[currentNumberInQueue][0] // german text
	document.getElementById("backText").innerHTML = learningTable[currentNumberInQueue][1] // french text
	document.getElementById("words_counter_learning").innerHTML = (currentNumberInQueue+1)+"/"+ (learningTable.length) // french text
}
