
var question = null

document.getElementById("mobile-div").style.display = "none"

function startLearning() {
	document.getElementById("mobile-div").style.display = "block"
	document.getElementById("map_container").style.display = "none" 
	question = null
}

function startTest(q) {
	document.getElementById("mobile-div").style.display = "block"
	document.getElementById("map_container").style.display = "none" 
	question = q
	console.log(question)
	showNotification("success", "Cherche: '"+question.replaceAll("_", " ")+"'")
}

function clickCountry(id) {
	var answer = id.replaceAll("_", " ")
	if (question) {
		sendAnswer(answer)
	} else {
		showNotification("success", answer)
	}
};

function sendAnswer(answer) {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'carte.php'); // link
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.onload = function() {
		//console.log('response:' + xhr.responseText);
		if (answer == question) {
			showNotification("success", "Bravo!")
		} else { 
			showNotification("warning", "Tu as selectionné '"+answer+"'!")
		}
		setTimeout(function(){
				window.location.href = 'carte.php?success=test'
		}, 1000);
	};
	xhr.send('userAnswer=' + answer);
}



var country = document.getElementsByClassName("country");

var requestClick = function() {
    var id = this.id
	clickCountry(id)
};

for (var i = 0; i < country.length; i++) {
    country[i].addEventListener('click', requestClick, false);
}
