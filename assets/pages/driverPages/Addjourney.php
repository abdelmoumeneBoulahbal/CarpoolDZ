<?php
    session_start();


    if (isset($_SESSION["driver_id"])){

        $mysqli = require __DIR__ ."../../../database.php";

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
    
    <link href="../../styles/driver/driver-pages/addjourney.css" rel="stylesheet">
    <title>Add Journey</title>
</head>
<body>

    <header>
        <nav>
            <div>
                <a href="../../home/driver-home.php">
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
                <a href="../Profile-Driver.php">
                    <img src="../../images/avatar/driver (2).png" class="avatar-driver">
                </a>
                <img src="../../images/icons/angle-small-down.png"  class="dropbtn" id="arrow">

                <div class="dropdown-menu" id="myDropdown">
                    <ul class="dropdown-menu-list">
                        <a href="../Profile-Driver.php">
                            <li>Profile</li>
                        </a>
                        <a href="../../home/driver-home.php">
                           <li>Search</li>
                        </a>
                        <a href="../../php/logout.php">
                            <li>Log out</li>
                        </a>
                    </ul>
                </div>
                
            </div>
  
        </nav>
    </header>

    <section>
        <h2>Publish a journey</h2>
        <form method="post" action="../../php/add-journey.php" class="container">
            <label for="date">Date</label><br>
            <input type="date" name="date" id="date">
            <input type="number" name="number_seats" id="nmb-seats" placeholder="Places"><br>
            <input type="text" name="depart_loca" id="dep-loc" placeholder="Departure">
            <input type="time" name="depart_time" id="dep-time" placeholder="Time">
            <br>
            <input type="text" name="arriv_loca" id="arr-loc" placeholder="Arrival">
            <input type="time" name="arriv_time" id="arr-time" placeholder="Time">
            <br>
            <input type="text" name="stop1" id="stop1" placeholder="Stop 1">
            <input type="text" name="stop2" id="stop2" placeholder="Stop 2">
            <br>
            <input type="number" name="price" id="price" placeholder="Price">
            <input type="text" name="filters" id="filter" placeholder="Filters">
            <br>
            <button name="register">
                Register
            </button>
        </form>

    </section>

    <script src="../../scripts/script.js"></script>
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