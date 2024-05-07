<?php

include('../database.php');
session_start();
$not_logged = $_SESSION["isLoggedIn"];

if($not_logged==false)
    die('You are Not Logged In Yet, try to login so you can reserve a place in trips!');


?>