






fetch('voc-all.json', {headers : { 'Content-Type': 'application/json', 'Accept': 'application/json'}})
  .then(response => response.json())
  .then(data => {
  	// Do something with your data
  	console.log(data);
  });