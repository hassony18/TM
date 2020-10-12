<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Swiss Learns</title>
	<link rel="stylesheet" href="./styles/homepage.css">
	<link rel="stylesheet" href="./styles/signup.css">
</head>
<body>
	<header>
		<!-- Header -->
		<section id="header">
			<div class="header container">
				<div class="nav-bar">
					<div class="brand">
						<a href="#homepage"><h1><span>S</span>wiss <span>L</span>earns</h1></a>
					</div>
					<div class="nav-list">
						<div class="headerList"><div class="bar"></div></div>
						<ul>
							<li><a href="index.php">Accueil</a></li>
							<li><a href="#ranking">Classement</a></li>
							<li><a href="#learn">Apprendre</a></li>
							<li><a href="#about">Qui sommes-nous</a></li>
						<?php
 							if (isset($_SESSION["userId"])) {
								// if logged in, show logout button form
								echo '<li><a href="./backend/logout.backend.php" method="post">Se déconnecter</a></li>';
							} else {
								// if logged out, show logged in button form
								echo '<li><a href="signup.php" data-after="Signup">Se connecter</a></li>';
							} 
						?>
						</ul>
					</div>
				</div>
			</div>
		</section>
		<!-- End Header -->
	</header>