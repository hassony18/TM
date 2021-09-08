<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/db/config.php";
    ob_start(); 
    date_default_timezone_set("Europe/Zurich");
    require_once 'cache.class.php';

	$topTotal = array();
    $topGerman = array();
    $topEnglish = array();
    $topItalian = array();
    $topFlags = array();
    $topMap = array();
	$topReviews = array();

    $cache = new Cache();
    $currentDT = new DateTime();
    $timestamp = $cache->retrieve('timestamp2');
    $storedTS = new DateTime();
    $storedDT = $storedTS->setTimestamp($timestamp);

    if(empty($timestamp)) {
        $currentTS = $currentDT->getTimestamp();
        $cache->store('timestamp2', $currentTS);
        updateWebsite();
    } else {
        $minutes = abs( $storedDT->getTimestamp() - $currentDT->getTimestamp() ) / 60;

        if($minutes > 180) { // every 3 hours, we update the cache
            updateWebsite();
            $currentTS = $currentDT->getTimestamp();
            $cache->store('timestamp2', $currentTS);
        } else {
            populateWebsite();
        }
    }


    $conn;

    function connect() {
        global $conn;
        if ($conn->connect_error) {
            header('Location: '+mysqli_connect_error());
         }
    }

    function populateWebsite() {
        global $cache;
		global $topTotal;
        global $topGerman;
        global $topEnglish;
        global $topItalian;
        global $topFlags;
        global $topMap;
		global $topReviews;
		global $conn;

        $fetchedTopGerman = $cache->retrieve('topGerman');
        $topGerman = json_decode($fetchedTopGerman, true);

        $fetchedTopEnglish = $cache->retrieve('topEnglish');
        $topEnglish = json_decode($fetchedTopEnglish, true);

        $fetchedTopItalian = $cache->retrieve('topItalian');
        $topItalian = json_decode($fetchedTopItalian, true);

        $fetchedTopFlags = $cache->retrieve('topFlags');
        $topFlags = json_decode($fetchedTopFlags, true);

        $fetchedTopMap = $cache->retrieve('topMap');
        $topMap = json_decode($fetchedTopMap, true);
		
        $fetchedTopReviews = $cache->retrieve('topReviews');
        $topReviews = json_decode($fetchedTopReviews, true);
		
        $fetchedTopTotal = $cache->retrieve('topTotal');
        $topTotal = json_decode($fetchedTopTotal, true);
		
		// supprimer les messages tous les 10 jours. (A verifier toutes les 3 heures)
		$statement = $conn->prepare("DELETE FROM messages WHERE DATE(DATE) < DATE(NOW() - INTERVAL 10 DAY)");
		$statement->execute();
		
    }

    

    function updateWebsite() {
		topTotal();
        topGerman();
        topEnglish();
        topItalian();
        topFlags();
        topMap();
		topReviews();
    }
	
    function topTotal() {
        global $conn;
        connect();
        global $topTotal;
        global $cache;

		$sql = "SELECT id, first_name, last_name, user_image, scoreAllemand + scoreAnglais + scoreItalien + scoreDrapeaux + scoreCarte AS amount from users ORDER BY amount DESC LIMIT 3";
		
        $result = $conn->query($sql);
        while($row = $result->fetch_array())
        {
            $tempArray = [
				"firstName" => $row['first_name'],
                "lastName" => $row['last_name'],
                "score" => $row['amount'],
                "image" => $row['user_image'],
                "id" => $row['id'],
            ];
            array_push($topTotal, $tempArray);
        }
        $encodedTopTotal = json_encode($topTotal);
        $cache->store('topTotal', $encodedTopTotal);
    }

    function topMap() {
        global $conn;
        connect();
        global $topMap;
        global $cache;

		$sql = "SELECT id, first_name, last_name, scoreCarte, user_image from users ORDER BY scoreCarte DESC LIMIT 5";
		
        $result = $conn->query($sql);
        while($row = $result->fetch_array())
        {
            $tempArray = [
				"firstName" => $row['first_name'],
                "lastName" => $row['last_name'],
                "score" => $row['scoreCarte'],
                "image" => $row['user_image'],
                "id" => $row['id'],
            ];
            array_push($topMap, $tempArray);
        }
        $encodedTopMap = json_encode($topMap);
        $cache->store('topMap', $encodedTopMap);
    }
	
    function topReviews() {
        global $conn;
        connect();
        global $topReviews;
        global $cache;
		
		// moyenne d'avis
		$sql = "SELECT AVG(stars) as average from reviews";
		$result = $conn->query($sql);
		array_push($topReviews, $result->fetch_array()["average"]);

		$sql = "SELECT reviews.id, reviews.message, reviews.stars, users.user_image, users.first_name, users.last_name from reviews INNER JOIN users ON users.id = reviews.id WHERE displayed = 1";
		
        $result = $conn->query($sql);
        while($row = $result->fetch_array())
        {
            $tempArray = [
				"firstName" => $row['first_name'],
                "lastName" => $row['last_name'],
                "review" => $row['stars'],
				"message" => $row['message'],
                "image" => $row['user_image'],
                "id" => $row['id'],
            ];
            array_push($topReviews, $tempArray);
        }
		
        $encodedTopReviews = json_encode($topReviews);
        $cache->store('topReviews', $encodedTopReviews);
    }
	
	

    function topFlags() {
        global $conn;
        connect();
        global $topFlags;
        global $cache;

		$sql = "SELECT id, first_name, last_name, scoreDrapeaux, user_image from users ORDER BY scoreDrapeaux DESC LIMIT 5";
		
        $result = $conn->query($sql);
        while($row = $result->fetch_array())
        {
            $tempArray = [
				"firstName" => $row['first_name'],
                "lastName" => $row['last_name'],
                "score" => $row['scoreDrapeaux'],
                "image" => $row['user_image'],
                "id" => $row['id'],
            ];
            array_push($topFlags, $tempArray);
        }
        $encodedTopFlags = json_encode($topFlags);
        $cache->store('topFlags', $encodedTopFlags);
    }

    function topItalian() {
        global $conn;
        connect();
        global $topItalian;
        global $cache;

		$sql = "SELECT id, first_name, last_name, scoreItalien, user_image from users ORDER BY scoreItalien DESC LIMIT 5";
		
        $result = $conn->query($sql);
        while($row = $result->fetch_array())
        {
            $tempArray = [
				"firstName" => $row['first_name'],
                "lastName" => $row['last_name'],
                "score" => $row['scoreItalien'],
                "image" => $row['user_image'],
                "id" => $row['id'],
            ];
            array_push($topItalian, $tempArray);
        }
        $encodedTopItalian = json_encode($topItalian);
        $cache->store('topItalian', $encodedTopItalian);
    }

    function topEnglish() {
        global $conn;
        connect();
        global $topEnglish;
        global $cache;

		$sql = "SELECT id, first_name, last_name, scoreAnglais, user_image from users ORDER BY scoreAnglais DESC LIMIT 5";
		
        $result = $conn->query($sql);
        while($row = $result->fetch_array())
        {
            $tempArray = [
				"firstName" => $row['first_name'],
                "lastName" => $row['last_name'],
                "score" => $row['scoreAnglais'],
                "image" => $row['user_image'],
                "id" => $row['id'],
            ];
            array_push($topEnglish, $tempArray);
        }
        $encodedTopEnglish = json_encode($topEnglish);
        $cache->store('topEnglish', $encodedTopEnglish);
    }

    function topGerman() {
        global $conn;
        connect();
        global $topGerman;
        global $cache;

		$sql = "SELECT id, first_name, last_name, scoreAllemand, user_image from users ORDER BY scoreAllemand DESC LIMIT 5";
		
        $result = $conn->query($sql);
        while($row = $result->fetch_array())
        {
            $tempArray = [
				"firstName" => $row['first_name'],
                "lastName" => $row['last_name'],
                "score" => $row['scoreAllemand'],
                "image" => $row['user_image'],
                "id" => $row['id'],
            ];
            array_push($topGerman, $tempArray);
        }
        $encodedTopGerman = json_encode($topGerman);
        $cache->store('topGerman', $encodedTopGerman);
    }

?>