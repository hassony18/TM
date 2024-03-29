<?php 

	/*
		*	PROJECT:		swisslearns.ch
		*	FILE:			online.php
		*	DEVELOPERS:		Hassan & Jordan
		* 	PURPOSE:		La page des utilisateurs en ligne
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
	$_SESSION["user_page"] = "online.php";
?>

<?
	// telecharger la dernière version du fichier css (éviter cache)
	$filename = 'styles/online.css';
	$fileModified = substr(md5(filemtime($filename)), 0, 6);
?>
<link rel="stylesheet" href="<?php echo $filename."?v=".$fileModified;?>">

<body>
	<div id="online_container">
		<div id="results"></div>
	</div>
</body>

<script>
	fetch_user_login_data(); // récupérer les données des utilisateurs en ligne
	setInterval(function(){ fetch_user_login_data(); }, 10000);
	function fetch_user_login_data() {
		var action = "fetch_data";
		$.ajax({
			url: "backend/activity.backend.php",
			method:"POST",
			data:{action:action},
			success:function(data){ showOnlineList(JSON.parse(data));}
		});
	}
	
	// afficher la liste des utilisateurs en ligne
	function showOnlineList(data) {
		var num = data[0]
		var table = data[1]
		document.getElementById("online_container").innerHTML = "";
		var h = document.createElement("h1")
		h.innerHTML = "total de "+num+" personne(s) en ligne:"
		document.getElementById("online_container").append(h)
		
		
		var div = document.createElement("div")
		div.setAttribute("id", "results")
		document.getElementById("online_container").append(div)
		for (let i = 0; i < table.length; i++) {
			var a = document.createElement("a")
			var h = document.createElement("h2")
			var img = document.createElement("img")
			a.href = "profile.php?u="+  table[i]["id"]
			img.src = table[i]["image"]
			img.setAttribute("class", "profile_picture")
			h.innerHTML = table[i]["firstName"] + " est en train de regarder "+table[i]["page"]
			a.append(h)
			h.prepend(img)
			document.getElementById("results").append(a)
		}
	}
</script>

<?php require "footer.php";?>