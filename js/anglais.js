/*
	*	PROJECT:		swisslearns.ch
	*	FILE:			anglais.js
	*	DEVELOPERS:		Hassan & Jordan
	* 	PURPOSE:		Gèrer l'anglais
			o    o     __ __
			 \  /    '       `
			  |/   /     __    \
			(`  \ '    '    \   '
			  \  \|   |   @_/   |
			   \   \   \       /--/
				` ___ ___ ___ __ '
		
		Written with ♥ for the The Republic of Geneva. 		
*/
	

var currentNumberInQueue = 0; // for learning cards

// cacher tous les divs sauf le div du choix du programme
function loadPage() {
	isLearning = false;
	currentNumberInQueue = 0;
	document.getElementById("learningChoiceContainer").style.display = "block" // block
	document.getElementById("learningCardContainerBackground").style.display = "none" // none
	document.getElementById("multipleChoicesContainer").style.display = "none"
	document.getElementById("testOptionsContainer").style.display = "none"
	document.getElementById("multipleChoicesOptionsContainer").style.display = "none"
	document.getElementById("writingContainer").style.display = "none"
	document.getElementById("ecrireOptionsContainer").style.display = "none"
}
loadPage()

// transformation des lettres en miniscule/majuscule
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

// inserer du texte (clavier)
function insertText(e) {
	var text = document.getElementById("textAEcrire").value;
	var letter = e.innerHTML
	document.getElementById("textAEcrire").value = text + "" + letter
}

// changer la rotation de la carte en cliquant
function flipCard() {
	var card = document.getElementById("flippingCard")
	if (card.style.transform == "none" || card.style.transform == "") {
		card.style.transform = "rotateY(180deg)";
	} else {
		card.style.transform = "none";
	}
}

// Afficher des sous-categories en cliquant sur un radio button
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



// afficher les choix multiples 
function showMultipleChoices(question, answersList, position, total) {
	var position = parseInt(position)
	document.getElementById("learningChoiceContainer").style.display = "none"
	document.getElementById("multipleChoicesContainer").style.display = "block"
	document.getElementById("shownVocText").innerHTML = question
	document.getElementById("words_counter_multipleChoices").innerHTML = (position+1) +"/"+ total
	// hide all buttons
	for (var i = 0; i < 4; i++) {
		document.getElementById("choix_multiple_option" + i).style.display = "none"
	}
	// show buttons that has values only
	for (var i = 0; i < answersList.length; i++) {
		document.getElementById("choix_multiple_option" + i).value = answersList[i]
		document.getElementById("choix_multiple_option" + i).style.display = "block"
	}
}

// afficher le test d'écriture
function showWritingTest(question, position, total) {
	var position = parseInt(position)
	document.getElementById("shownVocText_ecrire").innerHTML = question
	document.getElementById("words_counter_ecrire").innerHTML = (position+1)+"/"+ total
	document.getElementById("learningChoiceContainer").style.display = "none"
	document.getElementById("writingContainer").style.display = "block"
}



var learningTable = null; // Vider la table si l'utilisateur 
// commencer la session d'apprentissage
function startLearningSession(table) {
	learningTable = table
	document.getElementById("learningChoiceContainer").style.display = "none"
	document.getElementById("learningCardContainerBackground").style.display = "block"
	nextVoc("start")
}

// passer au mot suivant, à la phrase suivante 
function nextVoc(type) {
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
		window.location.replace('anglais.php');
	}
	document.getElementById("faceText").innerHTML = learningTable[currentNumberInQueue][0] // english text
	document.getElementById("backText").innerHTML = learningTable[currentNumberInQueue][1] // french text
	document.getElementById("words_counter_learning").innerHTML = (currentNumberInQueue+1)+"/"+ (learningTable.length) // french text
}

// remettre le scrollbar à 0
$(document).ready(function(){
    $(this).scrollTop(0);
});

// écouter les mots/phrases
function listenToWord() {
	var msg = new SpeechSynthesisUtterance();	
	var card = document.getElementById("flippingCard")
	if (card.style.transform == "none" || card.style.transform == "") {
		var frontText = document.getElementById("faceText").innerHTML
		msg.lang = 'en';
		var text = frontText.split(', ');
		msg.text = text[0]
	} else {
		var backText = document.getElementById("backText").innerHTML
		msg.lang = 'fr';
		msg.text = backText
	}
    msg.volume = 1; // 0 to 1
    msg.rate = 0.5; // 0.1 to 10
	window.speechSynthesis.speak(msg);
}

// preview voc
var container = document.getElementById("previewContainer");
var preventSpam = null;
var previewImage = document.getElementById("previewImage");
function showList() {
	if (!preventSpam) {
		showPicture()
	}
};


// close preview
var close = document.getElementById("closePreview");
close.onclick = function() {
	container.style.display = "none";
}
var tableToAppend = null;


// afficher la liste entière du voc
function showPicture() {
	if (container.style.display == "block") {
		return false;
	}
	container.style.display = "block";
	if (!learningTable) {
		return false;
	}
	if (tableToAppend) {
		var parent = document.getElementById("vocTableList");
		while(parent.hasChildNodes()) {
		   parent.removeChild(parent.firstChild);
		}
	}
	tableToAppend = document.getElementById("vocTableList")
	for (var i = 0; i < learningTable.length; i++) {
		var tr = document.createElement("tr")
		var left = document.createElement("td")
		var right = document.createElement("td")
		left.innerHTML = learningTable[i][0].replace("%", "")
		right.innerHTML = learningTable[i][1].replace("%", "")
		tr.append(left)
		tr.append(right)
		tableToAppend.append(tr)
	}
}




// close on clickoutside preview image


document.addEventListener('mouseup', function(e) {
	var img = document.getElementById('previewImage');
	if (!previewImage.contains(e.target) && container.style.display == "block") {
        container.style.display = 'none';
    }
});

document.addEventListener('touchstart', function(e) {
	if (!previewImage.contains(e.target) && container.style.display == "block") {
        container.style.display = 'none';
		preventSpam = true;
		setTimeout(function(){ preventSpam = null; }, 500);
    }
});
