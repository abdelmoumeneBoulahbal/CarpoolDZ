<?php

include('../database.php');
session_start();

    if (isset($_SESSION["passenger_id"])){

        $mysqli = require __DIR__ ."../../database.php";

        $sql_pass = "SELECT * FROM passenger
                WHERE passengerID = {$_SESSION["passenger_id"]}
        ";

        $result_passenger = $mysqli->query($sql_pass);
        
        $passenger = $result_passenger->fetch_assoc();
    }


$trip_id = $_GET['trip_id'];

$trip_query = "SELECT * FROM trip WHERE tripID = ?";

try {

    $stmt = $mysqli->prepare($trip_query);
    if ($stmt) {
 
        $stmt->bind_param("i", $trip_id);
        $stmt->execute();
        

        $trip_result = $stmt->get_result();
        

        if ($trip_result->num_rows > 0) {
   
            $trip_details = $trip_result->fetch_assoc();

        } else {
            die("Trip not found!");
        }
    } else {

        die("Error in preparing the SQL statement!");
    }
} catch (mysqli_sql_exception $e) {
    
    echo 'Error: ' . $e->getMessage();
}

$driver_id = $_GET['driver_id'];

if (isset($driver_id)){

    $mysqli = require __DIR__ ."../../database.php";

    $sql = "SELECT * FROM driver
            WHERE DriverID = {$driver_id}
    ";

    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();

    $exp =  $user["experience"];

    $drivingLevel = handleLevel($exp);
}
function handleLevel($exp){
    $level = ""; 
    $color = "";
    
    if($exp == 1) {
        $level = "Novice";
        $color = "#075182"; // Dark Blue
    } elseif($exp == 2) {
        $level = "Beginner";
        $color = "rgb(255, 0, 55)"; // Light Pink
    } elseif($exp > 2 && $exp <= 5) {
        $level = "Intermediate";
        $color = "rgb(140, 109, 213)"; // Light Violet
    } elseif($exp > 5 && $exp <= 10) {
        $level = "Proficient";
        $color = "#6c36d7"; // Dark Violet
    } elseif($exp > 10 && $exp <= 15) {
        $level = "Experienced";
        $color = "rgb(4,181,194)"; // Primary Color
    } elseif($exp > 15 && $exp <= 20) {
        $level = "Seasoned";
        $color = "#800080"; // Purple
    } elseif($exp > 20 && $exp <= 30) {
        $level = "Expert";
        $color = "rgba(211, 32, 56, 0.863)"; // Pink
    } elseif($exp > 30) {
        $level = "Veteran";
        $color = "#FFA500"; // Orange
    }
    
    return array("level" => $level, "color" => $color);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">       
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-thin-straight/css/uicons-thin-straight.css'>
    
    <link href="../styles/journeydetails.css" rel="stylesheet">
    <link href="../styles/passenger/profile-passenger.css" rel="stylesheet"/>
    <title>Journey</title>
</head>
<body>

<header>
        <nav>
            <div>
                <a href="../home/passenger-home.php">
                    <h1>CarpoolDZ</h1>
                </a>

            </div>

            <div class="menu-container">
                <p class="name-passenger"><?= htmlspecialchars($passenger["name"]) ?></p>
                <a href="../pages/Profile-Pass.php">
                    <img src="../images/avatar/passenger (2).png" class="avatar-passenger">
                </a>
                <img src="../images/icons/angle-small-down.png"  class="dropbtn" id="arrow">

                <div class="dropdown-menu" id="myDropdown" >
                    <ul class="dropdown-menu-list">
                        <a href="../pages/Profile-Pass.php">
                            <li class="profile">Profile</li>
                        </a>
                        <a href="../home/passenger-home.php">
                            <li>Search</li>
                        </a>
                        <a href="../php/logout.php">
                            <li class="logout">Log out</li>
                        </a>
                    </ul>
                </div>
                
            </div>
  
        </nav>
</header>

    <section>
        <h2>Journey details</h2>

        <div class="full-info-div">
            <div class="car-name">
                <img src="../images/icons/car.png" class="bus-icon">
                <p class="name">
                    <?php echo $user["name"]; ?>
                </p>
            </div>

            <div class="trip-card">

                <div class="trip-card-top">
                    <div class="hours">
                        <p class="departure">
                                    <?php echo date("H:i", strtotime($trip_details["departureTime"]))   ?>
                        </p>
                        <p class="duration">
                            <?php 
                                // Split the duration into hours, minutes, and seconds
                                list($hours, $minutes, $seconds) = explode(":", $trip_details["duration"]);
                                
                                // Convert hours, minutes, and seconds to integers
                                $hours = intval($hours);
                                $minutes = intval($minutes);
                                
                                // Format the duration
                                $formattedDuration = $hours . "h" . sprintf("%02d", $minutes);
                                
                                // Output the formatted duration
                                echo $formattedDuration; ?>
                        </p>
                        <p class="arrival">
                            <?php echo date("H:i", strtotime($trip_details["arrivalTime"]))   ?>
                        </p>
                    </div>
                            
                    <div class="location">
                        <div class="vline"></div>
                        <span class="dot1"></span>
                        <p class="loc-dep">
                            <?php echo $trip_details["departureLocation"]; ?>
                        </p>
                        <p class="loc-arr">
                            <?php echo $trip_details["arrivalLocation"]; ?>
                        </p>
                        <span class="dot2"></span>
                    </div>
                </div>

                <div class="trip-card-bottom">
                    <p>
                        <?php
                            echo $trip_details["date"];
                        ?>
                    </p>
                    <p class="price">
                        <?php
                            echo $trip_details["price"] . " DZ";
                        ?>
                    </p>
                </div>

            </div>

            <h3 class="option-title">Options:</h3>
        </div>
        <div class="details-div">
            <div class="left-info">
                <p>Rating: ⭐⭐⭐⭐</p>
                <p>
                    Experience: 
                    <?php 
                        echo $user["experience"];
                    ?> years
                </p>
                <p class="level-header" style="color: <?php echo $drivingLevel['color']; ?>">
                    Driving Category: <?php echo $drivingLevel['level']; ?>
                </p>
                <p>Cancels and Delays: 1/20</p>
                <p>Contact: 0<?php echo $user["phone"] ?></p>
            </div>
            <div class="btns">
                <a href="#">
                    <button class="btn-1">
                        Reservation request
                    </button>
                </a>
                <br>
                <span class="line"></span>
                <a href="./Search.html">
                    <button class="btn-2">
                        Return
                    </button>
                </a>
            </div>
            <div class="right-info">
                <p>No smoking</p>
                <p>Certified driver</p>
                <p>Direct Route</p>
            </div>
        </div>

    </section>
    <script src="../scripts/script.js"></script>
</body>
</html>