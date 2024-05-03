<?php
    session_start();


    if (isset($_SESSION["driver_id"])){

        $mysqli = require __DIR__ ."../../database.php";

        $sql = "SELECT * FROM driver
                WHERE DriverID = {$_SESSION["driver_id"]}
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
    <link href="../styles/driver/driver-home.css" rel="stylesheet" />
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-thin-straight/css/uicons-thin-straight.css'>
    <style>
        .hidden{
            display: none;
        }
    </style>    
    <title>CarpoolDZ</title>
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
                <a href="../pages/Profile-Driver.php">
                    <img src="../images/avatar/driver (2).png" class="avatar-driver">
                </a>
                <img src="../images/icons/angle-small-down.png"  class="dropbtn" id="arrow">

                <div class="dropdown-menu" id="myDropdown" >
                    <ul class="dropdown-menu-list">
                        <a href="../pages/Addjourney.html">
                            <li class="add-jrn">Add Journey</li>
                        </a>
                        <a href="../pages/Profile-Driver.php">
                            <li class="profile">Profile</li>
                        </a>
                        <a href="../php/logout.php">
                            <li class="logout">Log out</li>
                        </a>
                    </ul>
                </div>
                
            </div>
  
        </nav>
</header>

    <main>
        
        <!--Hero and Search Bar-->
        <section id="search-home-section" class="search-home-section" >
            <div class="hero-div">
                <img src="../images/hero-img.jpg" />
            </div>
            <div class="input-div" >
                <form class="input-form" id="search">
                    <datalist id="depature">
                      <option value="Internet Explorer">
                      <option value="Firefox">
                      <option value="Google Chrome">
                      <option value="Opera">
                      <option value="Safari">
                    </datalist>
                    <input class="depature" list="depature" placeholder="Depature" id="search">
    
                    <datalist id="distination">
                        <option value="Internet Explorer">
                        <option value="Firefox">
                        <option value="Google Chrome">
                        <option value="Opera">
                        <option value="Safari">
                    </datalist>
                    <input list="distination" placeholder="Distination" id="search"> 
    
                    <datalist id="date">
                        <option value="Internet Explorer">
                        <option value="Firefox">
                        <option value="Google Chrome">
                        <option value="Opera">
                        <option value="Safari">
                    </datalist>
                    <input list="date" placeholder="Date" id="search">
    
                   
                    <datalist id="passenger">
                        <option value="Internet Explorer">
                        <option value="Firefox">
                        <option value="Google Chrome">
                        <option value="Opera">
                        <option value="Safari">
                    </datalist> 
                    <input list="passenger" class="passenger" placeholder="Passenger" id="search">
                    
                    
                    
                </form>
                
                <button class="search-button">
                    <a href="./pages/Search.html">
                        Search
                    </a>
                </button>
            </div>
        </section>
        <!--End-->


        <!--Review Section-->
        <section id="review-home-section" class="review-home-section">

            <div class="car-review">
                <img src="../images/car.png">
                <p>We take the time to get<br>
                    to know our members<br>
                    and our partner bus companies. We check<br>
                    reviews, profiles and IDs.<br>
                    So you know who you are<br>going to travel with.
                </p>
            </div>

            <div class="h2">
                <h2>Go everywhere with us!</h2>
            </div>

  
            <div class="client-1">
                <img src="../images/avatar/avatar1.svg">
                <p>I was looking for a service capable of<br>offering trips!</p>

            </div>

            <div class="client-2">
                <p>I was looking for a service<br>capable of offering trips from<br>several companies!</p>
                <img src="../images/avatar/avatar2.svg">
            </div>

            <div class="client-3">
                <img src="../images/avatar/avatar3.svg">
                <p>I was looking for a service capable of<br>offering trips from several companies!</p>
            </div>
    
        </section>
        <!--End-->

    </main>

    <script src="../scripts/script.js">


    </script>

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
        <a href="../php/logout.php">Register with new account</a>
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
