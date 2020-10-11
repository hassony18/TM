


document.getElementById("test").innerHTML = getVocTable("1.1")

async function getVocTable(index) {
	const response = await fetch('../data/allemand.json');
	const table = await response.json();
	if (!index) {
		return table;
	} else {
		return table[index];
	}
}