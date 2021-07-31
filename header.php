<?php
	include 'backend/functions.backend.php';
	require_once 'backend/notifications.backend.php';
	session_start();
?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="google-signin-client_id" content="467170103073-1t65koimd2m4jd4npjtoopmdtrboec6u.apps.googleusercontent.com">
	<title>Swiss Learns</title>
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

							<?php
								if (isset($_SESSION["email"])) {
									echo '<li><a href="index.php#learn">Apprendre</a></li>';
								}
							?>
								
							<li><a href="index.php#about">Qui sommes-nous</a></li>
							<?php
								if (isset($_SESSION["email"])) {
									// if logged in, show profile dropdown
									showProfileDropdown(); // dropdown function 
								}						
							?>
						</ul>
					</div>
				</div>
			</div>
		</section>
		<!-- End Header -->
	</header>