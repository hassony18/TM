<?php 
	/*
		*	PROJECT:		swisslearns.ch
		*	FILE:			profile.php
		*	DEVELOPERS:		Hassan & Jordan
		* 	PURPOSE:		La page de profil
				o    o     __ __
				 \  /    '       `
				  |/   /     __    \
				(`  \ '    '    \   '
				  \  \|   |   @_/   |
				   \   \   \       /--/
					` ___ ___ ___ __ '
			
			Written with ♥ for the The Republic of Geneva. 		
	*/
	
	require 'header.php';
	include 'db/config.php';
	
	// initer une session s'il n'y en a pas
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}
	
	// permet de savoir sur quelle page l'utilisteur est.
	$_SESSION["user_page"] = "profile.php";

	// verifier si une lien est valide ou pas, si oui récupérer l'information complète de l'utilisateur
	if (isset($_GET["u"]) && !empty($_GET["u"])) {
		global $conn;
		$userID = $_GET["u"];
		$_SESSION["user_page"] = "profile.php?u=".$_GET["u"];
		
		
		$stmt = $conn->prepare('SELECT * FROM users LEFT JOIN activity AS a ON users.id = a.id LEFT JOIN titles AS t on users.id = t.id LEFT JOIN badges AS b on b.id = users.id  WHERE users.id = ?');
		if ($stmt === FALSE) {
			die ("Mysql Error: " . $conn->error);
		}
		$stmt->bind_param('s', $userID);
		$stmt->execute();
		$result = $stmt->get_result();
		$data = $result->fetch_assoc();
		if (empty($data)) {
			die(header("location: index.php"));
		}
		$profileTotal = $data["scoreAllemand"] + $data["scoreAnglais"] + $data["scoreItalien"] + $data["scoreDrapeaux"] + $data["scoreCarte"];
		// top 1 total
		$stmt = $conn->prepare("SELECT scoreAllemand + scoreAnglais + scoreItalien + scoreDrapeaux + scoreCarte AS amount from users ORDER BY amount DESC LIMIT 1");
		$stmt->execute();
		$result = $stmt->get_result();
		$topPlayerInAll = $result->fetch_assoc();
		// fix a bug where if top 1 player has 0 points the whole page dies.
		foreach ($topPlayerInAll as $key => $value) { 
			if ($value == 0) {
				$topPlayerInAll[$key] = 1;
			}
		}
		// top 1 allemand
		$stmt = $conn->prepare("SELECT scoreAllemand from users ORDER BY scoreAllemand DESC LIMIT 1");
		$stmt->execute();
		$result = $stmt->get_result();
		$top1Allemand = $result->fetch_assoc();
		// fix a bug where if top 1 player has 0 points the whole page dies.
		foreach ($top1Allemand as $key => $value) { 
			if ($value == 0) {
				$top1Allemand[$key] = 1;
			}
		}
		// top 1 anglais
		$stmt = $conn->prepare("SELECT scoreAnglais from users ORDER BY scoreAnglais DESC LIMIT 1");
		$stmt->execute();
		$result = $stmt->get_result();
		$top1Anglais = $result->fetch_assoc();
		// fix a bug where if top 1 player has 0 points the whole page dies.
		foreach ($top1Anglais as $key => $value) { 
			if ($value == 0) {
				$top1Anglais[$key] = 1;
			}
		}
		// top 1 italien
		$stmt = $conn->prepare("SELECT scoreItalien from users ORDER BY scoreItalien DESC LIMIT 1");
		$stmt->execute();
		$result = $stmt->get_result();
		$top1Italien = $result->fetch_assoc();
		// fix a bug where if top 1 player has 0 points the whole page dies.
		foreach ($top1Italien as $key => $value) { 
			if ($value == 0) {
				$top1Italien[$key] = 1;
			}
		}
		// top 1 carte
		$stmt = $conn->prepare("SELECT scoreCarte from users ORDER BY scoreCarte DESC LIMIT 1");
		$stmt->execute();
		$result = $stmt->get_result();
		$top1Carte = $result->fetch_assoc();
		// fix a bug where if top 1 player has 0 points the whole page dies.
		foreach ($top1Carte as $key => $value) { 
			if ($value == 0) {
				$top1Carte[$key] = 1;
			}
		}
		// top 1 drapeaux
		$stmt = $conn->prepare("SELECT scoreDrapeaux from users ORDER BY scoreDrapeaux DESC LIMIT 1");
		$stmt->execute();
		$result = $stmt->get_result();
		$top1Drapeaux = $result->fetch_assoc();
		// fix a bug where if top 1 player has 0 points the whole page dies.
		foreach ($top1Drapeaux as $key => $value) { 
			if ($value == 0) {
				$top1Drapeaux[$key] = 1;
			}
		}

	} else {
		die(header("location: index.php"));
	}
	
	// soumettre une requête d'amitié
	if (isset($_POST["submit_friendship"])) {
		$action = $_POST["submit_friendship"];
		$targetID = $_GET["u"]; // target
		$myID = $_SESSION["user_id"]; // me
		
		
		$stmt = $conn->prepare("SELECT user_2 from friends WHERE user_1 = ? AND user_2 = ?;");
		$stmt->bind_param('ss', $myID, $targetID);
		$stmt->execute();
		$result = $stmt->get_result();
		$table = $result->fetch_assoc();		
		if ($action == "Ajouter comme un ami" && empty($table)) {	
			$sql = "INSERT INTO friends (user_1, user_2) VALUES (?, ?);";
		} elseif ($action == "Supprimer comme un ami") {	
			$sql = "DELETE from friends WHERE user_1 = ? AND user_2 = ?;";
		} else {
			die(header("location: index.php"));
		}
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('ss', $myID, $targetID);
		$stmt->execute();
	}
	
	// définir la fonction str_contains si elle n'est psa définie
	if (!function_exists('str_contains')) {
		function str_contains(string $haystack, string $needle): bool
		{
			return '' === $needle || false !== strpos($haystack, $needle);
		}
	}

?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js"></script>

<?
	// telecharger la dernière version du fichier css (éviter cache)
	$filename = 'styles/profile.css';
	$fileModified = substr(md5(filemtime($filename)), 0, 6);
?>
<link rel="stylesheet" href="<?php echo $filename."?v=".$fileModified;?>">

<body>
	<form id="upload_form" action="backend/upload.backend.php" method="post" enctype="multipart/form-data">
		<?php
			// afficher le banner de chaque profil
			if (file_exists($_SERVER['DOCUMENT_ROOT']."/styles/img/banners/".$_GET["u"].".png")) {
				echo '<img id="profile_banner" src="styles/img/banners/'.$_GET["u"].'.png?'.time().'">';
			} else {
				echo '<img id="profile_banner" src="styles/img/banners/placeholder.png">';
			}
		?>
		<input id="fileToUpload" type="file" name="fileToUpload" style="display: none;"/>
	</form>
	<div id="profile_container">
		<?php echo "<div id='profile_picture_container'><img src='".$data["user_image"]."' id='profile_picture'></div>" ?>
		<?php
			// badges
			echo '<div id="badges_container">';
			if ($data["id"] <= 100) {
				echo "<img src='styles/img/early.png' class='profile_badge'>";
			}
			if ($profileTotal >= 10000) {
				echo "<img src='styles/img/10000points.png' class='profile_badge'>";
			}
			if ($profileTotal >= 1000) {
				echo "<img src='styles/img/1000points.png' class='profile_badge'>";
			}
			echo '</div>';
		
			function placeBadge($badge) {
				if ($badge == "verified") {
					echo '<script>
						var div = document.createElement("div");
						var imgContainer = document.getElementById("profile_picture_container")
						div.setAttribute("class", "verified-avatar-icon")
						div.innerHTML = "✓"
						imgContainer.append(div); 
					</script>';
					echo '
						<style>
							#profile_picture_container, #profile_picture {
								box-shadow: 0 0 5px 3px deepskyblue !important;	

							}
						</style>
					';
				} 
			}
			// afficher le titre s'il en existe un
			if (isset($data["title"])) {
				echo '<h1 class="profile_title">'.$data["title"].'</h1>';
			}
			
			// afficher le badge s'il en existe un
			if (isset($data["badge"])) {
				$badges = $data["badge"];
				if (str_contains($badges, ",")) {
					$badgesTable = explode (",", $badges);
					foreach($badgesTable as $value) {
						placeBadge($value);
					}
				} else {
					placeBadge($badges);
				}

			}
			
		?>
		<h1 class="have_container">Bienvenue sur le profil de <?php echo $data["first_name"] ?>!</h1>
			<div style="margin-left: 10px;">
				<h2>date de création du compte: <?php echo date("d-m-Y, H:i:s", strtotime($data["date"])); ?></h2>
				<h2>dernière activité de <?php echo $data["first_name"] ?>: <?php echo date("d-m-Y, H:i:s", strtotime($data["last_activity"])); ?> à la page: <?php echo $data["page"]; ?></h2>
			</div>
		<h1 class="have_container">Scores:</h1>
		<div style="margin-left: 10px;">
			<h2>Allemand: <?php echo number_format($data["scoreAllemand"]); ?></h2>
			<h2>Anglais: <?php echo number_format($data["scoreAnglais"]); ?></h2>
			<h2>Italien: <?php echo number_format($data["scoreItalien"]); ?></h2>
			<h2>Drapeaux: <?php echo number_format($data["scoreDrapeaux"]); ?></h2>
			<h2>Carte: <?php echo number_format($data["scoreCarte"]); ?></h2>
			<h2>Score total: <?php echo number_format($profileTotal); ?></h2>
		</div>
		<h1 class="have_container">Progression pour devenir le/la meilleur(e):</h1>
		<div class="wrapper">

			<div class="card allemand">
				<div class="circle">
					<div class="bar"></div>
					<div class="box"><span></span></div>
				</div>
				<div class="text">Allemand</div>
				<div class="text"><?php echo $data["scoreAllemand"].'/'.$top1Allemand["scoreAllemand"] ?> pts</div>
				<?php
					$stmt = $conn->prepare('SELECT u.id, u.scoreAllemand AS total, COUNT(*)+1 AS rank FROM users u INNER JOIN users u2 ON u.scoreAllemand < u2.scoreAllemand WHERE u.id = ?;');
					$stmt->bind_param('s', $userID);
					$stmt->execute();
					$result = $stmt->get_result();
					$myPlacementAllemand = $result->fetch_assoc();
					echo '<div class="text">#'.$myPlacementAllemand["rank"].'</div>';
				?>
			</div>
			
			<div class="card italien">
				<div class="circle">
					<div class="bar"></div>
					<div class="box"><span></span></div>
				</div>
				<div class="text">Italien</div>
				<div class="text"><?php echo $data["scoreItalien"].'/'.$top1Italien["scoreItalien"] ?> pts</div>
				<?php
					$stmt = $conn->prepare('SELECT u.id, u.scoreItalien AS total, COUNT(*)+1 AS rank FROM users u INNER JOIN users u2 ON u.scoreItalien < u2.scoreItalien WHERE u.id = ?;');
					$stmt->bind_param('s', $userID);
					$stmt->execute();
					$result = $stmt->get_result();
					$myPlacementItalien = $result->fetch_assoc();
					echo '<div class="text">#'.$myPlacementItalien["rank"].'</div>';
				?>
			</div>
		
			<div class="card anglais">
				<div class="circle">
					<div class="bar"></div>
					<div class="box"><span></span></div>
				</div>
				<div class="text">Anglais</div>
				<div class="text"><?php echo $data["scoreAnglais"].'/'.$top1Anglais["scoreAnglais"] ?> pts</div>
				<?php
					$stmt = $conn->prepare('SELECT u.id, u.scoreAnglais AS total, COUNT(*)+1 AS rank FROM users u INNER JOIN users u2 ON u.scoreAnglais < u2.scoreAnglais WHERE u.id = ?;');
					$stmt->bind_param('s', $userID);
					$stmt->execute();
					$result = $stmt->get_result();
					$myPlacementAnglais = $result->fetch_assoc();
					echo '<div class="text">#'.$myPlacementAnglais["rank"].'</div>';
				?>
			</div>

			<div class="card drapeaux">
				<div class="circle">
					<div class="bar"></div>
					<div class="box"><span></span></div>
				</div>
				<div class="text">Drapeaux</div>
				<div class="text"><?php echo $data["scoreDrapeaux"].'/'.$top1Drapeaux["scoreDrapeaux"] ?> pts</div>
				<?php
					$stmt = $conn->prepare('SELECT u.id, u.scoreDrapeaux AS total, COUNT(*)+1 AS rank FROM users u INNER JOIN users u2 ON u.scoreDrapeaux < u2.scoreDrapeaux WHERE u.id = ?;');
					$stmt->bind_param('s', $userID);
					$stmt->execute();
					$result = $stmt->get_result();
					$myPlacementDrapeaux = $result->fetch_assoc();
					echo '<div class="text">#'.$myPlacementDrapeaux["rank"].'</div>';
				?>
			</div>

			<div class="card carte">
				<div class="circle">
					<div class="bar"></div>
					<div class="box"><span></span></div>
				</div>
				<div class="text">Carte</div>
				<div class="text"><?php echo $data["scoreCarte"].'/'.$top1Carte["scoreCarte"] ?> pts</div>
				<?php
					$stmt = $conn->prepare('SELECT u.id, u.scoreCarte AS total, COUNT(*)+1 AS rank FROM users u INNER JOIN users u2 ON u.scoreCarte < u2.scoreCarte WHERE u.id = ?;');
					$stmt->bind_param('s', $userID);
					$stmt->execute();
					$result = $stmt->get_result();
					$myPlacementCarte = $result->fetch_assoc();
					echo '<div class="text">#'.$myPlacementCarte["rank"].'</div>';
				?>
			</div>

			<div class="card overall">
				<div class="circle">
					<div class="bar"></div>
					<div class="box"><span></span></div>
				</div>
				<div class="text">Total</div>
				<div class="text"><?php echo $profileTotal.'/'.$topPlayerInAll["amount"] ?> pts</div>
				<?php
					$stmt = $conn->prepare('SELECT u.id, (u.scoreAllemand+u.scoreAnglais+u.scoreItalien+u.scoreCarte+u.scoreDrapeaux) AS total, COUNT(*)+1 AS rank FROM users u INNER JOIN users u2 ON u.scoreAllemand+u.scoreAnglais+u.scoreItalien+u.scoreCarte+u.scoreDrapeaux < u2.scoreAllemand+u2.scoreAnglais+u2.scoreItalien+u2.scoreCarte+u2.scoreDrapeaux WHERE u.id = ?;');
					$stmt->bind_param('s', $userID);
					$stmt->execute();
					$result = $stmt->get_result();
					$myPlacementTotal = $result->fetch_assoc();
					echo '<div class="text">#'.$myPlacementTotal["rank"].'</div>';
				?>
			</div>

   		 </div>
		 
		 <h1 class="have_container">Statut d'amitié</h1>
		 
		<?php 
				$targetID = $_GET["u"]; // target
				
				// rajouter l'option de supprimer/ajouter un ami
				if (isset($_SESSION["user_id"])) {
					$myID = $_SESSION["user_id"]; // me
					if ($myID != $targetID) {
						$stmt = $conn->prepare("SELECT user_2 from friends WHERE user_1 = ? AND user_2 = ?;");
						$stmt->bind_param('ss', $myID, $targetID);
						$stmt->execute();
						$result = $stmt->get_result();
						$table = $result->fetch_assoc();
						if (empty($table)) {
							$value = 'Ajouter comme un ami';
						} else {
							$value = 'Supprimer comme un ami';
						}
						echo '
							<form action="profile.php?u='.$targetID.'" method="post">
								<input type="submit" name="submit_friendship" value="'.$value.'">
							</form>				
						';
					}
				}
			?>
			
			
		<table width="100%">
			<tr>
				<td>
					<h3><?php echo $data["first_name"] ?> est ami avec:</h3>
					<div id="friends_list">
					<br>
						<?
							$stmt = $conn->prepare("SELECT friends.user_2, users.first_name, users.user_image from friends INNER JOIN users ON users.id = friends.user_2 WHERE user_1 = ?;");
							$stmt->bind_param('s', $userID);
							$stmt->execute();
							$result = $stmt->get_result();
							if ($stmt === FALSE) {
								die ("Mysql Error: " . $conn->error);
							}
							//$count = count($result);
							//echo '<h3>total: '.$count.'</h3>';
							foreach($result as $row) {
								echo '<a href="profile.php?u='.$row["user_2"].'"><img class="pp_class" src="'.$row["user_image"].'">'.$row["first_name"].'</a>';
							}
						?>
					</div>
				</td>
				<td>
					<h3>sont amis avec <?php echo $data["first_name"] ?>:</h3>
					<div id="friends_list">
					<br>
						<?
							$stmt = $conn->prepare("SELECT friends.user_1, users.first_name, users.user_image from friends INNER JOIN users ON users.id = friends.user_1 WHERE user_2 = ?;");
							$stmt->bind_param('s', $userID);
							$stmt->execute();
							$result = $stmt->get_result();
							if ($stmt === FALSE) {
								die ("Mysql Error: " . $conn->error);
							}
							//$count = count($result);
							//echo '<h3>total: '.$count.'</h3>';
							foreach($result as $row) {
								echo '<a href="profile.php?u='.$row["user_1"].'"><img class="pp_class" src="'.$row["user_image"].'">'.$row["first_name"].'</a>';
							}
						?>
					</div>
				</td>
			</tr>
		</table>
			
			
	</div>

	<?php
		echo '
			<script>
			let options = {
				startAngle: -1.55,
				size: 150,
				value: 0.0,
				fill: {gradient: ["#c31432", "#240b36"]}
			  }
			  $(".circle .bar").circleProgress(options).on("circle-animation-progress",
			  function(event, progress, stepValue){
				$(this).parent().find("span").text( String( Math.floor(stepValue.toFixed(2).substr(0)*100) ) + "%");
			  });
			  $(".allemand .bar").circleProgress({
				value: '.($data["scoreAllemand"]/$top1Allemand["scoreAllemand"]).'
			  });
			  $(".italien .bar").circleProgress({
				value: '.($data["scoreItalien"]/$top1Italien["scoreItalien"]).'
			  });
			  $(".anglais .bar").circleProgress({
				value: '.($data["scoreAnglais"]/$top1Anglais["scoreAnglais"]).'
			  });
			  $(".drapeaux .bar").circleProgress({
				value: '.($data["scoreDrapeaux"]/$top1Drapeaux["scoreDrapeaux"]).'
			  });
			  $(".carte .bar").circleProgress({
				value: '.($data["scoreCarte"]/$top1Carte["scoreCarte"]).'
			  });
			  $(".overall .bar").circleProgress({
				value: '.($profileTotal/$topPlayerInAll["amount"]).'
			  });

			</script>
		';
		
		// rendre le banner clickable afin de permettre les utilisateurs de changer leurs banners 
		if (isset($_SESSION["user_id"])) {
			if ($_GET["u"] == $_SESSION["user_id"]) {
				echo '
					<script>
					// upload button
					var profile_banner = document.getElementById("profile_banner");
					if (profile_banner) {
						profile_banner.onclick = function() {
							document.getElementById("fileToUpload").click()
						}
					}
					
					// auto submit images
					if (document.getElementById("fileToUpload")) {
						document.getElementById("fileToUpload").onchange = function() {
							document.getElementById("upload_form").submit();
						};
					}

					</script>
				';
			}
		}
	?>
	
	<!-- Catch errors -->
	<?php
		if (isset($_GET["error"])) {
			$error = $_GET["error"];
			if ($error == "notImage") {
				echo "<script>showNotification('error', 'File is not an image.');</script>";
			} elseif ($error == "exists") {
				echo "<script>showNotification('error', 'File exists already.');</script>";
			}  elseif ($error == "tooLarge") {
				echo "<script>showNotification('error', 'File is too big.');</script>";
			}  elseif ($error == "format") {
				echo "<script>showNotification('error', 'Unacceptable file format.');</script>";
			} elseif ($error == "unknown") {
				echo "<script>showNotification('error', 'unknown error.');</script>";
			} 
		}
		
		if (isset($_GET["success"])) {
			echo "<script>showNotification('success', 'Successfully changed banner.');</script>";
		}
	?>

</body>





<?php require "footer.php";?>