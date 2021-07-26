<?php

session_start();
session_unset();
session_destroy();
$_SESSION['userFirstName'] = null;
$_SESSION['userLastName'] = null;
$_SESSION['userFullName'] = null;
$_SESSION['user_image'] = null;
header("Location: ../index.php");