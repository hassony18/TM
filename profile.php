<?php 
	require 'header.php';
	require_once 'backend/functions.backend.php';
	include 'db/config.php';

	fetchUserDataProfile();
	updateUserDataProfile();
	allowAccessToProfile();
?>

<link rel="stylesheet" href="styles/profile.css" />

<body>
	<div id="profile_container">
    <?php echo "<img src='{$user_image}' id='profile_picture'>" ?>
    <h1>Salut, <?php echo $user_firstname ?>!</h1>
	</div>

</body>





<?php require "footer.php";?>