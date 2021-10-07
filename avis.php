<?php 
	/*
		*	PROJECT:		swisslearns.ch
		*	FILE:			avis.php
		*	DEVELOPERS:		Hassan & Jordan
		* 	PURPOSE:		La page principale des avis
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
	// permet de savoir sur quelle page l'utilisteur est.
	$_SESSION["user_page"] = "avis.php";
?>

<?
	// telecharger la dernière version du fichier css (éviter cache)
	$filename = 'styles/avis.css';
	$fileModified = substr(md5(filemtime($filename)), 0, 6);
?>
<link rel="stylesheet" href="<?php echo $filename."?v=".$fileModified;?>">

<?php
	// sélectionner tous les avis et les mettre dans un array PHP.
	$sql = "SELECT reviews.id, reviews.message, reviews.stars, users.user_image, users.first_name, users.last_name from reviews INNER JOIN users ON users.id = reviews.id";
	$result = $conn->query($sql);
	$allReviews = array();
	while($row = $result->fetch_array())
	{
		$tempArray = [
			"firstName" => $row['first_name'],
			"lastName" => $row['last_name'],
			"review" => $row['stars'],
			"message" => $row['message'],
			"image" => $row['user_image'],
			"id" => $row['id'],
		];
		array_push($allReviews, $tempArray);
	}
?>

<body>
	<!-- Avis Section -->
		<section id="testimonials">
			<div class="testimonials">
			  <div class="inner">
				<h1>Avis</h1>
				<div class="border"></div>

				<div class="row">
				
				<?php
					// afficher tous les avis dans un div individuel
					for ($i = 0; $i < count($allReviews); $i++) {
						if (isset($allReviews) && isset($allReviews[$i])) {
							echo '<div class="col">
									<div class="testimonial">
										<img src="'.$allReviews[$i]["image"].'" alt="">
										<div class="name"><a href="profile.php?u='.$allReviews[$i]["id"].'">'.$allReviews[$i]["firstName"].' '.$allReviews[$i]["lastName"].'</a></div>
										<div class="stars">';
										$stars = $allReviews[$i]["review"];
										for ($a = 1; $a < 6; $a++) {
											if ($a <= $stars) {
												echo '<i><img src="styles/img/star.png"></img></i>';
											} else {
												echo '<i><img src="styles/img/empty-star.png"></img></i>';
											}
										}
									  echo '</div><p>'.$allReviews[$i]["message"].'</p></div></div>';
						}
					}
				?>
				
				</div>
			  </div>
			</div>
			
		</section>
	 <!-- End Avis Section -->

</body>

<?php require "footer.php";?>