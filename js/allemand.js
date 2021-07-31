

var currentNumberInQueue = 0; // for learning cards


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

// testing



function showMultipleChoices(question, answersList, position, total) {
	var position = parseInt(position)
	document.getElementById("learningChoiceContainer").style.display = "none"
	document.getElementById("multipleChoicesContainer").style.display = "block"
	document.getElementById("shownVocText").innerHTML = question
	document.getElementById("words_counter_multipleChoices").innerHTML = (position+1) +"/"+ total
	for (var i = 0; i < answersList.length; i++) {
		document.getElementById("choix_multiple_option" + i).value = answersList[i]
	}
}

function startCelebration() {

}


function showWritingTest(question, position, total) {
	var position = parseInt(position)
	document.getElementById("shownVocText_ecrire").innerHTML = question
	document.getElementById("words_counter_ecrire").innerHTML = (position+1)+"/"+ total
	document.getElementById("learningChoiceContainer").style.display = "none"
	document.getElementById("writingContainer").style.display = "block"
}



var learningTable = null;
function startLearningSession(table) {
	console.log(table)
	learningTable = table
	document.getElementById("learningChoiceContainer").style.display = "none"
	document.getElementById("learningCardContainerBackground").style.display = "block"
	nextVoc("start")
}

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
		window.location.replace('allemand.php');
	}
	document.getElementById("faceText").innerHTML = learningTable[currentNumberInQueue][0] // german text
	document.getElementById("backText").innerHTML = learningTable[currentNumberInQueue][1] // french text
	document.getElementById("words_counter_learning").innerHTML = (currentNumberInQueue+1)+"/"+ (learningTable.length) // french text
}

$(document).ready(function(){
    $(this).scrollTop(0);
});