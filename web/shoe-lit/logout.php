<?php

session_start();

$_SESSION['user'] = '';

header("Location: ./login.php");
die();

?>