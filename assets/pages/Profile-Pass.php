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
    <link href="../styles/profile-passenger.css" rel="stylesheet" />
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-thin-straight/css/uicons-thin-straight.css'>
    <title>My Profile</title>
</head>
<body>

    <header>
        <nav>
            <div>
                <a href="./index.html">
                    <h1>CarpoolDZ</h1>
                </a>
            </div>

            <div class="menu-container">

                <div>
                    <a href="./pages/Profile.html">
                        <i style="text-decoration: none !important;" class="fa-solid fa-circle-user icon-home"></i>
                    </a>
                </div>

                <img src="../images/icons/angle-small-down.png"  class="dropbtn" id="arrow">

                <div class="dropdown-menu" id="myDropdown">
                    <ul class="dropdown-menu-list">    
                        <li>Search</li>
                    </ul>
                </div>
                
            </div>
  
        </nav>
    </header>
    

        <div class="container">
            <div class="titles">
                <h1 class="my-prf">My Profile</h1>
            </div>
              <div>
                  <h1 class="my-jrn">My journeys</h1>
              </div>

            <div class="left-side">
                <?php if (isset($user)): ?>

                    <p>Name : <span class="name"><?= htmlspecialchars($user["name"]) ?></span></p>
                    <p>Email : <span class="email"><?= htmlspecialchars($user["email"]) ?></span></p>
                    <p>Phone : <span class="phone"><?= htmlspecialchars($user["phone"]) ?></span></p>

                <?php else: ?>
                <p><a href="login.php">Login In</a> or <a href="signup-proc.php">Signup</a></p> 
                <?php endif; ?>  
            </div>
            
            <div class="right-side">
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Depart/Arrival</th>
                        <th>Status</th>
                    </tr>
                    <tr>
                        <td>1/12/24</td>
                        <td>1/12/24</td>
                        <td>1/12/24</td>
                        <td>1/12/24</td>
                    </tr>
                    <tr>
                        <td>1/12/24</td>
                        <td>1/12/24</td>
                        <td>1/12/24</td>
                        <td>1/12/24</td>
                    </tr>
                </table>
            </div>
        </div>

    
</body>

<script>
let dropbtn = document.getElementById("arrow");
                
                dropbtn.onclick = function () {
                    
                    document.getElementById("myDropdown").classList.toggle("show");
                    
                    let currentSrc = dropbtn.getAttribute("src");
                
                    if (currentSrc === "../images/icons/angle-small-down.png") {
                    
                        dropbtn.setAttribute("src", "../images/icons/angle-small-up.png");
                
                    } else if (currentSrc === "../images/icons/angle-small-up.png") {
                
                        dropbtn.setAttribute("src", "../images/icons/angle-small-down.png");
                    }
                }
                
                window.onclick = function(event) {
                    if (!event.target.matches('.dropbtn')) {
                        var dropdowns = document.getElementsByClassName("dropdown-menu");
                        var i;
                        for (i = 0; i < dropdowns.length; i++) {
                            var openDropdown = dropdowns[i];
                            if (openDropdown.classList.contains('show')) {
                
                                openDropdown.classList.remove('show');
                
                
                                let currentSrc = dropbtn.getAttribute("src");
                                if (currentSrc === "../images/icons/angle-small-down.png") {
                                    dropbtn.setAttribute("src", "../images/icons/angle-small-up.png");
                                }
                
                
                            }
                        }
                    }
                
                
                }

</script>
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