<?php
    include('../database.php');
    session_start();

        if (isset($_SESSION["passenger_id"])){

            $mysqli = require __DIR__ ."../../database.php";
    
            $sql = "SELECT * FROM passenger
                    WHERE passengerID = {$_SESSION["passenger_id"]}
            ";
    
            $result = $mysqli->query($sql);
            
            $user = $result->fetch_assoc();
        }

    // Retrieve user input from the form
    $departure = $_POST['departure'];
    $destination = $_POST['destination'];
    $date = $_POST['date'];
    $seats = $_POST['seats'];

    // Prepare the SQL query with placeholders
    $sql = "SELECT * FROM trip WHERE departureLocation = ? AND arrivalLocation = ? AND date = ? AND numberSeats >= ?";

    try {
        // Prepare the statement
        $stmt = $mysqli->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sssi", $departure, $destination, $date, $seats);
            $stmt->execute();
            
        
            $result = $stmt->get_result();
            if($result->num_rows<0){
                die('No Results Found!');
            }
            
        }else {
            // Error in preparing the statement
            die("Error in preparing the SQL statement!!");
        }
    } catch (mysqli_sql_exception $e) {
        // Exception caught, handle it
        die('Error: ' . $e->getMessage());
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
    <link href="../styles/search.css" rel="stylesheet" />
    <link href="../styles/passenger/profile-passenger.css" rel="stylesheet" />
    
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-thin-straight/css/uicons-thin-straight.css'>
    
    <title>Search</title>
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
                <p class="name-passenger"><?= htmlspecialchars($user["name"]) ?></p>
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
    
    <section class="search-section">

        <div class="left-side-container">

            <div class="sorting-div">

                <h3>Sort by:</h3>
                <div class="sorting-radios">

                    <div class="labels">
                        <label for="lowest-price">Lowest Price</label>
                        <label for="fastest-route">Fastest Route</label>
                        <label for="early-departure">Early departure</label>

                    </div>
                    <div class="inputs">
                        <input class="input-1" type ="radio" id="lowest-price">
                        <input type ="radio" id="fastest-route">
                        <input type ="radio" id="early-departure">

                    </div>

                </div>

            </div>

            <br>

            <span> </span>

            <div class="filter-div">

                <br><h3>Filters:</h3>
                <div class="filter-checks">

                    <div class="labels">
                        <label for="direct-route">Direct route</label>
                        <label for="no-smoking">No Smoking</label>
                        <label for="cert-driver">Certified Driver</label>

                    </div>
                    <div class="inputs">
                        <input type ="checkbox" id="direct-route">
                        <input type ="checkbox" id="no-smoking">
                        <input type ="checkbox" id="cert-driver">

                    </div>

                </div>

            </div>

        </div>



        <div class="right-side-container">
            <?php while($row = $result->fetch_assoc()): ?>
                <a href="Journeydetails-passenger.php?trip_id=<?php echo $row['tripID']; ?>&driver_id=<?php echo $row['DriverID']; ?>" name="trip_card">
                    
                    <div class="trip-card">

                        <div class="trip-card-top">
                            <div class="hours">
                                <p class="departure">
                                    <?php echo date("H:i", strtotime($row["departureTime"]))   ?>
                                </p>
                                <p class="duration">
                                    <?php 
                                        // Split the duration into hours, minutes, and seconds
                                        list($hours, $minutes, $seconds) = explode(":", $row["duration"]);

                                        // Convert hours, minutes, and seconds to integers
                                        $hours = intval($hours);
                                        $minutes = intval($minutes);

                                        // Format the duration
                                        $formattedDuration = $hours . "h" . sprintf("%02d", $minutes);

                                        // Output the formatted duration
                                        echo $formattedDuration; ?>
                                </p>
                                <p class="arrival">
                                <?php echo date("H:i", strtotime($row["arrivalTime"]))   ?>
                                </p>
                            </div>
                            <div class="location">
                                <div class="vline"></div>
                                <span class="dot1"></span>
                                <p class="loc-dep">
                                    <?php echo $row["departureLocation"]; ?>
                                </p>
                                <div class="stops-div">
                                    <p>
                                        <?php echo $row["stop1"] ?>
                                    </p>
                                    <p class="stop2">
                                        <?php echo $row["stop2"] ?>  
                                    </p>
                                </div>
                                
                                <p class= "<?php if($row["stop1"] && $row["stop2"]): echo "arr-loc-with2";  
                                                    elseif($row["stop1"] || $row["stop2"]): echo "arr-loc-with1";
                                                    else: echo "arr-loc";
                                            endif; ?>">

                                    <?php echo $row["arrivalLocation"]; ?>
                                </p>
                                <span class="dot2"></span>

                            </div>
                            <div style="margin-left:80px">
                                <p>
                                    <?php
                                        echo $row["date"];
                                    ?>
                                </p>
                            </div>
                        </div>


                        <div class="trip-card-bottom">
                            <img src="../images/icons/car.png">
                            <?php 
                                $driverID = $row["DriverID"];
                                $driverName = "";

                                $driverQuery = "SELECT name FROM driver WHERE DriverID = $driverID";
                                $driverResult = $mysqli->query($driverQuery);

                                if ($driverResult->num_rows > 0) {
                                    $driverRow = $driverResult->fetch_assoc();
                                    $driverName = $driverRow["name"];
                                }
                            ?>
                            <p class="name">
                                <?php echo $driverName; ?>
                            </p>
                            <p class="price">
                                <?php echo $row["price"] ." DZ" ?>
                            </p>
                        </div>
                    </div>

                </a>
            <?php endwhile ?>
        </div>
    

    </section>

    <script src="../scripts/script.js"></script>
</body>
<footer>
    <div>
        <h3>Contact:</h3>
        <p>Tel: 99 99 99 99</p>
        <p>Mail: abcdefj@gmail.com</p>
        <p>Address : Annaba, Sidi Amar, 5420</p>
    </div>
    <div>
        <h3>
            Quick links:
        </h3>
        <a>Register</a>
        <a>Contact Us</a>
        <a>About us</a>
    </div>
    <div>
        <h3>Miscellaneous information:</h3>
        <a>Our partners</a>
        <a>Our regional headquarters</a>
    </div>

</footer>
</html>

