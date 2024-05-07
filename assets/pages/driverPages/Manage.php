<?php
    session_start();


    if (isset($_SESSION["driver_id"])){

        $mysqli = require __DIR__ . '../../../database.php';

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
    <link href="../../styles/driver/driver-pages/manage.css" rel="stylesheet" />
   
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-thin-straight/css/uicons-thin-straight.css'>
    
    <title>Manage Trip</title>
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
                        <a href="./Addjourney.php">
                            <li>Add Journey</li>
                        </a>
                        <a href="../../home/driver-home.php">
                            <li>Search</li>
                        </a>
                        <a href="../Profile-Driver.php">
                            <li>Profile</li>
                        </a>                    
                        <a href="../../php/logout.php">
                            <li>Log out</li>
                        </a>
                    </ul>
                </div>
                
            </div>
  
        </nav>
    </header>

    <h2>Manage a journey</h2>
    <section>

        <div>
            <h3>Journey: 20/02/24 Annaba/Setif</h3>
            <div>
                <table>
                    <tr>
                        <td>Amine</td>
                        <td>man</td>
                        <td>27</td>
                        <td>Setif</td>
                        <td  class="button-td">
                            <button class="ok-btn">
                                OK
                            </button>
                            <button class="no-btn">
                                NO
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>Yacine</td>
                        <td>man</td>
                        <td>77</td>
                        <td>Setif</td>
                        <td class="button-td">
                            <button class="ok-btn">
                                OK
                            </button>
                            <button class="no-btn">
                                NO
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>Nadia</td>
                        <td>woman</td>
                        <td>33</td>
                        <td>Constantine</td>
                        <td class="button-td">
                            <button class="ok-btn">
                                OK
                            </button>
                            <button class="no-btn">
                                NO
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
            <a href="./Profile.html">
                <button class="return-btn">
                    Return
                </button>
            </a>
        </div>
    </section>

    <script src="../../scripts/script.js"></script>
</body>
</html>