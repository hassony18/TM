
// load voc
// apprendre => Cartes tournantes
// Test => Choix Multiples ET ecrire (RANDOM)


var vocTable = false

fetch('../data/allemand.json').then(function(response) {
	return response.json();
}).then(function(data){
	runVocScript(data)
})

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

function startVocSession() {
	// radio buttons
	var isLearning = document.getElementById('apprendreRadio').checked;
	var isTesting = document.getElementById('testRadio').checked;	
	if (!isTesting && !isLearning) {
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
	startLearningSession(localVocTable, includePhrases, includeBlue, includeBluePhrases)
}

function startLearningSession(table, includePhrases, includeBlue, includeBluePhrases) {
	
	for (key in localVocTable) {
		console.log(localVocTable[key]);
	}
}

