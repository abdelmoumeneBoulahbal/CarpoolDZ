<?php

    $db_server = "localhost";
    $db_user = "root";
    $db_password = "";

    $db_name = "carpooldz";
    
    $mysqli = new mysqli($db_server, $db_user, $db_password, $db_name);

    if ($mysqli->connect_errno) {
        die("Connection error : ". $mysqli->connect_error);
    }

    return $mysqli;

?>