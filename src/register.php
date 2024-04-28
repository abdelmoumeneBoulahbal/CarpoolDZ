<?php

    include("../database.php");
    session_start();

    if(isset($_POST["submit"])){
        if(isset($_POST["fruits"])){
            $user_type = $_POST["fruits"];
            echo $user;
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
    <!--
        <style>
        .hidden{
            display: none;
        }

        .register-type-div{
  
        display: flex;
        justify-content: center;
        margin: auto;
        
        text-align: center;
        align-items: center;

        }

        .passenger-label{
        margin-right: 100px;
        }

        .register-info-div{
        margin: auto;
        justify-content: center;
        width: fit-content;
        }

        .register-info-div input{
        
        color: rgb(4, 120, 166);

        font-weight: 550;

        display: flex;
        justify-content: center;
        margin: auto;
        

        font-size: 1.7rem;

        border-radius: 30px;


        padding: 20px;
        width: 700px;

        border: 3px solid var(--primary);

        transition: all 0.6s ease;
        }


        #name:focus , #phone:focus, #email:focus, #gender:focus, #exp:focus{
        box-shadow: 0px 0px 20px var(--lightviolet);
        outline-style: none;
        border: 3px solid var(--lightviolet);

        color: rgb(170, 134, 250);
        }
        #carType:focus, #carYear:focus, #carName:focus{
        box-shadow: 0px 0px 20px var(--lightviolet);
        outline-style: none;
        border: 3px solid var(--lightviolet);

        color: rgb(170, 134, 250);
        }
        label{
        transition: all 0.2s ease-in;

        }
        input:checked + label{
        font-weight: bold;
        color: #8c52ff;
        }

        #name{
        margin-top: 45px;
        }

        
    </style>
    -->
    <title>CarpoolDZ</title>
</head>
<body>

<?php
if(isset($_POST["submit"])){
    if(isset($_POST["user_type"])){
        $user_type = $_POST["user_type"];
        echo $user_type;
    }else{
        echo "Please choose a type";
    }
}
?>

<form method="post" action="register.php" id="user-form">
    <input type="radio" name="user_type" value="Passenger" id="passenger-radio">Passenger<br>
    <input type="radio" name="user_type" value="Driver" id="driver-radio">Driver
    <br>
    <br>
    <div id="passenger-form" class="hidden">
        <input type="text" placeholder="Name" name="pasenger_name">
        <input type="password" placeholder="Password" name="passenger_password">
    </div>
    <div id="driver-form" class="hidden">
        <input type="text" placeholder="Name" name="driver_name">
        <input type="password" placeholder="Password" name="driver_password">
        <input type="number" placeholder="Experience" name="driver_exp">
    </div>
    <br>
    <br>
    <input type="submit" name="submit" value="Submit">
</form>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const passengerRadio = document.getElementById("passenger-radio");
    const driverRadio = document.getElementById("driver-radio");
    const passengerForm = document.getElementById("passenger-form");
    const driverForm = document.getElementById("driver-form");

    passengerRadio.addEventListener("change", function() {
        if (passengerRadio.checked) {
            passengerForm.classList.remove("hidden");
            driverForm.classList.add("hidden");
        }
    });

    driverRadio.addEventListener("change", function() {
        if (driverRadio.checked) {
            driverForm.classList.remove("hidden");
            passengerForm.classList.add("hidden");
        }
    });
});
</script>

   
</body>
</html>