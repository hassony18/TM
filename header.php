<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="styles/homepage.css">
	<link rel="stylesheet" href="styles/signup.css">
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
							<li><a href="index.php" data-after="Home">Home</a></li>
							<li><a href="#services" data-after="Service">Services</a></li>
							<li><a href="#projects" data-after="Projects">Projects</a></li>
							<li><a href="#about" data-after="About">About</a></li>
						<?php
 							if (isset($_SESSION["userId"])) {
								// if logged in, show logout button form
								echo '<li><a href="./backend/logout.backend.php" method="post">déconnecter</a></li>';
							} else {
								// if logged out, show logged in button form
								echo '<li><a href="signup.php" data-after="Signup">Se connecter</a></li>';
							} 
						?>
							<!-- #contact -->
						</ul>
					</div>
				</div>
			</div>
		</section>
		<!-- End Header -->
	</header>