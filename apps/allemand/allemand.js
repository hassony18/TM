
// load voc

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
		input.setAttribute("name", key);
		label.setAttribute("for", key);
		label.setAttribute("id", "Label: " + key);
		document.getElementById("vocCheckBoxesList").appendChild(label);
		document.getElementById("vocCheckBoxesList").appendChild(input);
		document.getElementById("Label: " + key).innerHTML = key;
	}
	//document.getElementById("test").innerHTML = JSON.stringify(data["1.1"]["normal"]["Hallo"])
}

// apprendre => Cartes tournantes
// Test => Choix Multiples ET ecrire (RANDOM)