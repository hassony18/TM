<?php

session_start();
session_unset();
session_destroy();
foreach($_SESSION as $key => $value) {
    $_SESSION[$key] = null;
}
header("Location: ../index.php");