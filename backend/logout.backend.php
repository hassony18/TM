<?php

session_start();
session_unset();
session_destroy();
$_SESSION['userId'] = null;
$_SESSION['userUid'] = null;
$_SESSION['user_image'] = null;
$_SESSION['username'] = null;
$_SESSION['first_name'] = null;
$_SESSION['last_name'] = null;
$_SESSION['email'] = null;
$_SESSION['user_image'] = null;
header("Location: ../index.php");