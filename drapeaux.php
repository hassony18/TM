<?php 
	require 'header.php';
    if (!isset($_SESSION['email'])) {
        die(header("location: index.php"));
    }
?>

<link rel="stylesheet" href="./styles/drapeaux.css" />

<body>
	<div id="countries-game">
		<img id="countryFlag" src="" alt="flag">
		<div id="centered_options">
			<button id="option1" class="options" type="button" onclick="verify(this)"></button>
			<button id="option2" class="options" type="button" onclick="verify(this)"></button>
			<button id="option3" class="options" type="button" onclick="verify(this)"></button>
			<button id="option4" class="options" type="button" onclick="verify(this)"></button>
		</div>
	</div>

	<script src="./js/liste_pays.js"></script>
	<script src="./js/countries.js"></script>
</body>


<?php
	require 'footer.php';
?>