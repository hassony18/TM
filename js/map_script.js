var n = 0
var points = 3

function launchMap() {

	if (document.getElementById("testmap").checked) {	
		document.getElementById("test").style.display = "block"
		document.getElementById("choose").style.display = "none" 
		leZoom()
	}else if(document.getElementById("nbPays").checked){
		document.getElementById("world0").style.display = "block"
		document.getElementById("choose").style.display = "none" 	
		mapGameNumb()
		leZoom0()
	}
};

function mapGameNumb(){
	runMapGame0()
	document.getElementById("point").innerHTML= points
};

function runMapGame0() { 
	var randomKey = getRandomCountryKey() 
	correctCountry = countriesList[randomKey]["name"]; 
	document.getElementById("nomPays0").innerHTML=countriesList[randomKey]["name"];
};

function getRandomCountryKey() {
        var keys = countriesList.length
        var randomKey = getRandomInteger(0, keys)
        return randomKey
};

function getRandomInteger(min, max) {
        return Math.floor(Math.random() * (max - min) ) + min;
};

function humanize(str) {
  var i, frags = str.split('_');
  for (i=0; i<frags.length; i++) {
    frags[i] = frags[i].charAt(0) + frags[i].slice(1);
  }
  return frags.join(' ');
};

function testPays0(id) {
	if (humanize(id) == correctCountry) {
		points= points+1
		runMapGame0()
		document.getElementById("point").innerHTML= points
	}
	else {
		console.log("non")
	}
};

function direPays(id) {
	document.getElementById("nomPays").innerHTML= humanize(id);
};