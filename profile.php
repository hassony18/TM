<?php 
	require 'header.php';
	require_once 'backend/functions.backend.php';
	include 'db/config.php';

	fetchUserDataProfile();
	updateUserDataProfile();
	allowAccessToProfile();
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js"></script>

<link rel="stylesheet" href="styles/profile.css" />

<body>
	<div id="profile_container">
		<?php echo "<img src='{$user_image}' id='profile_picture'>" ?>
		<h1>Salut, <?php echo $user_firstname ?>!</h1>
		<h2>ici tu peux trouver tes progrès d'apprentissage:</h2>

		<div class="wrapper">

			<div class="card allemand">
				<div class="circle">
					<div class="bar"></div>
					<div class="box"><span></span></div>
				</div>
				<div class="text">Allemand</div>
			</div>
		
			<div class="card italian">
				<div class="circle">
					<div class="bar"></div>
					<div class="box"><span></span></div>
				</div>
				<div class="text">Italian</div>
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

	<script>
      let options = {
        startAngle: -1.55,
        size: 150,
        value: 0.0,
        fill: {gradient: ['#c31432', '#240b36']}
      }
      $(".circle .bar").circleProgress(options).on('circle-animation-progress',
      function(event, progress, stepValue){
        $(this).parent().find("span").text(String(stepValue.toFixed(2).substr(2)) + "%");
      });
      $(".allemand .bar").circleProgress({
        value: 0.69
      });
      $(".italian .bar").circleProgress({
        value: 0.60
      });
      $(".anglais .bar").circleProgress({
        value: 0.40
      });
    </script>

</body>





<?php require "footer.php";?>