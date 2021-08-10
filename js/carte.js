
var question = null

document.getElementById("map").style.display = "none"

function startLearning() {
	document.getElementById("map").style.display = "block"
	document.getElementById("map_container").style.display = "none" 
	leZoom()
	question = null
}

function startTest(q) {
	document.getElementById("map").style.display = "block"
	document.getElementById("map_container").style.display = "none" 
	leZoom()
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


// Don't use window.onLoad like this in production, because it can only listen to one function.
function leZoom() {
// Expose to window namespase for testing purposes
window.panZoomInstance = svgPanZoom('#svg-id', {
  zoomEnabled: true,
  controlIconsEnabled: true,
  fit: true,
  center: true,
  minZoom: 0.1
});

// Zoom out
panZoomInstance.zoom(0.2);

function customPanBy(amount){ // {x: 1, y: 2}
  var animationTime = 300 // ms
	, animationStepTime = 15 // one frame per 30 ms
	, animationSteps = animationTime / animationStepTime
	, animationStep = 0
	, intervalID = null
	, stepX = amount.x / animationSteps
	, stepY = amount.y / animationSteps

  intervalID = setInterval(function(){
	if (animationStep++ < animationSteps) {
	  panZoomInstance.panBy({x: stepX, y: stepY})
	} else {
	  // Cancel interval
	  clearInterval(intervalID)
	}
  }, animationStepTime)
}
}