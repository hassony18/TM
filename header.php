<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<header>
		<!-- Header -->
		<section id="header">
			<div class="header container">
				<div class="nav-bar">
					<div class="brand">
						<a href="#hero"><h1><span>S</span>wiss <span>L</span>earns</h1></a>
						<?php
							if (isset($_SESSION["userId"])) {
								// if logged in, show logout button form
								echo '<form action="backend/logout.backend.php" method="post"><button type="submit" name="logout-submit">Logout</button></form>';
							} else {
								// if logged out, show logged in button form
								echo '<form action="backend/login.backend.php" method="post"><input type="text" name="mailuid" placeholder="Username or E-mail..."><input type="password" name="pwd" placeholder="Username or E-mail..."><button type="submit" name="login-submit">Login</button></form>';
							}
						?>
					</div>
					<div class="nav-list">
						<div class="headerList"><div class="bar"></div></div>
						<ul>
							<li><a href="#hero" data-after="Home">Home</a></li>
							<li><a href="#services" data-after="Service">Services</a></li>
							<li><a href="#projects" data-after="Projects">Projects</a></li>
							<li><a href="#about" data-after="About">About</a></li>
							<li><a href="#contact" data-after="Contact">Contact</a></li>
						</ul>
					</div>
				</div>
			</div>
		</section>
		<!-- End Header -->
	</header>