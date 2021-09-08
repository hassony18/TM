<?php 
	require 'header.php';
	include 'db/config.php';
	$_SESSION["user_page"] = "search.php";
?>

<?
	$filename = 'styles/search.css';
	$fileModified = substr(md5(filemtime($filename)), 0, 6);
?>
<link rel="stylesheet" href="<?php echo $filename."?v=".$fileModified;?>">

<body>
	<form action="search.php" method="post" id="search_container">
		<label for="search_text">Recherche de personnes par email/nom:</label>
		<input type="text" id="search_text" name="search_text" autofocus>
		<input type="submit" name="submit_search" value="Soumettre">
		<div id="results"></div>
	</form>
</body>

<?php
	if (isset($_POST["submit_search"])) { 
		if (!isset($_POST["search_text"]) || empty($_POST["search_text"])) {
			echo "<script>showNotification('error', 'Écris l\'email de la personne souhaitée')</script>";
			die();
		}
		global $conn;
		$searchResult = "%".$_POST["search_text"]."%";
		$stmt = $conn->prepare('SELECT id, first_name, last_name, user_image FROM users WHERE email LIKE ? OR first_name LIKE ? OR last_name LIKE ?');
		$stmt->bind_param('sss', $searchResult, $searchResult, $searchResult);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result && !empty($result)) {
			$num = 0;
			while($row = $result->fetch_assoc()) {
				$num = $num + 1;
				echo '<script>
				var a = document.createElement("a")
				var h = document.createElement("h2")
				var img = document.createElement("img")
				a.href = "profile.php?u='.$row["id"].'"
				img.src = "'.$row["user_image"].'"
				img.setAttribute("class", "profile_picture")
				h.innerHTML = "'.$row["first_name"].' '.$row["last_name"].'"
				a.append(h)
				h.prepend(img)
				document.getElementById("results").append(a)
			</script>';
			} 
			echo '<script>
			var h = document.createElement("h1")
			h.innerHTML = "total de '.$num.' résultat(s) trouvé(s):"
			document.getElementById("results").prepend(h)
			</script>';
		} else {
			echo "<script>showNotification('error', 'Personne n\'a été trouvé')</script>";
			die();
		}
	}

?>

<?php require "footer.php";?>