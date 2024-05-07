<?php
    session_start();


    if (isset($_SESSION["passenger_id"])){

        $mysqli = require __DIR__ ."../../database.php";

        $sql = "SELECT * FROM passenger
                WHERE passengerID = {$_SESSION["passenger_id"]}
        ";

        $result = $mysqli->query($sql);
        
        $user = $result->fetch_assoc();
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
    <link href="../styles/passenger/passenger-home.css" rel="stylesheet" />
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
                <form class="input-form" id="search" method="post" action="../pages/search-passenger.php">
                    <div class="bg-search">
                        <datalist id="depature">
                        <option value="Internet Explorer">
                        <option value="Firefox">
                        <option value="Google Chrome">
                        <option value="Opera">
                        <option value="Safari">
                        </datalist>
                        <input name="departure" type="text" class="depature" list="depature" placeholder="Depature" id="search">
        
                        <datalist id="destination">
                            <option value="Internet Explorer">
                            <option value="Firefox">
                            <option value="Google Chrome">
                            <option value="Opera">
                            <option value="Safari">
                        </datalist>
                        <input name="destination" type="text" list="destination" placeholder="Destination" id="search"> 
        
                        <datalist id="date">
                            <option value="Internet Explorer">
                            <option value="Firefox">
                            <option value="Google Chrome">
                            <option value="Opera">
                            <option value="Safari">
                        </datalist>
                        <input name="date" type="date" list="date" placeholder="Date" id="search">
        
                    
                        <datalist id="seats">
                            <option value="Internet Explorer">
                            <option value="Firefox">
                            <option value="Google Chrome">
                            <option value="Opera">
                            <option value="Safari">
                        </datalist> 
                        <input name="seats" type="number" list="seats" class="passenger" placeholder="Seats" id="search">
                    </div>
                    
                    <button class="search-button" name="search">
                            Search
                    </button>
                </form>
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
