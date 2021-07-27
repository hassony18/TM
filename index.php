<?php
	require "header.php";
?>

<!-- setup custom login button -->
<?php
	if (!isset($_SESSION["email"])) {
		echo "
			<script src='https://apis.google.com/js/api:client.js'></script>
			<script>
				var googleUser = {};
				var startApp = function() {
					gapi.load('auth2', function(){
					auth2 = gapi.auth2.init({
						client_id: '467170103073-1t65koimd2m4jd4npjtoopmdtrboec6u.apps.googleusercontent.com',
						cookiepolicy: 'single_host_origin',
						//scope: 'https://www.googleapis.com/auth/userinfo.profile'
					});
					attachSignin(document.getElementById('customGoogleButton'));
					});
				};
				function attachSignin(element) {
					auth2.attachClickHandler(element, {}, onLogin, onFail)
				}

				function onLogin(googleUser) {
					var profile = googleUser.getBasicProfile();
					var id_token = googleUser.getAuthResponse().id_token;
				
					var xhr = new XMLHttpRequest();
					xhr.open('POST', 'http://localhost/TM/backend/login.backend.php'); // link
					xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					xhr.onload = function() {
						console.log('Signed in as: ' + xhr.responseText);
					};
					xhr.send('idtoken=' + id_token);
					setTimeout(function(){ window.location.reload(); }, 1000);
				}
				function onFail(error) {
					console.log(error);
				}
				startApp();
			</script>
 		";
	}
?>

<body>
	  <!-- homepage Section  -->
		<section id="homepage">
			<div class="homepage container">
				<div>
					<?php
						if (isset($_SESSION["email"])) {
							echo '
							<h1>Apprendre <span></span></h1>
							<h1>N\'a jamais été <span></span></h1>
							<h1>Si facile <span></span></h1>
							<a href="#learn" type="button" class="cta">Lancer</a>';
						} else {
							echo '
							<h1>Connectes-toi<span></span></h1>
							<h1>Afin de<span></span></h1>
							<h1>Commencer à apprendre<span></span></h1>
							<div id="customGoogleButton" class="customGPlusSignIn">Inscris-toi</div>
							';
						}
					?>

				</div>
			</div>
		</section>
	  <!-- End homepage Section  -->

	  <!-- Ranking Section -->
		<section id="rankings">
			<div class="rankings container">
				<div class="ranking-top">
					<h1 class="section-title">Cla<span>ss</span>ement</h1>
					<p>Voici l'endroit où tu trouveras les meilleures personnes de chaque programme! Arrives-tu à trouver ton pote dans cette liste? Pas de soucis! Tu peux le rattrapper en t'exerçant!</p>
				</div>
				<div class="ranking-bottom">
					<!-- List a faire -->
					<div class="ranking-item">
						<div class="icon"><img src="styles/img/german_flag.png"/></div> 
						<h2>allemand</h2>
						<?php
						for ($i = 1; $i <= 5; $i++) { ?>
							<p><?php
							echo $i."- HassoN"?></p>
						<?php } ?>
					</div>
					<div class="ranking-item">
						<div class="icon"><img src="styles/img/uk_flag.png"/></div>
						<h2>anglais</h2>
						<?php
						for ($i = 1; $i <= 5; $i++) { ?>
							<p><?php
							echo $i."- HassoN"?></p>
						<?php } ?>
					</div>
					<div class="ranking-item">
						<div class="icon"><img src="styles/img/italian_pizza.png"/></div>
						<h2>italien</h2>
						<?php
						for ($i = 1; $i <= 5; $i++) { ?>
							<p><?php
							echo $i."- HassoN"?></p>
						<?php } ?>
					</div>
					<div class="ranking-item">
						<div class="icon"><img src="styles/img/flags.png"/></div>
						<h2>drapeaux</h2>
						<?php
						for ($i = 1; $i <= 5; $i++) { ?>
							<p><?php
							echo $i."- HassoN"?></p>
						<?php } ?>
					</div>
					<div class="ranking-item">
						<div class="icon"><img src="styles/img/map.png"/></div>
						<h2>carte</h2>
						<?php
						for ($i = 1; $i <= 5; $i++) { ?>
							<p><?php
							echo $i."- HassoN"?></p>
						<?php } ?>
					</div>
				</div>
			</div>
		</section>
	  <!-- End Ranking Section -->

	<!-- learn Section -->
	<?php
	if (isset($_SESSION["email"])) {
		echo '
			<section id="learn">
				<div class="learn container">
					<div class="learn-header">
						<h1 class="section-title">Programmes <span>Disponibles</span></h1>
					</div>
					<div class="all-learn">
						<a href="allemand.php">
							<div class="learn-item">
								<div class="learn-info">
									<h1>Vocabulaire d\'Allemand</h1>
									<h2>"Arbeit macht frei"</h2>
									<p>As-tu du mal à apprendre ton voc d\'allemand? N\'arrives tu pas à réussir tes évals non plus? La solution est ici! Appuies ici pour commencer ta session d\'apprentissage unique!</p>
								</div>
								
								<div class="learn-img">
									<img src="./styles/img/allemand.png" alt="img">
								</div>
							</div>
						</a>
						<div class="learn-item">
							<div class="learn-info">
								<h1>Vocabulaire d\'Anglais</h1>
								<h2>"Self education is the only kind of education there is."</h2>
								<p>Veux-tu bien apprendre le vocabulaire qui te permettra de voyager autour de globe? Si oui, alors le programme sera parfait pour t\'aider à atteindre le vocabulaire nécessaire à un niveau B2.</p>
							</div>
							
							<div class="learn-img">
								<img src="./styles/img/anglais.png" alt="img">
							</div>
						</div>
						<div class="learn-item">
							<div class="learn-info">
								<h1>Vocabulaire d\'Italien</h1>
								<h2>"Il segreto per andare avanti è iniziare."</h2>
								<p>Souhaites-tu connaître la langue de la romance? Enfin, surtout de pouvoir commander tes plats aux pizzerrias les plus proches de chez toi de telle sorte à ce que ta commande soit comprise. Si oui, alors utilises ce programme.</p>
							</div>
							
							<div class="learn-img">
								<img src="./styles/img/italy.png" alt="img">
							</div>
						</div>
						<a href="carte.php">
							<div class="learn-item">
								<div class="learn-img">
									<img src="./styles/img/carte-mondiale.png" alt="img">
								</div>
								<div class="learn-info">
									<h1>Carte mondiale</h1>
									<h2>"On ne va jamais aussi loin que lorsqu\'on ne sait pas où on va."</h2>
									<p>Souhaites-tu connaître le monde? Enfin, ses pays... et leur position. Si oui, alors utilise cette carte qui te permettra d’apprendre tous les emplacements des 195 pays de ce monde.</p>
								</div>
							</div>
						</a>
						<a href="drapeaux.php">
							<div class="learn-item">
								<div class="learn-info">
									<h1>Drapeaux</h1>
									<h2>Veux-tu différencier le Tchad et la Roumanie?</h2>
									<p>Es-tu vexillophile ou vexillologue? Si oui, ce programme te permettra de retenir tous les drapeaux(des pays) du monde avec peu d’effort.</p>
								</div>
								<div class="learn-img">
									<img src="./styles/img/drapeaux.png" alt="img">
								</div>
							</div>
						</a>
					</div>
				</div>
			</section>
		';
	} 

	?>
	<!-- end learn Section -->

	  <!-- About Section -->
	  <section id="about">
		<div class="about container">
		  <div class="col-left">
			<div class="about-img">
			  <img src="./styles/img/img-2.png" alt="img">
			</div>
		  </div>
		  <div class="col-right">
			<h1 class="section-title">Qui sommes <span>nous</span></h1>
			<h2>Hassan & Jordan</h2>
			<p>Nous sommes deux élèves du collège Rousseau. Il fut un temps où nous étions à votre place. En ces temps révolus, nous avions un unique démon... l’allemand. Pour le vaincre, il nous fût acquérir de nouvelles compétences tel que le html, le css, le JavaScript et le PHP. Après une longue réflexion, nous avons réunis ces divers outils et notre expérience nouvellement acquise dans le but de terrasser ce vil ennemi au travers d’un site internet. Ce n’est qu’après de long efforts et de grands fichiers json que nous avons pu le vaincre. Aujourd’hui, nous coulons des jours heureux grâce à nos efforts.</p>
		  </div>
		</div>
	  </section>
	  <!-- End About Section -->

	  <!-- Contact Section -->
	  <section id="contact">
		<div class="contact container">
		  <div><h1 class="section-title">Contact <span>info</span></h1></div>
		  <div class="contact-items">
			<div class="contact-item">
			  <div class="icon"><img src="https://img.icons8.com/bubbles/100/000000/phone.png"/></div>
			  <div class="contact-info">
				<h1>Natel</h1>
				<h2>+41 764414991</h2>
				<h2>+41 784067710</h2>
			  </div>
			</div>
			<div class="contact-item">
			  <div class="icon"><img src="https://img.icons8.com/bubbles/100/000000/new-post.png"/></div>
			  <div class="contact-info">
				<h1>E-mail</h1>
				<h2>hasan.albd@eduge.ch</h2>
				<h2>jordan.scrpt@eduge.ch</h2>
			  </div>
			</div>
			<div class="contact-item">
			  <div class="icon"><img src="styles/img/discord.png"/></div>
			  <div class="contact-info">
				<h1>Discord</h1>
				<h2>HassoN#2709</h2>
				<h2>Hultraman#8548</h2>
			  </div>
			</div>
		  </div>
		</div>
	  </section>
	  <!-- End Contact Section -->
</body>
	
<?php
	require "footer.php";
?>