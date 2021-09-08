learningTable = []

document.getElementById("countries-game").style.display = "none" 
document.getElementById("drapeaux_learning_container").style.display = "none" 

function showGame(question, list) {
	document.getElementById("countryFlag").src = "styles/img/countries/"+question+".png"
	for (var i = 0; i < list.length; i++) {
		document.getElementById("option" + i).value = list[i]
	}
	document.getElementById("countries-game").style.display = "block" 
	document.getElementById("drapeaux_choisir_container").style.display = "none" 
}

function startLearning(table) {
	learningTable = table
	nextVoc("start")
	document.getElementById("drapeaux_learning_container").style.display = "block" 
	document.getElementById("drapeaux_choisir_container").style.display = "none" 
}

function flipCard() {
	var card = document.getElementById("flippingCard")
	console.log(card.style.transform)
	if (card.style.transform == "none" || card.style.transform == "") {
		card.style.transform = "rotateY(180deg)";
	} else {
		card.style.transform = "none";
	}
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
		window.location.replace('drapeaux.php');
	}
	document.getElementById("faceImg").src = "styles/img/countries/"+learningTable[currentNumberInQueue]["alpha2"] +".png" // code
	document.getElementById("backText").innerHTML = learningTable[currentNumberInQueue]["name"] // name
	document.getElementById("words_counter_learning").innerHTML = (currentNumberInQueue+1)+"/"+ (learningTable.length) // french text
}