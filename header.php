<?php
	include 'backend/functions.backend.php';
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="google-signin-client_id" content="467170103073-1t65koimd2m4jd4npjtoopmdtrboec6u.apps.googleusercontent.com">
	<title>Swiss Learns</title>
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<link rel="stylesheet" href="styles/homepage.css">
	<link rel="icon" type="image/png" href="styles/img/favicon.png"/>
</head>
<body>
	<header>
		<!-- Header -->
		<section id="header">
			<div class="header container">
				<div class="nav-bar">
					<div class="brand">
						<a href="index.php#homepage"><h1><span>S</span>wiss <span>L</span>earns</h1></a>
					</div>
					<div class="nav-list">
						<div class="headerList"><div class="bar"></div></div>
						<ul>
							<li><a href="index.php">Accueil</a></li>
							<li><a href="index.php#rankings">Classement</a></li>
							<li><a href="index.php#learn">Apprendre</a></li>
							<li><a href="index.php#about">Qui sommes-nous</a></li>
						<?php
						

 							if (isset($_SESSION["email"])) {
								// if logged in, show profile dropdown

							showProfileDropdown(); // dropdown function 
								
							} else {
								// if logged out, show logged in button form
								/* echo '<li><a href="signup.php" data-after="Signup">Se connecter</a></li>'; */
								echo '<li><div style="height: 20px;" class="g-signin2" data-onsuccess="onSignIn"></div></li>';
							} 
														
						?>
						<script>
						function onSignIn(googleUser) {
							var profile = googleUser.getBasicProfile();
							var id_token = googleUser.getAuthResponse().id_token;
						  
							var xhr = new XMLHttpRequest();
							xhr.open('POST', 'http://localhost/TM/backend/login.backend.php'); // link
							xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
							xhr.onload = function() {
								console.log('Signed in as: ' + xhr.responseText);
							};
							xhr.send('idtoken=' + id_token);
							//setTimeout(function(){ window.location.reload(); }, 1000);
						}

/* 						function signOut() {
							var auth2 = gapi.auth2.getAuthInstance();
							auth2.signOut().then(function () {
							  console.log('User signed out.');
							});
						  }
						   */
						  


						</script>
						
						

						</ul>
					</div>
				</div>
			</div>
		</section>
		<!-- End Header -->
	</header>