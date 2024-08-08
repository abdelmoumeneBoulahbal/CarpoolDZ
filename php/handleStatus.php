<?php
    session_start();

    $passenger_id = $_GET["passenger_id"];
    $trip_id = $_GET["trip_id"];
    $status = $_GET["status"];

    $mysqli = require __DIR__ ."../../database.php";
    
    $sql = "UPDATE passengerjourneys SET statusPassenger = ? 
            WHERE passengerID = ?
            AND tripID = ?
    ";

    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        // Bind parameters
        $stmt->bind_param('sii', $status, $passenger_id, $trip_id);
        
        // Execute query
        if ($stmt->execute()) {

            header("Location:../pages/status-updt-success.html");
            exit();
        } else {
            echo "Error updating status: " . $mysqli->error;
        }
        
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $mysqli->error;
    }



?>