<?php
session_start();

// Check if driver_id session variable is set
if (!isset($_SESSION["driver_id"])){
    // Redirect the user to login page or handle the situation accordingly
    header("Location: login.php");
    exit; // Stop further execution
}

// Include database connection
$mysqli = require __DIR__ . "../../database.php";

// Fetch user data from the database
$sql = "SELECT * FROM driver WHERE DriverID = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $_SESSION["driver_id"]);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();


// Calculate driving level
$driverID = $user["DriverID"];
$exp =  $user["experience"];
$drivingLevel = handleLevel($exp);
// Check if form is submitted


if(isset($_POST["register"])){

    // Check if form is submitted using POST method
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Check if date is empty
        if (empty($_POST['date'])) {
            die("Please enter a date.");
        }

        // Check if date is less than today's date
        if (strtotime($_POST['date']) < strtotime(date('Y-m-d'))) {
            die("Please enter a valid date.");
        }

        // Check if number of seats is empty or greater than 4
        if (empty($_POST['number_seats']) || $_POST['number_seats'] > 4) {
            die("Number of seats must be between 1 and 4.");
        }

        // Check other required fields
        if (empty($_POST['depart_loca']) || empty($_POST['depart_time']) || empty($_POST['arriv_loca']) || empty($_POST['arriv_time'])) {
            die("Please fill in all required fields.");
        }

        // Include database connection
        $mysqli = require __DIR__ . "../../database.php";

        // Prepare SQL statement
        $sql = "INSERT INTO trip (DriverID, date, departureLocation, arrivalLocation, departureTime, arrivalTime, duration, numberSeats,  price, stop1, stop2) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Calculate duration
        $dateTime1 = new DateTime($_POST["depart_time"]);
        $dateTime2 = new DateTime($_POST["arriv_time"]);

        $duration = $dateTime1->diff($dateTime2);
        $diffHours = $duration->h;
        $diffMinutes = $duration->i;
        $diffSeconds = $duration->s;

        $totalMinutes = ($diffHours * 60) + $diffMinutes + ($diffSeconds / 60);
        // Format duration as HH:MM:SS
        $formattedDuration = gmdate("H:i:s", $totalMinutes * 60);

        // Prepare and bind parameters
        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            die("SQL error:" . $mysqli->error);
        }

        $stmt->bind_param('issssssssss',
            $driverID,
            $_POST["date"],
            $_POST["depart_loca"],
            $_POST["arriv_loca"],
            $_POST["depart_time"],
            $_POST["arriv_time"],
            $formattedDuration,
            $_POST["number_seats"],
            $_POST["price"],
            $_POST["stop1"],
            $_POST["stop2"]
        );

        // Execute statement
        try {
            $stmt->execute();

            session_start();

            header("Location: ../../../pages/signup-success.html");
            exit; // Important to prevent further execution
        } catch (mysqli_sql_exception $e) {
            die("Execution Failed to send data: " . $e->getMessage());
        }
    }
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



