<?php
	require "header.php";
?>

  <section id="signupPage">
	<div class="signupPage container">


		<form action="./backend/signup.backend.php" method="POST">
			<h1>S'inscrire</h1>
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
			<?php
				if (isset($_GET["signup"])) {
					$signupCheck = $_GET["signup"];
					
					if ($signupCheck == "empty") {
						echo "<h1 class='error'>You did not fill in all fields!</h1>";
						exit();
					} elseif ($signupCheck == "char") {
						echo "<h1 class='error'>You used invalid characters!</h1>";
						exit();
					} elseif ($signupCheck == "invalidemail") {
						echo "<h1 class='error'>You used an invalid e-mail!</h1>";
						exit();
					} elseif ($signupCheck == "success") {
						echo "<h1 class='success'>You have been signed up!</h1>";
						exit();
					}
				}
			?>
		</form>

		<form action="./backend/login.backend.php" method="post">
			<h1>S'identifier</h1>
			<input type="text" name="mailuid" placeholder="Username or E-mail...">
			<input type="password" name="pwd" placeholder="Username or E-mail...">
			<button type="submit" name="login-submit">Login</button>
			<?php
				if (isset($_GET["error"])) {
					$signupCheck = $_GET["error"];
					
					if ($signupCheck == "emptyfields") {
						echo "<h1 class='error'>You did not fill in all fields!</h1>";
						exit();
					} elseif ($signupCheck == "sqlerror") {
						echo "<h1 class='error'>ERROR: MYSQL couldn't proccess your request!</h1>";
						exit();
					} elseif ($signupCheck == "wrongpwd") {
						echo "<h1 class='error'>You entered a wrong password!!</h1>";
						exit();
					} elseif ($signupCheck == "nouser") {
						echo "<h1 class='error'>You did not enter a username!</h1>";
						exit();
					} elseif ($signupCheck == "success") {
						echo "<h1 class='success'>You have been signed up!</h1>";
						exit();
					}
				}
			?>
		</form>



	</div>
  </section>

	
<?php
	require "footer.php";
?>