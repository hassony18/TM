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
		}
	}
