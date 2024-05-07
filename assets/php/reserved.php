<?php
    include("../database.php");

    $passenger_id = $_GET["passenger_id"];
    $trip_id = $_GET["trip_id"];

    $sql = "INSERT INTO passengerjourneys (tripID, passengerID) 
            VALUES ('$trip_id', '$passenger_id') 
     ";


try {

    $stmt = $mysqli->prepare($sql);
    if ($stmt) {

        $stmt->execute();
        header("Location:../pages/reserved-success.html");
        
    } else {

        die("Error in preparing the SQL statement!");
    }

   
} catch (mysqli_sql_exception $e) {
    
    echo 'Error: ' . $e->getMessage();
}



?>