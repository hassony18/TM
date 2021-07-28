<?php

    ob_start(); 
    date_default_timezone_set("Europe/Zurich");
    require_once 'cache.class.php';

    $topGerman = array();
    $topEnglish = array();
    $topItalian = array();
    $topFlags = array();
    $topMap = array();

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
        $dbServerName = "localhost";
        $dbServerUsername = "root";
        $dbPassword = "";
        $dbName = "tm";
        $conn = new mysqli($dbServerName, $dbServerUsername, $dbPassword, $dbName);
        if ($conn->connect_error) {
            header('Location: '+mysqli_connect_error());
         }
    }

    function populateWebsite() {
        global $cache;
        global $topGerman;
        global $topEnglish;
        global $topItalian;
        global $topFlags;
        global $topMap;

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
    }

    

    function updateWebsite() {
        topGerman();
        topEnglish();
        topItalian();
        topFlags();
        topMap();
    }

    function topMap() {
        global $conn;
        connect();
        global $topMap;
        global $cache;

		$sql = "SELECT first_name, last_name, scoreCarte from users ORDER BY scoreCarte DESC LIMIT 5";
		
        $result = $conn->query($sql);
        while($row = $result->fetch_array())
        {
            $tempArray = [
				"firstName" => $row['first_name'],
                "lastName" => $row['last_name'],
                "score" => $row['scoreCarte'],
            ];
            array_push($topMap, $tempArray);
        }
        $encodedTopMap = json_encode($topMap);
        $cache->store('topMap', $encodedTopMap);
    }

    function topFlags() {
        global $conn;
        connect();
        global $topFlags;
        global $cache;

		$sql = "SELECT first_name, last_name, scoreDrapeaux from users ORDER BY scoreDrapeaux DESC LIMIT 5";
		
        $result = $conn->query($sql);
        while($row = $result->fetch_array())
        {
            $tempArray = [
				"firstName" => $row['first_name'],
                "lastName" => $row['last_name'],
                "score" => $row['scoreDrapeaux'],
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

		$sql = "SELECT first_name, last_name, scoreItalien from users ORDER BY scoreItalien DESC LIMIT 5";
		
        $result = $conn->query($sql);
        while($row = $result->fetch_array())
        {
            $tempArray = [
				"firstName" => $row['first_name'],
                "lastName" => $row['last_name'],
                "score" => $row['scoreItalien'],
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

		$sql = "SELECT first_name, last_name, scoreAnglais from users ORDER BY scoreAnglais DESC LIMIT 5";
		
        $result = $conn->query($sql);
        while($row = $result->fetch_array())
        {
            $tempArray = [
				"firstName" => $row['first_name'],
                "lastName" => $row['last_name'],
                "score" => $row['scoreAnglais'],
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

		$sql = "SELECT first_name, last_name, scoreAllemand from users ORDER BY scoreAllemand DESC LIMIT 5";
		
        $result = $conn->query($sql);
        while($row = $result->fetch_array())
        {
            $tempArray = [
				"firstName" => $row['first_name'],
                "lastName" => $row['last_name'],
                "score" => $row['scoreAllemand'],
            ];
            array_push($topGerman, $tempArray);
        }
        $encodedTopGerman = json_encode($topGerman);
        $cache->store('topGerman', $encodedTopGerman);
    }

?>