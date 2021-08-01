<?php 
	require 'header.php';
	include 'db/config.php';

	
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}

	if (isset($_GET["u"])) {
		global $conn;
		$userID = $_GET["u"];
		$stmt = $conn->prepare('SELECT * FROM users WHERE id = ?');
		$stmt->bind_param('s', $userID);
		$stmt->execute();
		$result = $stmt->get_result();
		$data = $result->fetch_assoc();
		if (empty($data)) {
			die(header("location: index.php"));
		}
		$profileTotal = $data["scoreAllemand"] + $data["scoreAnglais"] + $data["scoreItalien"] + $data["scoreDrapeaux"] + $data["scoreCarte"];

		$stmt = $conn->prepare("SELECT id, scoreAllemand, scoreAnglais, scoreItalien, scoreDrapeaux, scoreCarte, scoreAllemand + scoreAnglais + scoreItalien + scoreDrapeaux + scoreCarte AS amount from users ORDER BY amount DESC LIMIT 1");
		$stmt->execute();
		$result = $stmt->get_result();
		$topPlayerInAll = $result->fetch_assoc();
		// fix a bug where if top 1 player has 0 points the whole page dies.
		foreach ($topPlayerInAll as $key => $value) { 
			if ($value == 0) {
				$topPlayerInAll[$key] = 1;
			}
		}
	} else {
		die(header("location: index.php"));
	}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js"></script>

<link rel="stylesheet" href="styles/profile.css" />

<body>
	<div id="profile_container">
		<?php echo "<img src='".$data["user_image"]."' id='profile_picture'>" ?>
		<br><br><br>
		<h1>Bienvenue au profil de <?php echo $data["first_name"] ?>! <span style="float: right;">date de création du compte: <?php echo date("d-m-Y, H:i:s", strtotime($data["date"])); ?></span></h1>
		<br><br><br>
		<h2>ici tu peux trouver ses progrès d'apprentissage:</h2>
		<br><br><br>
		<h1>Scores:</h1>
		<h3>Allemand: <?php echo $data["scoreAllemand"]; ?></h3>
		<h3>Anglais: <?php echo $data["scoreAnglais"]; ?></h3>
		<h3>Italien: <?php echo $data["scoreItalien"]; ?></h3>
		<h3>Drapeaux: <?php echo $data["scoreDrapeaux"]; ?></h3>
		<h3>Carte: <?php echo $data["scoreCarte"]; ?></h3>
		<h2>Total score: <?php echo $profileTotal; ?></h3>
		<br><br><br>
		<h1>Progrès au niveau du site:</h1>
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
				value: '.($data["scoreAllemand"]/$topPlayerInAll["scoreAllemand"]).'
			  });
			  $(".italien .bar").circleProgress({
				value: '.($data["scoreItalien"]/$topPlayerInAll["scoreItalien"]).'
			  });
			  $(".anglais .bar").circleProgress({
				value: '.($data["scoreAnglais"]/$topPlayerInAll["scoreAnglais"]).'
			  });
			  $(".drapeaux .bar").circleProgress({
				value: '.($data["scoreDrapeaux"]/$topPlayerInAll["scoreDrapeaux"]).'
			  });
			  $(".carte .bar").circleProgress({
				value: '.($data["scoreCarte"]/$topPlayerInAll["scoreCarte"]).'
			  });
			  $(".overall .bar").circleProgress({
				value: '.($profileTotal/$topPlayerInAll["amount"]).'
			  });

			</script>
		';
	?>


</body>





<?php require "footer.php";?>