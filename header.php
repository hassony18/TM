<?php
	require_once 'backend/notifications.backend.php';
	session_start();
?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="google-signin-client_id" content="467170103073-1t65koimd2m4jd4npjtoopmdtrboec6u.apps.googleusercontent.com">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
	<title>Swiss Learns</title>
	<link rel="stylesheet" href="styles/homepage.css">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
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
							<li><a href="online.php">En ligne</a></li>

							<?php
								if (isset($_SESSION["email"])) {
									echo '<li><a href="index.php#learn">Apprendre</a></li>';
								}
							?>
								
							<li><a href="index.php#about">Qui sommes-nous</a></li>
							<?php
								if (isset($_SESSION["email"])) {
									// if logged in, show profile dropdown
									echo '
									<li class="dropbtn">
										<a onclick="dropdownprofile()" href="#"> <img  id="no-width"  src="' . $_SESSION['user_image'] . '"</img> ' . $_SESSION["userFirstName"] . '</a>
									</li>
									<div id="myDropdown" class="dropdown-content">
										<li>
											<a href="profile.php?u='.$_SESSION["user_id"].'"><i class="fa fa-fw fa-user"></i>Profil</a>
										</li>
										<li>
											<a href="search.php"><i class="fa fa-fw fa-power-off"></i>Recherche de personnes</a>
										</li>
										<li>
											<a href="./backend/logout.backend.php"><i class="fa fa-fw fa-power-off"></i>Se déconnecter</a>
										</li>
									</div>';
								}						
							?>
						</ul>
					</div>
				</div>
			</div>
		</section>
		
		<!-- End Header -->
	</header>