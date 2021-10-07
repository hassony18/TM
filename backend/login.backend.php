<?php
	/*
		*	PROJECT:		swisslearns.ch
		*	FILE:			login.backend.php
		*	DEVELOPERS:		Hassan & Jordan
		* 	PURPOSE:		Gèrer le proccessus de la connexion
				o    o     __ __
				 \  /    '       `
				  |/   /     __    \
				(`  \ '    '    \   '
				  \  \|   |   @_/   |
				   \   \   \       /--/
					` ___ ___ ___ __ '
			
			Written with ♥ for the The Republic of Geneva. 		
	*/
	require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
	include_once $_SERVER['DOCUMENT_ROOT']."/db/config.php";

	//$jwt = new \Firebase\JWT\JWT;
	//$jwt::$leeway = 10;
	
	// pour limiter l'accès aux developpeurs 
	$verifiyAccess = array(
		"hassonyalobaidy01@gmail.com" => true,
		"scarpettajordan@gmail.com" => true,
		"hasan.albd@eduge.ch" => true
	);
	
	if (!isset($_POST["idtoken"])) {
		exit();
	}
	$id_token = $_POST["idtoken"];
	$CLIENT_ID = '467170103073-1t65koimd2m4jd4npjtoopmdtrboec6u.apps.googleusercontent.com'; // code google

	$client = new Google_Client(['client_id' => $CLIENT_ID]); 
	$payload = $client->verifyIdToken($id_token);
	if ($payload) {
		if (empty($payload["family_name"]) || !isset($payload["family_name"])) {
			$payload["family_name"] = "";
		}
		
		// accès limité aux comptes ci-dessus
		//if (!$verifiyAccess[$payload["email"]]) {
			//die();
		//}

		//log in
 		session_start();
		
		$_SESSION['userFirstName'] = $payload["given_name"];
		$_SESSION['userLastName'] = $payload["family_name"];
		$_SESSION['userFullName'] = $payload["name"];
		$_SESSION['email'] = $payload["email"];
		$_SESSION['user_image'] = $payload["picture"];
		
		$stmt = $conn->prepare('SELECT id from users WHERE email= ?');
		$stmt->bind_param('s', $_SESSION['email']);
		$stmt->execute();
		$result = $stmt->get_result();
		$data = $result->fetch_assoc();
		if (empty($data)) { 
			$sql = "INSERT INTO users (first_name, last_name, user_image, email) VALUES (?, ?, ?, ?);";
			// send email 
			$to = $_SESSION['email'];
			$subject = 'Bienvenue sur swisslearns, '.$_SESSION['userFirstName'].'!';
			$message = "<html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /><title></title></head><body>
            <div id='email-wrap'>
				<p style='font-size: 20px;'>Salut, ".$_SESSION['userFirstName']."!</p><br>
				<p style='font-size: 18px;'>Nous souhaitons vous applaudir pour le choix que vous venez de faire. Grâce à swisslearns, vous pourrez apprendre votre vocabulaire d’allemand, d’anglais et d’italien, sans parler de la position des pays et de leur drapeaux. Comme vous avez pu le voir, le site vous permet également de donner des avis en sélectionnant votre note et en écrivant votre avis juste en-dessous de la section avis sur le site. Nous serions heureux de recevoir votre avis, quel qu’il soit.</p><br>
				<p style='font-size: 18px;'>Bravo pour votre inscription et merci de votre soutien,</p>
				<p style='font-size: 18px;'>Administration</p>
				</div></body></html>";
			$headers = "From: Swisslearns <admin@swisslearns.ch>\r\n";
			$headers .= "Reply-To: admin@swisslearns.ch\r\n";
			$headers .= "Content-Type: text/html\r\n";
			
			mail($to, $subject, $message, $headers);

		} else {
			$sql = "UPDATE users SET first_name = ?, last_name = ?, user_image = ? WHERE email = ?;";
		}		
		//error_log( print_r($payload, true) );
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('ssss', $payload["given_name"], $payload["family_name"], $payload["picture"], $payload["email"]);
		$stmt->execute();
		if (empty($data)) {
			$stmt = $conn->prepare('SELECT id from users WHERE email= ?');
			$stmt->bind_param('s', $_SESSION['email']);
			$stmt->execute();
			$result = $stmt->get_result();
			$data = $result->fetch_assoc();
		}
		$_SESSION['user_id'] = $data['id'];
		exit();
	
	} else {
		echo "<h1>ERROR</h1>";
	}