
// load voc
// apprendre => Cartes tournantes
// Test => Choix Multiples ET ecrire (RANDOM)

var vocTable = false

var isLearning = false;
var learningTable = null;
var errorsTable = null;
var currentNumberInQueue = 0;
var correctAnswer = null;
var language = null;
var errorNum = null;

function loadPage() {
	isLearning = false;
	learningTable = null;
	errorsTable = null;
	currentNumberInQueue = 0;
	correctAnswer = null;
	language = null;
	errorNum = null;
	document.getElementById("learningChoiceContainer").style.display = "block" // block
	document.getElementById("learningCardContainerBackground").style.display = "none" // none
	document.getElementById("multipleChoicesContainer").style.display = "none"
	document.getElementById("testOptionsContainer").style.display = "none"
	document.getElementById("multipleChoicesOptionsContainer").style.display = "none"
	document.getElementById("writingContainer").style.display = "none"
	document.getElementById("ecrireOptionsContainer").style.display = "none"
}
loadPage()

function changeCase() {
	var els = document.getElementsByClassName("keyboard_button");
	var changeCaseButton = document.getElementById("changeCaseButton");
	for (var i = 0; i < els.length; i++) {
		if (changeCaseButton.innerHTML == "↑") {
			if (els[i].innerHTML == "ß") {
				els[i].innerHTML = "ẞ"
			} else { 
				els[i].innerHTML = els[i].innerHTML.toUpperCase()
			}
		} else {
			if (els[i].innerHTML == "ẞ") {
				els[i].innerHTML = "ß"
			} else { 
			els[i].innerHTML = els[i].innerHTML.toLowerCase()
			}
		}
	}
	if (changeCaseButton.innerHTML == "↑") {
		changeCaseButton.innerHTML = "↓";
	} else if  (changeCaseButton.innerHTML == "↓") {
		changeCaseButton.innerHTML = "↑";
	} 
}

function insertText(e) {
	var text = document.getElementById("textAEcrire").value;
	var letter = e.innerHTML
	document.getElementById("textAEcrire").value = text + "" + letter
}

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
	var table = document.createElement("TABLE");
	table.setAttribute("id", "vocListTableHTML");
	var tr = document.createElement("TR");
	for (key in data) {
		var td = document.createElement("TD");
		var input = document.createElement("INPUT");
		var label = document.createElement("LABEL");
		var span = document.createElement("SPAN");

		label.setAttribute("class", "checkbox_container_style");
		label.innerHTML = key;
		
		input.setAttribute("type", "checkbox");
		input.setAttribute("class", "vocListCheckboxes");
		input.setAttribute("name", key);
		input.setAttribute("id", key);
		
		span.setAttribute("class", "checkbox_checkmark")
		
		label.appendChild(input);
		label.appendChild(span);

		tr.appendChild(td)
		td.appendChild(label)
		document.getElementById("vocCheckBoxesList").appendChild(td);
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
		errorsTable = [];
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
			errorsTable = [];
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
	var playerAnswer = document.getElementById("textAEcrire").value;
	var playerAnswer = playerAnswer.split(/\s+/).join('')
	var question = document.getElementById("shownVocText_ecrire").innerHTML;
	if (!correctAnswer) {
		return false;
	}
	var correctAnswerPart1 = correctAnswer.split(",")[0]	
	var correctAnswerPart2 = correctAnswer.split(",")[1]
	var correctAnswerPart3 = correctAnswer.split(",")[2]
	if (!playerAnswer.match(/\([^()]*\)/g)) { // s'il ne possede pas ()
		correctAnswerPart1 = correctAnswer.split(",")[0].replace(/\([^()]*\)/g, '')
		if (correctAnswerPart2) {
			correctAnswerPart2 = correctAnswerPart2.replace(/\([^()]*\)/g, '') 
			correctAnswerPart2 = correctAnswerPart2.split(/\s+/).join('')
		}
		if (correctAnswerPart3) {
			correctAnswerPart3 = correctAnswerPart3.replace(/\([^()]*\)/g, '')
			correctAnswerPart3 = correctAnswerPart3.split(/\s+/).join('')
		}
	}
	correctAnswerPart1 = correctAnswerPart1.split(/\s+/).join('') // enlever les espaces
	var canPass = false;
	// search for synonymes
	for (k in learningTable) {
		if (learningTable[k][0] == question || learningTable[k][1] == question) {
			if (learningTable[k][0] == playerAnswer || learningTable[k][1] == playerAnswer) {
				canPass = true;
			}
		}
	}
	if (canPass || playerAnswer == correctAnswer || (playerAnswer == correctAnswerPart1) || (playerAnswer == correctAnswerPart2 && language == "french") || (playerAnswer == correctAnswerPart3 && language == "french") ) {
		console.log("correct answer")
		addScore("allemand", 1)
	} else {
		console.log("wrong answer")
		addScore("allemand", -1)
		errorsTable.push([question, correctAnswer]) // word, answer
	}
	currentNumberInQueue++
	setupEcrire()
}

function verifyWord_multipleChoices(e) {
	var answer = e.innerHTML
	var question = document.getElementById("shownVocText").innerHTML;
	if (!correctAnswer) {
		return false;
	}
	if (answer == correctAnswer) {
		console.log("correct answer")
		addScore("allemand", 1)
	} else {
		console.log("wrong answer")
		addScore("allemand", -1)
		errorsTable.push([question, correctAnswer]) // word, answer
	}
	currentNumberInQueue++
	setupMultipleChoices()
}

function setupMultipleChoices() {
	var num = currentNumberInQueue + 1 
	if (num > learningTable.length) {
		if (errorsTable.length > 0) {
			if (!errorNum && errorNum !== 0) {
				errorNum = 0
			} else {
				errorNum++
			}
			if (errorNum >= errorsTable.length) {
				doneStudying()
				return false;
			}
			var germanWord = errorsTable[errorNum][0] // word
			var frenchWord = errorsTable[errorNum][1] // answer
			var myerrorNumToShow = errorNum + 1
			document.getElementById("words_counter_multipleChoices").innerHTML = (myerrorNumToShow)+"/"+ errorsTable.length
		} else {
			doneStudying()
			return true;
		}
	} else {
		var germanWord = learningTable[currentNumberInQueue][0] // german text
		var frenchWord = learningTable[currentNumberInQueue][1] // french text
		document.getElementById("words_counter_multipleChoices").innerHTML = (num)+"/"+ learningTable.length
	}
	document.getElementById("learningChoiceContainer").style.display = "none"
	document.getElementById("multipleChoicesContainer").style.display = "block"
	document.getElementById("words_counter_multipleChoices").innerHTML = (num)+"/"+ learningTable.length
	if (language == "german") {
		document.getElementById("shownVocText").innerHTML = frenchWord
		correctAnswer = germanWord
	} else if (language == "french") {
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
	var alreadyUsedWords = []
	for (var key in listToUpdate) {
		var randomWord = getRandomInteger(0, learningTable.length)
		// prevent repetition
		while (alreadyUsedWords[randomWord]) {
			randomWord = getRandomInteger(0, learningTable.length)
		} 
		alreadyUsedWords[randomWord] = true;
		if (language == "german") {
			document.getElementById("choix_multiple_option" + listToUpdate[key] ).innerHTML = learningTable[randomWord][0];
		} else if (language == "french") {
			document.getElementById("choix_multiple_option" + listToUpdate[key] ).innerHTML = learningTable[randomWord][1];
		}
	}
}

function setupEcrire() {
	var num = currentNumberInQueue + 1 
	if (num > learningTable.length) {
		if (errorsTable.length > 0) {
			if (!errorNum && errorNum !== 0) {
				errorNum = 0
			} else {
				errorNum++
			}
			if (errorNum >= errorsTable.length) {
				doneStudying()
				return false;
			}
			var germanWord = errorsTable[errorNum][0] // word
			var frenchWord = errorsTable[errorNum][1] // answer
			var myerrorNumToShow = errorNum + 1
			document.getElementById("words_counter_ecrire").innerHTML = (myerrorNumToShow)+"/"+ errorsTable.length
		} else {
			doneStudying()
			return true;
		}
	} else {
		var germanWord = learningTable[currentNumberInQueue][0] // german text
		var frenchWord = learningTable[currentNumberInQueue][1] // french text
		document.getElementById("words_counter_ecrire").innerHTML = (num)+"/"+ learningTable.length
	}
	document.getElementById("learningChoiceContainer").style.display = "none"
	document.getElementById("writingContainer").style.display = "block"
	if (language == "german") {
		document.getElementById("shownVocText_ecrire").innerHTML = frenchWord
		correctAnswer = germanWord
	} else if (language == "french") {
		document.getElementById("shownVocText_ecrire").innerHTML = germanWord
		correctAnswer = frenchWord
	}
}

function startTestSession(table, testType, lng) {
	
	learningTable = shuffle(table)
	currentNumberInQueue = 0
	language = lng
	if (testType == "multipleChoices") {
		setupMultipleChoices()
	} else if (testType == "ecrire") {
		setupEcrire()
	}
}

function shuffle(array) {
	var currentIndex = array.length,  randomIndex;
  
	// While there remain elements to shuffle...
	while (0 !== currentIndex) {
  
	  // Pick a remaining element...
	  randomIndex = Math.floor(Math.random() * currentIndex);
	  currentIndex--;
  
	  // And swap it with the current element.
	  [array[currentIndex], array[randomIndex]] = [
		array[randomIndex], array[currentIndex]];
	}
  
	return array;
  }

// learning 

function startLearningSession(table) {
	if (isLearning) {
		return false;
	}
	learningTable = table
	isLearning = true;
	document.getElementById("learningChoiceContainer").style.display = "none"
	document.getElementById("learningCardContainerBackground").style.display = "block"
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
		document.getElementById("learningCardContainerBackground").style.display = "none"
		isLearning = null;
		learningTable = null;
	}
	document.getElementById("faceText").innerHTML = learningTable[currentNumberInQueue][0] // german text
	document.getElementById("backText").innerHTML = learningTable[currentNumberInQueue][1] // french text
	document.getElementById("words_counter_learning").innerHTML = (currentNumberInQueue+1)+"/"+ (learningTable.length) // french text
}

function doneStudying() {
	loadPage()
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