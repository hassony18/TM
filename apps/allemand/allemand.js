
// load voc

fetch('../data/allemand.json').then(function(response) {
	return response.json();
}).then(function(data){
	runVocScript(data)
})

function runVocScript(json) {
	var data = json
	document.getElementById("test").innerHTML = JSON.stringify(data["1.1"]["normal"]["Hallo"])
}