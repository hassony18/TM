<?php
	require "header.php";
	require "backend/ranking.backend.php";
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}
	$_SESSION["user_page"] = "index.php";
	
	if (isset($_GET["error"])) {
		$error = $_GET["error"];
		if ($error == "anglais") {
			echo "<script>showNotification('error', 'Ce programme n\'est actuellement pas disponible.');</script>";
		} elseif ($error == "italien") {
			echo "<script>showNotification('error', 'Ce programme n\'est actuellement pas disponible.');</script>";
		}
	}
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
						//scope: 'https://www.googleapis.com/auth/user.addresses.read',
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
					xhr.open('POST', 'backend/login.backend.php'); // link
					xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					xhr.onload = function() {
						console.log('Signed in:' + xhr.responseText);
						window.location.reload();
					};
					xhr.send('idtoken=' + id_token);
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
							<h1>Connecte-toi<span></span></h1>
							<h1>Afin de<span></span></h1>
							<h1>Commencer à apprendre<span></span></h1>
							<div id="customGoogleButton" class="customGPlusSignIn">Inscris-toi</div>
							';
						}
					?>
					<p>Bienvenue sur swisslearns.ch. L’objectif de ce site est de vous aider à apprendre plusieurs points. Il y a du vocabulaire d’allemand, des drapeaux et la position des pays. Ce site vise principalement les collégiens des cantons romands de Suisse, mais tout le monde peut participer. Vous pouvez également ajouter des personnes en ami, si vous êtes connecté. Si cette personne vous a également ajouté en ami, vous pourrez vous envoyer des messages en cliquant sur l’icône en bas à droite. Vous pouvez voir votre avancement sur votre compte. Il vous suffit de cliquer sur les trois barres, votre nom et « profil ». Bon apprentissage</p>
				</div>
			</div>
		</section>
	  <!-- End homepage Section  -->
		
		<!-- Avis Section -->
		<section id="testimonials">
			<div class="testimonials">
			  <div class="inner">
				<h1>Avis</h1>
				<div class="border"></div>

				<div class="row">
				
				<?php
					if (isset($topReviews) && isset($topReviews[1])) {
						echo '<div class="col">
								<div class="testimonial">
									<img src="'.$topReviews[1]["image"].'" alt="">
									<div class="name"><a href="profile.php?u='.$topReviews[1]["id"].'">'.$topReviews[1]["firstName"].' '.$topReviews[1]["lastName"].'</a></div>
									<div class="stars">';
									$stars = $topReviews[1]["review"];
									for ($i = 1; $i < 6; $i++) {
										if ($i <= $stars) {
											echo '<i><img src="styles/img/star.png"></img></i>';
										} else {
											echo '<i><img src="styles/img/empty-star.png"></img></i>';
										}
									}
								  echo '</div><p>'.$topReviews[1]["message"].'</p></div></div>';
					}
					
					if (isset($topReviews) && isset($topReviews[2])) {
						echo '<div class="col">
								<div class="testimonial">
									<img src="'.$topReviews[2]["image"].'" alt="">
									<div class="name"><a href="profile.php?u='.$topReviews[2]["id"].'">'.$topReviews[2]["firstName"].' '.$topReviews[2]["lastName"].'</a></div>
									<div class="stars">';
									$stars = $topReviews[2]["review"];
									for ($i = 1; $i < 6; $i++) {
										if ($i <= $stars) {
											echo '<i><img src="styles/img/star.png"></img></i>';
										} else {
											echo '<i><img src="styles/img/empty-star.png"></img></i>';
										}
									}
								  echo '</div><p>'.$topReviews[2]["message"].'</p></div></div>';
					}
					
					if (isset($topReviews) && isset($topReviews[3])) {
						echo '<div class="col">
								<div class="testimonial">
									<img src="'.$topReviews[3]["image"].'" alt="">
									<div class="name"><a href="profile.php?u='.$topReviews[3]["id"].'">'.$topReviews[3]["firstName"].' '.$topReviews[3]["lastName"].'</a></div>
									<div class="stars">';
									$stars = $topReviews[3]["review"];
									for ($i = 1; $i < 6; $i++) {
										if ($i <= $stars) {
											echo '<i><img src="styles/img/star.png"></img></i>';
										} else {
											echo '<i><img src="styles/img/empty-star.png"></img></i>';
										}
									}
								  echo '</div><p>'.$topReviews[3]["message"].'</p></div></div>';
					}
				?>
				
		  
				  
				</div>
				<h1>Moyenne des avis: <?php echo $topReviews[0]; ?> </h1>
				<a href="avis.php" style="color: black;" class="cta">Voir tous les avis</a>';
			  </div>
			</div>
			
		</section>
	 <!-- End Avis Section -->

	  <!-- Ranking Section -->
		<section id="rankings">
			<div class="rankings container">
				<div class="ranking-top">
					<h1 class="section-title">Cla<span>ss</span>ement</h1>
					<p>Voici l'endroit où tu trouveras les meilleures personnes de chaque programme! Arrives-tu à trouver ton pote dans cette liste? Pas de soucis! Tu peux le rattrapper en t'exerçant!</p>
				</div>
			
				<div class="ranking-item">
					<div class="icon"><img src="styles/img/total.png"></div> 
					<h2>Top total</h2>
					<table>
						<thead>
							<td>Top</td>
							<td></td>
							<td>Nom</td>
							<td>Score</td>
						</thead>
						<?php

							for ($i = 0; $i <= 2; $i++) { 
								if (array_key_exists($i, $topTotal)) {
									$fullName = $topTotal[$i]["firstName"]." ".$topTotal[$i]["lastName"];
									$score = $topTotal[$i]["score"];
									$img = $topTotal[$i]["image"];
									$id = $topTotal[$i]["id"];
								} else {
									$fullName = "N/A";
									$score = "N/A";
									$img = "styles/img/user.png";
									$id = "";
								}
								$num = $i + 1;
								echo "<tr><td>".$num."-</td><td><img src='".$img."' id='profile_picture'></td><td><a href='./profile.php?u=".$id."'>".$fullName."</a></td><td>".$score."</td></tr>";
							}
						?>
					</table>
				</div>
				
				<div class="ranking-bottom">
					<div class="ranking-item">
						<div class="icon"><img src="styles/img/german_flag.png"/></div> 
						<h2>allemand</h2>
						<table>
							<thead>
								<td>Top</td>
								<td></td>
								<td>Nom</td>
								<td>Score</td>
							</thead>
							<?php

								for ($i = 0; $i <= 4; $i++) { 
									if (array_key_exists($i, $topGerman)) {
										$fullName = $topGerman[$i]["firstName"]." ".$topGerman[$i]["lastName"];
										$score = $topGerman[$i]["score"];
										$img = $topGerman[$i]["image"];
										$id = $topGerman[$i]["id"];
									} else {
										$fullName = "N/A";
										$score = "N/A";
										$img = "styles/img/user.png";
										$id = "";
									}
									$num = $i + 1;
									echo "<tr><td>".$num."-</td><td><img src='".$img."' id='profile_picture'></td><td><a href='./profile.php?u=".$id."'>".$fullName."</a></td><td>".$score."</td></tr>";
								}
							?>
						</table>
					</div>
					<div class="ranking-item">
						<div class="icon"><img src="styles/img/uk_flag.png"/></div>
						<h2>anglais</h2>
						<table>
							<thead>
								<td>Top</td>
								<td></td>
								<td>Nom</td>
								<td>Score</td>
							</thead>
							<?php

								for ($i = 0; $i <= 4; $i++) { 
									if (array_key_exists($i, $topEnglish)) {
										$fullName = $topEnglish[$i]["firstName"]." ".$topEnglish[$i]["lastName"];
										$score = $topEnglish[$i]["score"];
										$img = $topEnglish[$i]["image"];
										$id = $topEnglish[$i]["id"];
									} else {
										$fullName = "N/A";
										$score = "N/A";
										$img = "styles/img/user.png";
										$id = "";
									}
									$num = $i + 1;
									echo "<tr><td>".$num."-</td><td><img src='".$img."' id='profile_picture'></td><td><a href='./profile.php?u=".$id."'>".$fullName."</a></td><td>".$score."</td></tr>";
								}
							?>
						</table>
					</div>
					<div class="ranking-item">
						<div class="icon"><img src="styles/img/italian_pizza.png"/></div>
						<h2>italien</h2>
						<table>
							<thead>
								<td>Top</td>
								<td></td>
								<td>Nom</td>
								<td>Score</td>
							</thead>
							<?php

								for ($i = 0; $i <= 4; $i++) { 
									if (array_key_exists($i, $topItalian)) {
										$fullName = $topItalian[$i]["firstName"]." ".$topItalian[$i]["lastName"];
										$score = $topItalian[$i]["score"];
										$img = $topItalian[$i]["image"];
										$id = $topItalian[$i]["id"];
									} else {
										$fullName = "N/A";
										$score = "N/A";
										$img = "styles/img/user.png";
										$id = "";
									}
									$num = $i + 1;
									echo "<tr><td>".$num."-</td><td><img src='".$img."' id='profile_picture'></td><td><a href='./profile.php?u=".$id."'>".$fullName."</a></td><td>".$score."</td></tr>";
								}
							?>
						</table>
					</div>
					<div class="ranking-item">
						<div class="icon"><img src="styles/img/flags.png"/></div>
						<h2>drapeaux</h2>
						<table>
							<thead>
								<td>Top</td>
								<td></td>
								<td>Nom</td>
								<td>Score</td>
							</thead>
							<?php

								for ($i = 0; $i <= 4; $i++) { 
									if (array_key_exists($i, $topFlags)) {
										$fullName = $topFlags[$i]["firstName"]." ".$topFlags[$i]["lastName"];
										$score = $topFlags[$i]["score"];
										$img = $topFlags[$i]["image"];
										$id = $topFlags[$i]["id"];
									} else {
										$fullName = "N/A";
										$score = "N/A";
										$img = "styles/img/user.png";
										$id = "";
									}
									$num = $i + 1;
									echo "<tr><td>".$num."-</td><td><img src='".$img."' id='profile_picture'></td><td><a href='./profile.php?u=".$id."'>".$fullName."</a></td><td>".$score."</td></tr>";
								}
							?>
						</table>
					</div>
					<div class="ranking-item">
						<div class="icon"><img src="styles/img/map.png"/></div>
						<h2>carte</h2>
						<table>
							<thead>
								<td>Top</td>
								<td></td>
								<td>Nom</td>
								<td>Score</td>
							</thead>
							<?php

								for ($i = 0; $i <= 4; $i++) { 
									if (array_key_exists($i, $topMap)) {
										$fullName = $topMap[$i]["firstName"]." ".$topMap[$i]["lastName"];
										$score = $topMap[$i]["score"];
										$img = $topMap[$i]["image"];
										$id = $topMap[$i]["id"];
									} else {
										$fullName = "N/A";
										$score = "N/A";
										$img = "styles/img/user.png";
										$id = "";
									}
									$num = $i + 1;
									echo "<tr><td>".$num."-</td><td><img src='".$img."' id='profile_picture'></td><td><a href='./profile.php?u=".$id."'>".$fullName."</a></td><td>".$score."</td></tr>";
								}
							?>
						</table>
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
									<h2>"Übung macht den Meister"</h2>
									<p>As-tu du mal à apprendre ton voc d\'allemand? N\'arrives tu pas à réussir tes évals non plus? La solution est ici! Appuies ici pour commencer ta session d\'apprentissage unique!</p>
								</div>
								
								<div class="learn-img">
									<img src="./styles/img/allemand.png" alt="img">
								</div>
							</div>
						</a>

						<a href="anglais.php">
							<div class="learn-item">
								<div class="learn-img">
									<img src="./styles/img/anglais.png" alt="img">
								</div>
								
								<div class="learn-info">
									<h1>Vocabulaire d\'Anglais</h1>
									<h2>"Self education is the only kind of education there is."</h2>
									<p>Veux-tu bien apprendre le vocabulaire qui te permettra de voyager autour de globe? Si oui, alors le programme sera parfait pour t\'aider à atteindre le vocabulaire nécessaire à un niveau B2.</p>
								</div>
							</div>
						</a>
						<a href="index.php?error=italien">
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
						</a>
						<a href="carte.php">
							<div class="learn-item">
								<div class="learn-img">
									<img src="./styles/img/carte.png" alt="img">
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
			<p>Nous sommes deux élèves du collège Rousseau. Il fut un temps où nous étions à votre place. En ces temps révolus, nous avions un unique démon... l’allemand. Pour le vaincre, il nous fallut acquérir de nouvelles compétences tel que le html, le css, le JavaScript et le PHP. Après une longue réflexion, nous avons réunis ces divers outils et notre expérience nouvellement acquise dans le but de terrasser ce vil ennemi au travers d’un site internet. Ce n’est qu’après de long efforts et de grands fichiers json que nous avons pu le vaincre. Aujourd’hui, nous coulons des jours heureux grâce à nos efforts.</p>
		  </div>
		</div>
		<div id='credits'>
			<h1>Un grand merci à:</h1>
			<div id='actor-list'>
				<div class='list-item'>
					<div>Claude-Alain Mayor</div>
					<div class='dots'></div>
					<div>Vocabulaire d'allemand</div>
				</div>
				<div class='list-item'>
					<div>Edith Slembek</div>
					<div class='dots'></div>
					<div>Vocabulaire d'allemand</div>
				</div>
				<div class='list-item'>
					<div>Muriel Bovey</div>
					<div class='dots'></div>
					<div>Vocabulaire d'allemand</div>
				</div>
				<div class='list-item'>
					<div class='character'>Ribeiro Leonardo</div>
					<div class='dots'></div>
					<div class='actor'>Vocabulaire d'anglais</div>
				</div>
				<div class='list-item'>
					<div class='character'>Ysabella Carandang</div>
					<div class='dots'></div>
					<div class='actor'>Vocabulaire d'italien</div>
				</div>

			</div>
		</div>
	  </section>
	  <!-- End About Section -->
	  
	  <!-- Share Section -->
	  <section id="share">
		<div class="share container">
			<div class="share-img">
			  <img src="./styles/img/qr.png" alt="img">
			</div>
		  <div class="col-right">
			<h1 class="section-title">Part<span>age</span></h1>
			<h2>Fais tourner le code QR ci-dessous pour nous aider à atteindre tout le monde!</h2>
		  </div>
		</div>
	  </section>
	  <!-- End Share Section -->

	  <!-- Contact Section -->
	  <section id="contact">
		<div class="contact container">
		  <div><h1 class="section-title">Contact <span>info</span></h1></div>
		  <div class="contact-items">
			<div class="contact-item">
			  <div class="icon"><img src="styles/img/account.png"/></div>
			  <div class="contact-info">
				<h1>Comptes</h1>
				<a href="profile.php?u=1"><h2>Hassan Al-Obaidi</h2></a>
				<a href="profile.php?u=2"><h2>Jordan Scarpetta</h2></a>
			  </div>
			</div>
			<div class="contact-item">
			  <div class="icon"><img src="styles/img/email.png"/></div>
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
	<!-- leave Avis Section -->
		  <?php
			if (isset($_SESSION["email"])) {
				echo '

				<form id="leaveReview" action="backend/index.backend.php" method="post">
					<p>Tu aimes ce site ? Tu veux nous aider à l’améliorer ? Si tu entres dans l’une de ces catégories, tu peux nous laisser, ici, un message pour nous transmettre ton avis.</p>
					<div class="stars">
						<i><img src="styles/img/star.png"></img></i>
						<i><img src="styles/img/empty-star.png" class="interactiveStar"></img></i>
						<i><img src="styles/img/empty-star.png" class="interactiveStar"></img></i>
						<i><img src="styles/img/empty-star.png" class="interactiveStar"></img></i>
						<i><img src="styles/img/empty-star.png" class="interactiveStar"></img></i>
						<input type="text" id="reviewMessage" name="reviewMessage">
						<input style="display: none;" type="text" id="reviewStars" name="reviewStars">
						<input id="submit_review" type="submit" name="submit_review" value="Envoyer">
					</div>
				</form>
				';
			
			}
		  ?>	
	<!-- End leave Avis Section -->		  
		</div>
	  </section>
	  <!-- End Contact Section -->
	  
		
</body>

<?php
// easter egg
	if (isset($_GET["easteregg"])) {
		die(header("location: https://www.youtube.com/watch?v=dQw4w9WgXcQ&ab_channel=RickAstley"));
	}

?>
	
<?php
	require "footer.php";
?>