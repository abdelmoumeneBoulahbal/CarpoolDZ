<?php

    $db_server = "localhost";
    $db_user = "root";
    $db_password = "";

    $db_name = "carpooldz";
    
    $connectTodb = "";

    try{
        $connectTodb = mysqli_connect($db_server, $db_user, $db_password, $db_name);
    }catch(mysqli_sql_exception){
        echo "Connection Failed<br>";
    }

    if($connectTodb){
        echo"<div>
                <h2>Connected To DataBase Successfully</h2>
            </div>";
    }
?>