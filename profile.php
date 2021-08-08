<?php 
	require 'header.php';
	include 'db/config.php';
	
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}

	$_SESSION["user_page"] = "profile.php";

	if (isset($_GET["u"]) && !empty($_GET["u"])) {
		global $conn;
		$userID = $_GET["u"];
		$_SESSION["user_page"] = "profile.php?u=".$_GET["u"];
		$stmt = $conn->prepare('SELECT * FROM users INNER JOIN activity ON users.id = activity.id WHERE users.id = ?');
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

?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js"></script>

<link rel="stylesheet" href="styles/profile.css" />

<body>
	<div id="profile_container">
		<?php echo "<img src='".$data["user_image"]."' id='profile_picture'>" ?>
		<h1 class="have_container">Bienvenue au profil de <?php echo $data["first_name"] ?>!</h1>
			<h3>date de création du compte: <?php echo date("d-m-Y, H:i:s", strtotime($data["date"])); ?></h3>
			<h3>dernière activité de <?php echo $data["first_name"] ?>: <?php echo date("d-m-Y, H:i:s", strtotime($data["last_activity"])); ?> à la page: <?php echo $data["page"]; ?></h3>
		<h1 class="have_container">Scores:</h1>
		<h3>Allemand: <?php echo $data["scoreAllemand"]; ?></h3>
		<h3>Anglais: <?php echo $data["scoreAnglais"]; ?></h3>
		<h3>Italien: <?php echo $data["scoreItalien"]; ?></h3>
		<h3>Drapeaux: <?php echo $data["scoreDrapeaux"]; ?></h3>
		<h3>Carte: <?php echo $data["scoreCarte"]; ?></h3>
		<h2>Score total: <?php echo $profileTotal; ?></h3>
		<h1 class="have_container">Progrès au niveau du site:</h1>
		<div class="wrapper">

			<div class="card allemand">
				<div class="circle">
					<div class="bar"></div>
					<div class="box"><span></span></div>
				</div>
				<div class="text">Allemand</div>
			</div>
		
			<div class="card italien">
				<div class="circle">
					<div class="bar"></div>
					<div class="box"><span></span></div>
				</div>
				<div class="text">Italien</div>
			</div>
		
			<div class="card anglais">
				<div class="circle">
					<div class="bar"></div>
					<div class="box"><span></span></div>
				</div>
				<div class="text">Anglais</div>
			</div>

			<div class="card drapeaux">
				<div class="circle">
					<div class="bar"></div>
					<div class="box"><span></span></div>
				</div>
				<div class="text">Drapeaux</div>
			</div>

			<div class="card carte">
				<div class="circle">
					<div class="bar"></div>
					<div class="box"><span></span></div>
				</div>
				<div class="text">Carte</div>
			</div>

			<div class="card overall">
				<div class="circle">
					<div class="bar"></div>
					<div class="box"><span></span></div>
				</div>
				<div class="text">Total</div>
			</div>

   		 </div>
		 
		 <h1 class="have_container">Statut d'amitié</h1>
		 
		<?php 
				$targetID = $_GET["u"]; // target
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
							$count = count($result);
							echo '<h3>total: '.$count.'</h3>';
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
							$count = count($result);
							echo '<h3>total: '.$count.'</h3>';
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
	?>

</body>





<?php require "footer.php";?>