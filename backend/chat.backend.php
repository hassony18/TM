<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/db/config.php";
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    //action.php
	if (!isset($_SESSION["user_id"])) {
		exit();
	}
	if (isset($_POST["action"])) {
		if ($_POST["action"] == "sendMessage") {
			if (isset($_POST["id"]) && isset($_POST["message"])) {
				$statement = $conn->prepare("INSERT into `messages` (sender_id, receiver_id, message) VALUES (?, ?, ?)");
				$statement->bind_param('sss', $_SESSION["user_id"], $_POST["id"], $_POST["message"]);
				$statement->execute();
				if ($statement === FALSE) {
					die ("Mysql Error: " . $conn->error);
				}
			}
		} elseif ($_POST["action"] == "fetch_messages") {
			if (isset($_POST["id"])) {
                $statement = $conn->prepare("SELECT sender_id, receiver_id, message from messages WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) ORDER BY id DESC;");
				$statement->bind_param('ssss', $_SESSION["user_id"], $_POST["id"], $_POST["id"], $_SESSION["user_id"]);
                $statement->execute();
                $result = $statement->get_result();
                //$result = $statement->fetchAll();
                if ($statement === FALSE) {
                    die ("Mysql Error: " . $conn->error);
                }
                $tempArray = array();
                foreach($result as $row) {
                    array_push($tempArray, array(
                        "sender" => $row["sender_id"],
                        "receiver" => $row["receiver_id"],
                        "message" => $row["message"]
                    ));
                }                
                echo json_encode($tempArray);


			}
		}  elseif ($_POST["action"] == "fetch_users") {
                $statement = $conn->prepare("SELECT users.id, users.first_name, users.last_name, users.user_image, activity.last_activity FROM users INNER JOIN friends ON friends.user_2 = users.id INNER JOIN activity ON friends.user_2 = activity.id WHERE user_1 = ?;");
				$statement->bind_param('s', $_SESSION["user_id"]);
                $statement->execute();
                $result = $statement->get_result();
                //$result = $statement->fetchAll();
                if ($statement === FALSE) {
                    die ("Mysql Error: " . $conn->error);
                }
                $count = mysqli_affected_rows($conn);
                $tempArray = array();
                foreach($result as $row) {
					$time = new DateTime( $row["last_activity"] );
					$now = new DateTime( date("Y-m-d H:i:s", STRTOTIME(date('h:i:sa'))) );
					$diff = $now->getTimestamp() - $time->getTimestamp();
                    array_push($tempArray, array(
                        "image" => $row["user_image"],
                        "firstName" => $row["first_name"],
						"lastActive" => $diff,
                        "id" => $row["id"],
                    ));
                }
                $tableToSend = array();
                array_push($tableToSend, $tempArray);
				array_push($tableToSend, $_SESSION["user_id"]);
                
                echo json_encode($tableToSend);
             }
	}
