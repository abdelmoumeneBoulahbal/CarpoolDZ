<?php
    session_start();


    if (isset($_SESSION["driver_id"])){

        $mysqli = require __DIR__ . '../../database.php';

        $sql = "SELECT * FROM driver
                WHERE DriverID = {$_SESSION["driver_id"]}
        ";        

        $result = $mysqli->query($sql);
        
        $user = $result->fetch_assoc();


        $exp =  $user["experience"];

        $drivingLevel = handleLevel($exp);
    };


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
    

    $trip_sql = "SELECT * FROM trip 
                    WHERE DriverID = ?
                    ";
        

    //Driver Trips
    $driverID = $_SESSION["driver_id"];
    $stmt = $mysqli->prepare($trip_sql);
    $stmt->bind_param("i", $driverID);
    $stmt->execute();

    $result_trips = $stmt->get_result();




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
    <link href="../styles/driver/profile.css" rel="stylesheet">
    
    <title>My Profile</title>
</head>
<body>

    <header>
        <nav>
            <div>
                <a href="../home/driver-home.php">
                    <h1>CarpoolDZ</h1>
                </a>

            </div>

            <div class="menu-container">
                <div class="info-top-div">
                    <p class="name-header"><?= htmlspecialchars($user["name"]) ?></p><br>
                    <p class="level-header" style="color: <?php echo $drivingLevel['color']; ?>">
                        <?php echo $drivingLevel['level']; ?>
                    </p>
                </div>
                <img src="../images/avatar/driver (2).png" class="avatar-driver">
                <img src="../images/icons/angle-small-down.png"  class="dropbtn" id="arrow">

                <div class="dropdown-menu" id="myDropdown">
                    <ul class="dropdown-menu-list">
                        <a href="../pages/driverPages/Addjourney.php">
                            <li class="add-jrn">Add Journey</li>
                        </a>
                        <a href="../home/driver-home.php">
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

        <div class="left-side">
            <h2 class="h2">My Profile</h2>
                <?php if (isset($user)): ?>

                    <p>Name : <span class="name"><?= htmlspecialchars($user["name"]) ?></span></p>
                    <p>Email : <span class="email"><?= htmlspecialchars($user["email"]) ?></span></p>
                    <p>Contact : <span class="phone">0<?= htmlspecialchars($user["phone"]) ?> </span></p>
                    <p>Experience: <span class="experience" style="color: <?php echo $drivingLevel['color']; ?>"><?= htmlspecialchars($user["experience"]) ?> years </span></p>
                    <div class="hover-container">
                        <p class="skill-list-hover">Driving Category: 
                            <span class="level" style="color: <?php echo $drivingLevel['color']; ?>">
                                <?php echo $drivingLevel['level']; ?>
                            </span>    
                        </p>
                        <div class="skill-list">
                            <h3 style="font-weight:bold; font-size:13px; color:white;">Note : This Ranking System is based purely on years that the user has spent driving</h3>
                            <ul>
                                <li class="novice">● Novice: "New to the road – gaining confidence." (0-1&nbsp;years).</li>
                                <li class="beginner">● Beginner: "Starting to navigate with ease." (1-2&nbsp;years).</li>
                                <li class="intermediate">● Intermediate: "Building skills and awareness." (2-5&nbsp;years).</li>
                                <li class="proficient">● Proficient: "Confident and capable behind the wheel." (5-10&nbsp;years).</li>
                                <li class="experienced">● Experienced: "Seasoned driver with ample road knowledge." (10-15&nbsp;years).</li>
                                <li class="seasoned">● Seasoned: "Master of the road – adept at handling any situation." (15-20&nbsp;years).</li>
                                <li class="expert">● Expert: "Exceptional skill and precision in driving." (20+&nbsp;years).</li>
                                <li class="veteran">● Veteran: "Decades of experience – a true road warrior." (30+&nbsp;years).</li>
                            </ul>
                            
                        </div>
                    </div>

                    <p>Cancels/Delays: <span class="delays">2/10</span></p>
                    <p>Certified: <span class="certified">No</span></p>

                <?php else: ?>
                <p class="message">
                    <a href="Login.php" class="login-link">Login In</a> 
                        or 
                    <a href="../index.html" class="signup-link">Signup</a>
                </p> 
                <?php endif; ?>  

        </div>
    


        <div class="right-side">
            <h2>My journeys</h2>
            
                <a href="./driverPages/Addjourney.php" class="newjourbtn">
                        New Journey
                </a>

            <div class="table-info">
                <?php if ($result_trips->num_rows > 0): ?>
                    <?php while ($row = $result_trips->fetch_assoc()): ?>
                    <div class="row">
                        <p>
                            <?php echo htmlspecialchars($row["date"]) ?>
                        </p>
                        <p style="text-align: center;">
                        <?php

                            // Parse duration string into DateTime object
                            $duration = new DateTime($row["duration"]);
                                        
                            // Get the hours component from the duration
                            $hours = $duration->format('H');
                            
                            echo $hours . "h";
                            ?>
                        </p>
                        <p><?php echo htmlspecialchars($row["departureLocation"]) ?>/<?php echo htmlspecialchars($row["arrivalLocation"]) ?></p>

                        <a href="./driverPages/Manage.php">
                            Manage
                        </a>
                    </div>
                    <?php endwhile ?>
                <?php endif ?>
       
                

            </div>
        
        </div>
    </section>

    <script src="../scripts/script.js">

    </script>

</body>
</html>

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