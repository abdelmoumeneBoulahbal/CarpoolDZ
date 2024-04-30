<?php
    if(isset($_POST["submit"])){
        if($_POST["user_type"]=="Passenger"){ //validate passenger info

            if(empty($_POST["name_passenger"])){
                die("Name is required");
            }
        
            if( ! filter_var($_POST["email_passenger"], FILTER_VALIDATE_EMAIL)){
                die("Invalid email Passenger");
            }
        
            if( strlen($_POST["password_passenger"]) < 8){
                die("Password must be at least 8 chars");
            }
        
            if( ! preg_match("/[a-z]/i", $_POST["password_passenger"])){
                die("Password must contain a letter");
            }
            if( ! preg_match("/[0-9]/", $_POST["password_passenger"])){
                die("Password must contain a number");
            }

            $password_hash_passenger = password_hash($_POST["password_passenger"], PASSWORD_DEFAULT);
            $mysqli = require  __DIR__ . "../../database.php";
            
            $sql = "INSERT INTO passenger (name, password, 
                                            email, gender, phone)
                    VALUES (?, ?, ?, ?, ?)";

            $stmt = $mysqli->stmt_init();

            if(! $stmt->prepare($sql)){
                die('SQL error: ' . $mysqli->error);
            }

            $stmt->bind_param(  'sssss', 
                                $_POST['name_passenger'],
                                $password_hash_passenger,    
                                $_POST["email_passenger"],
                                $_POST["gender_passenger"],
                                $_POST["phone_passenger"],
                            );

            try{
                $stmt->execute();
                session_start();
                $_SESSION["user_type"] = $_POST["user_type"];

                header("Location: signup-success.php");
            }catch(mysqli_sql_exception){
                die("Email already taken");
            }


        
        } else if($_POST["user_type"]=="Driver"){ //validate driver info

            if(empty($_POST["name_driver"])){
                die("Name is required");
            }
        
            if( ! filter_var($_POST["email_driver"], FILTER_VALIDATE_EMAIL)){
                die("Invalid email Driver");
            }
        
            if( strlen($_POST["password_driver"]) < 8){
                die("Password must be at least 8 chars Driver");
            }
        
            if( ! preg_match("/[a-z]/i", $_POST["password_driver"])){
                die("Password must contain a letter");
            }
            if( ! preg_match("/[0-9]/", $_POST["password_driver"])){
                die("Password must contain a number");
            }
        
        
        }else {
            die("Please Choose a Type.");
        }

    }




?>