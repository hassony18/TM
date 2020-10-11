
// load voc

fetch('../data/allemand.json').then(function(response) {
	return response.text();
}).then(function(data){
	runVocScript(data)
})

function runVocScript(data) {
	document.getElementById("test").innerHTML = data
}