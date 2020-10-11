<?php
	require "header.php";
?>

		<br><br><br><br><br><br><br><br><br><br><br><br><br>
		<h1>S'inscrire</h1>
		<form action="./backend/signup.backend.php" method="POST">
			<?php
				if (isset($_GET["first"])) {
					$first = $_GET["first"];
					echo '<input type="text" name="first" placeholder="Firstname" value="'.$first.'">';
				} else {
					echo '<input type="text" name="first" placeholder="Firstname">';
				}
				
				echo '<br>';
				
				if (isset($_GET["last"])) {
					$last = $_GET["last"];
					echo '<input type="text" name="last" placeholder="Lastname" value="'.$last.'">';
				} else {
					echo '<input type="text" name="last" placeholder="Lastname">';
				}
				
				echo '<br>';
			?>
			<input type="text" name="email" placeholder="E-mail">
			<br>
			<?php
				if (isset($_GET["uid"])) {
					$username = $_GET["uid"];
					echo '<input type="text" name="username" placeholder="Username" value="'.$username.'">';
				} else {
					echo '<input type="text" name="username" placeholder="Username">';
				}
			?>
			<br>
			<input type="text" name="password" placeholder="Password">
			<br>
			<button type="submit" name="signup-submit">Sign up</button>
		</form>
		
		<h1>S'identifier</h1>
		<form action="./backend/login.backend.php" method="post">
			<input type="text" name="mailuid" placeholder="Username or E-mail...">
			<input type="password" name="pwd" placeholder="Username or E-mail...">
			<button type="submit" name="login-submit">Login</button>
		</form>


<?php
	if (isset($_GET["signup"])) {
		$signupCheck = $_GET["signup"];
		
		if ($signupCheck == "empty") {
			echo "<p class='error'>You did not fill in all fields!</p>";
			exit();
		} elseif ($signupCheck == "char") {
			echo "<p class='error'>You used invalid characters!</p>";
			exit();
		} elseif ($signupCheck == "invalidemail") {
			echo "<p class='error'>You used an invalid e-mail!</p>";
			exit();
		} elseif ($signupCheck == "success") {
			echo "<p class='success'>You have been signed up!</p>";
			exit();
		}
	}
?>

	
<?php
	require "footer.php";
?>