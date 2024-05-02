<?php
    session_start();


    if (isset($_SESSION["driver_id"])){

        $mysqli = require __DIR__ ."../../database.php";

        $sql = "SELECT * FROM driver
                WHERE DriverID = {$_SESSION["driver_id"]}
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
                <p class="name-header"><?= htmlspecialchars($user["name"]) ?></p>
                <img src="../images/avatar/driver (2).png" class="avatar-driver">
                <img src="../images/icons/angle-small-down.png"  class="dropbtn" id="arrow">

                <div class="dropdown-menu" id="myDropdown">
                    <ul class="dropdown-menu-list">
                        <a href="../driver pages/Addjourney.html">
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
                    <p>Experience: <span class="experience"><?= htmlspecialchars($user["experience"]) ?> </span></p>
                    <p>Cancels/Delays: <span>2/10</span></p>
                    <p>Driving Category: <span>Used to</span></p>
                    <p>Certified: <span>No</span></p>

                <?php else: ?>
                <p class="message">
                    <a href="Login.php" class="login-link">Login In</a> 
                        or 
                    <a href="../index.html" class="signup-link">Signup</a>
                </p> 
                <?php endif; ?>  
            </div>

    </div>
    


        <div class="right-side">
            <h2>My journeys</h2>
            
                <a href="./Addjourney.html">
                    <button class="newjourbtn">
                        New Journey
                    </button>
                </a>

            <div class="table-info">
                <div class="row">
                    <p>2/2/23</p>
                    <p>8h</p>
                    <p>Annaba/Setif</p>

                    <button>
                        <a href="./Manage.html">
                            Manage
                        </a>
                    </button>
                </div>
                <div class="row">
                    <p>2/2/23</p>
                    <p>8h</p>
                    <p>Annaba/Setif</p>

                    <button>
                        <a href="#">
                            Manage
                        </a>
                    </button>
                </div>
                <div class="row">
                    <p>2/2/23</p>
                    <p>8h</p>
                    <p>Annaba/Setif</p>

                    <button>
                        <a href="#">
                            Manage
                        </a>
                    </button>
                </div>
            </div>
        
        </div>
    </section>

    <script src="../scripts/script.js"></script>

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