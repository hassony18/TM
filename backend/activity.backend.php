<?php
	/*
		*	PROJECT:		swisslearns.ch
		*	FILE:			activity.backend.php
		*	DEVELOPERS:		Hassan & Jordan
		* 	PURPOSE:		Gèrer l'activité des utilisateurs
				o    o     __ __
				 \  /    '       `
				  |/   /     __    \
				(`  \ '    '    \   '
				  \  \|   |   @_/   |
				   \   \   \       /--/
					` ___ ___ ___ __ '
			
			Written with ♥ for the The Republic of Geneva. 		
	*/

    include_once $_SERVER['DOCUMENT_ROOT']."/db/config.php";
    if (session_status() === PHP_SESSION_NONE) { // verifier s'il y a une session, sinon, en initier une.
        session_start();
    }
    //action.php
	if (!isset($_SESSION["user_id"])) {
		exit();
	}
    if(isset($_POST["action"])) {
		// modifier l'activité de l'utilisateur
      if ($_POST["action"] == "update_time") {
            $statement = $conn->prepare("INSERT into `activity` (id, last_activity, `page`) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE last_activity= ?, `page`=?");
            $time = date("Y-m-d H:i:s", STRTOTIME(date('h:i:sa')));
            $statement->bind_param('sssss', $_SESSION["user_id"], $time, $_SESSION["user_page"], $time, $_SESSION["user_page"]);
			$statement->execute();
            if ($statement === FALSE) {
                die ("Mysql Error: " . $conn->error);
            }
           } elseif ($_POST["action"] == "fetch_data") { // recuperer l'activité de l'utilisateur
                $statement = $conn->prepare("SELECT users.id, users.first_name, users.last_name, users.user_image, activity.`page`, activity.last_activity FROM users INNER JOIN activity ON activity.id = users.id WHERE activity.last_activity > DATE_SUB(NOW(), INTERVAL 5 SECOND)");
                $statement->execute();
                $result = $statement->get_result();
                //$result = $statement->fetchAll();
                if ($statement === FALSE) {
                    die ("Mysql Error: " . $conn->error);
                }
                $tempArray = array();
				$i = 0;
                foreach($result as $row) {
					$time = new DateTime( $row["last_activity"] );
					$now = new DateTime( date("Y-m-d H:i:s", STRTOTIME(date('h:i:sa'))) );
					$diff = $now->getTimestamp() - $time->getTimestamp();
					if ($diff <= 10) {
						$i = $i + 1;
						array_push($tempArray, array(
							"image" => $row["user_image"],
							"firstName" => $row["first_name"],
							"id" => $row["id"],
							"page" => $row["page"]
						));
					}
                }
                $tableToSend = array();
                array_push($tableToSend, $i);
                array_push($tableToSend, $tempArray);
				array_push($tableToSend, $_SESSION["user_id"]);
                
                echo json_encode($tableToSend);
             }
    }
