var n = 0
var point = 0
var t = 0
var a = 0
function mapGameNumb(nb){
	runMapGame0()
	document.getElementById("nombrePays").innerHTML= nb
	n = nb
};

function mapGameTime(ti){
	runMapGame1()
	document.getElementById("points").innerHTML=0
	document.getElementById("tempsRestant").innerHTML = ti
	t = ti
	a = t
	t = setInterval(countdown, 1000);     
	
}

function countdown() {
	if(a > 0){
		if(a > 60){
			a--
			t = String(Math.floor(a/60)+"m"+(a-Math.floor(a/60)*60)+"s")
		}
		else if(a <= 60) {
			a--;
			isPlaying = true;
			t = String(a)
		}
	}
	else if (a == 0) {
		isPlaying = false; 
	}

	document.getElementById("tempsRestant").innerHTML = t;
};

function runMapGame0() { 
	var randomKey = getRandomCountryKey() 
	correctCountry = countriesList[randomKey]["name"]; 
	document.getElementById("nomPays0").innerHTML=countriesList[randomKey]["name"];
};
function runMapGame1() { 
	var randomKey = getRandomCountryKey() 
	correctCountry = countriesList[randomKey]["name"]; 
	document.getElementById("nomPays1").innerHTML=countriesList[randomKey]["name"];
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
		n=n-1
		runMapGame0()
		document.getElementById("nombrePays").innerHTML=n
		if(n==0) {
			alert("gg")
		}
	}
	else {
		console.log("non")
	}
};

function testPays1(id) {
	if (humanize(id) == correctCountry) {
		point++
		document.getElementById("points").innerHTML=point
		runMapGame1()
	}
	else {
		console.log("non")
	}
};

var opt = ""
var option = null

function difficulty(opt) {
	if(opt=='testmap') {
		document.getElementById("nbPaysopt").innerHTML = ""
		document.getElementById("tempsopt").innerHTML = ""
		option = 'testmap'
	}else if(opt=='nbPays') {
		document.getElementById("nbPaysopt").innerHTML = "<fieldset><legend>Quel nombre de pays souhaites-tu trouver ?</legend><input type='radio' id='nbPaysopt1' name='nPO' onclick='nPays(1)' required value='nbPaysopt1'><label for='nbPaysopt1'>1</label><br><input type='radio' id='nbPaysopt3' name='nPO' onclick='nPays(3)' required value='nbPaysopt3'><label for='nbPaysopt3'>3</label><br><input type='radio' id='nbPaysopt5' name='nPO' onclick='nPays(5)' required value='nbPaysopt5'><label for='nbPaysopt5'>5</label><br><input type='radio' id='nbPaysopt10' name='nPO' onclick='nPays(10)' required value='nbPaysopt10'><label for='nbPaysopt10'>10</label><br><input type='radio' id='nbPaysopt100' name='nPO' onclick='nPays(100)' required value='nbPaysopt100'><label for='nbPaysopt100'>100(Si tu as une journée de libre)</label><br></fieldset>"
		document.getElementById("tempsopt").innerHTML = ""
	}else if(opt=='temps'){
		document.getElementById("nbPaysopt").innerHTML = ""
		document.getElementById("tempsopt").innerHTML = "<fieldset><legend>Quel temps souhaites-tu avoir ?</legend><input type='radio' id='10s' name='timeopt' value='10s' required onclick='time(10)'><label for='10s'>10 secondes(déconseillé)</label><br><input type='radio' id='30s' name='timeopt' value='30s' onclick='time(30)'><label for='30s'>30 secondes</label><br><input type='radio' id='1m' name='timeopt' value='1m' onclick='time(60)'><label for='1m'>1 minute</label><br><input type='radio' id='5m' name='timeopt' value='5m' onclick='time(300)'><label for='5m'>5 minute</label><br><input type='radio' id='15m' name='timeopt' value='15m' onclick='time(900)'><label for='15m'>15 minute</label><br><input type='radio' id='1h' name='timeopt' value='1h' onclick='time(3600)'><label for='1h'>1 heure</label></fieldset>"
	}
};

function nPays(nb) {
	option = nb
};

function time(ti) {
	option = ti
};

function launchMap() {

	if (document.getElementById("testmap").checked) {	
		document.getElementById("test").style.display = "block"
		document.getElementById("choose").style.display = "none" 
		leZoom()
	}else if(document.getElementById("nbPays").checked){
		if (document.getElementById("nbPaysopt1").checked) {
			document.getElementById("world0").style.display = "block"
			document.getElementById("choose").style.display = "none" 
			mapGameNumb(1)
			leZoom0()
		}else if (document.getElementById("nbPaysopt3").checked) {
			document.getElementById("world0").style.display = "block"
			document.getElementById("choose").style.display = "none" 
			mapGameNumb(3)
			leZoom0()
		}else if (document.getElementById("nbPaysopt5").checked) {
			document.getElementById("world0").style.display = "block"
			document.getElementById("choose").style.display = "none" 
			mapGameNumb(5)
			leZoom0()
		}else if (document.getElementById("nbPaysopt10").checked) {
			document.getElementById("world0").style.display = "block"
			document.getElementById("choose").style.display = "none" 
			mapGameNumb(10)
			leZoom0()
		}else if (document.getElementById("nbPaysopt100").checked) {
			document.getElementById("world0").style.display = "block"
			document.getElementById("choose").style.display = "none" 		
			mapGameNumb(100)
			leZoom0()
		}
	}else if(document.getElementById("temps").checked){
		if (document.getElementById("10s").checked) {
			document.getElementById("world1").style.display = "block"
			document.getElementById("choose").style.display = "none" 		
			mapGameTime(10)
			leZoom1()
		}else if (document.getElementById("30s").checked) {
			document.getElementById("world1").style.display = "block"
			document.getElementById("choose").style.display = "none" 
			mapGameTime(30)
			leZoom1()
		}else if (document.getElementById("1m").checked) {
			document.getElementById("world1").style.display = "block"
			document.getElementById("choose").style.display = "none" 		
			mapGameTime(60)
			leZoom1()
		}else if (document.getElementById("5m").checked) {
			document.getElementById("world1").style.display = "block"
			document.getElementById("choose").style.display = "none" 		
			mapGameTime(300)
			leZoom1()
		}else if (document.getElementById("15m").checked) {
			document.getElementById("world1").style.display = "block"
			document.getElementById("choose").style.display = "none" 	
			mapGameTime(900)
			leZoom1()
		}else if (document.getElementById("1h").checked) {
			document.getElementById("world1").style.display = "block"
			document.getElementById("choose").style.display = "none" 		
			mapGameTime(3600)
			leZoom1()
		}
	}
};

function direPays(id) {
	document.getElementById("nomPays").innerHTML= humanize(id);
};

