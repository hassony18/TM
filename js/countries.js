function showGame(question, list) {
	document.getElementById("countryFlag").src = "styles/img/countries/"+question+".png"
	for (var i = 0; i < list.length; i++) {
		document.getElementById("option" + i).value = list[i]
	}
}