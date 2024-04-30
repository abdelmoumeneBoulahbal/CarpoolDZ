<?php
    session_start();

    $is_invalid = false;

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        $mysqli = require __DIR__ ."../../database.php";

        if($_SESSION["user_type"] == "Passenger"){

            $sql = sprintf("SELECT * FROM passenger 
                        WHERE email = '%s'",
                        $mysqli->real_escape_string($_POST["email_login"]));
                        
                        $result = $mysqli->query($sql);
                        $user = $result->fetch_assoc();
                        
                        if($user){
                            if(password_verify($_POST["password_login"], $user["password"])){
                                session_start();
                                session_regenerate_id();
                                $_SESSION["passenger_id"] = $user["passengerID"];
                                
                                header("Location: Profile-Pass.php");
                                exit;
                            }
                        }
                        
                        $is_invalid = true;
        }
        else if($_SESSION["user_type"] == "Driver"){

        }
                        
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
    <link href="../styles/login.css" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <header>
        <nav>
            <div>
                <a href="./index.html">
                    <h1>CarpoolDZ</h1>
                </a>
            </div>
  
        </nav>
    </header>
    <h2>Log In</h2>
    <?php if($is_invalid): ?>
        <h3 class="message">Invalid Data</h3>
    <?php endif; ?>
    <div class="form-div">

        <form method="post" action="">
            <input id="email" type="email" name="email_login" placeholder="Email"
            value=" <?= htmlspecialchars($_POST["email_login"] ?? "") ?> "
            ><br>
            <input id="password" type="password" name="password_login" placeholder="Password"><br>
            <button name="login">Login</button>
        </form>
    
    </div>


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