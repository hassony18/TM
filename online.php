<?php 
	require 'header.php';
	include 'db/config.php';
	$_SESSION["user_page"] = "online.php";
?>

<link rel="stylesheet" href="styles/online.css" />

<body>
	<div id="online_container">
		<div id="results"></div>
	</div>
</body>

<script>
	fetch_user_login_data();
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
	function showOnlineList(data) {
		var num = data[0]
		var table = data[1]
		document.getElementById("online_container").innerHTML = "";
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

		var h = document.createElement("h1")
		h.innerHTML = "total de "+num+" personne(s) en ligne:"
		document.getElementById("results").prepend(h)
	}
</script>

<?php require "footer.php";?>