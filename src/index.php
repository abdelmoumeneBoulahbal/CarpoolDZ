

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">    
    <link href="./style.css" rel="stylesheet" />
   
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

                <img src="../img/icons/angle-small-down.png"  class="dropbtn" id="arrow">

                <div class="dropdown-menu" id="myDropdown">
                    <ul class="dropdown-menu-list">
                        <li class="signup" id="signup">Sign Up</li>
                        <li>Log In</li>
                        <li>About Us</li>
                        <li>Search</li>
                    </ul>
                </div>
                
            </div>
  
        </nav>
    </header>

    <main>
        
        <!--Hero and Search Bar-->
        <section id="search-home-section" class="search-home-section" >
            <div class="hero-div">
                <img src="../img/hero-img.jpg" />
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
                <img src="../img/car.png">
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
                <img src="../img/avatar/avatar1.svg">
                <p>I was looking for a service capable of<br>offering trips!</p>

            </div>

            <div class="client-2">
                <p>I was looking for a service<br>capable of offering trips from<br>several companies!</p>
                <img src="../img/avatar/avatar2.svg">
            </div>

            <div class="client-3">
                <img src="../img/avatar/avatar3.svg">
                <p>I was looking for a service capable of<br>offering trips from several companies!</p>
            </div>
    
        </section>
        <!--End-->


        <!--Register Section-->
        <section id="register-section" class="register-section">

            <h2 class="registration-title">Registration</h2>

           
                <?php
                // Function to sanitize input
                function sanitizeInput($data) {
                    return htmlspecialchars(trim($data));
                }

                // Array of input names
                $inputs_passenger = array(
                    "name_passenger",
                    "password_passenger",
                    "gender_passenger",
                    "phone_passenger",
                    "email_passenger"
                );
                $inputs_driver = array(
                    "name_driver",
                    "password_driver",
                    "gender_driver",
                    "phone_driver",
                    "email_driver",
                    "exp_driver",
                    "vehic_cap"
                );
                
                if (isset($_POST["submit"])) {

                    if (isset($_POST["user_type"])) {

                        $user_type = $_POST["user_type"];
                        $isEmpty = false;
                        
                        //Passenger Form Check
                        if ($user_type == "Passenger") {
                            foreach ($inputs_passenger as $input) {
                                if (empty($_POST[$input])) {
                                    $isEmpty = true;
                                    break;
                                }
                            }

                            if (!$isEmpty) {

                                $name_passenger = sanitizeInput($_POST["name_passenger"]);
                                $password_passenger = sanitizeInput($_POST["password_passenger"]);
                                $gender_passenger = sanitizeInput($_POST["gender_passenger"]);
                                $phone_passenger = sanitizeInput($_POST["phone_passenger"]);
                                $email_passenger = sanitizeInput($_POST["email_passenger"]);

                                /*echo "New User Added: <br>" . "Type: " . $user_type .
                                    "<br> Name: " . $name_passenger .
                                    "<br> Password: " . $password_passenger .
                                    "<br> Gender: " . $gender_passenger .
                                    "<br> Phone: " . $phone_passenger .
                                    "<br> Email: " . $email_passenger;
                                */
                                echo"
                                    <div class='message'>
                                        <h2>Successfully Submitted as a Passenger</h2>
                                    </div>
                                    ";
                                } else {
                                echo "Please fill in all the inputs!<br>";
                            }
                        }
                        //Driver Form Check
                        else if($user_type == "Driver"){

                            foreach ($inputs_driver as $input) {
                                if (empty($_POST[$input])) {
                                    $isEmpty = true;
                                    break;
                                }
                            }
                            if (!$isEmpty) {

                                $name_driver = sanitizeInput($_POST["name_driver"]);
                                $password_driver = sanitizeInput($_POST["password_driver"]);
                                $gender_driver = sanitizeInput($_POST["gender_driver"]);
                                $phone_driver = sanitizeInput($_POST["phone_driver"]);
                                $email_driver = sanitizeInput($_POST["email_driver"]);
                                $vehicle_cap = sanitizeInput($_POST["vehic_cap"]);
                                $exp_driver = sanitizeInput($_POST["exp_driver"]);

                                /*echo "New User Added: <br>" . "Type: " . $user_type .
                                    "<br> Name: " . $name_driver .
                                    "<br> Password: " . $password_driver .
                                    "<br> Gender: " . $gender_driver .
                                    "<br> Phone: " . $phone_driver .
                                    "<br> Email: " . $email_driver .
                                    "<br> Experience: " . $exp_driver . " years".
                                    "<br> Vehicle Capacity: " . $vehicle_cap;
                                */
                                echo"
                                <div class='message'>
                                    <h2>Successfully Submitted as a Driver</h2>
                                </div>
                                ";
                            } else {
                                echo "
                                    <div class='warning'>
                                        <h2>Please fill in all the inputs!</h2>
                                    </div>
                                ";
                            }

                        }   
                        
                        
                    } else {
                        echo"
                            <div class='warning'>
                                <h2>Please Choose a type!</h2>
                            </div>
                        ";
                    }
                }
            ?>
            
            <div class="register-div">
                <form method="post" id="user-form">
                    <div class="radio-div">
                        <div>
                            <input type="radio" name="user_type" value="Passenger" id="passenger-radio">
                            <label for="passenger-radio" id="passenger-label">Passenger</label>
                        </div>

                        <div>

                            <input type="radio" name="user_type" value="Driver" id="driver-radio">
                            <label for="driver-radio" id="driver-label">Driver</label>
                        </div>
                        
                    </div>


                    <br>
                    <br>


                    <div id="passenger-form" class="hidden">
                        <input type="text" id="name" placeholder="Name" name="name_passenger"> <br>
                        <input type="password" id="password" placeholder="Password" name="password_passenger"> <br>
                        <input type="text" id="gender" placeholder="Gender" name="gender_passenger"> <br>
                        <input type="tel" id="phone" placeholder="Phone" name="phone_passenger"> <br>
                        <input type="email" id="email" placeholder="Email" name="email_passenger"> <br>
                    </div>
                    <div id="driver-form" class="hidden">
                        <input type="text" id="name" placeholder="Name" name="name_driver"><br>
                        <input type="password" id="password" id="password" placeholder="Password" name="password_driver"> <br>
                        <input type="text" id="gender" placeholder="Gender" name="gender_driver"> <br>
                        <div class="exp-cap-div">
                            <input type="number" id="exp" placeholder="Experience" name="exp_driver">
                            <input type="number" id="cap" placeholder="Vehicle Capacity" name="vehic_cap"> <br>
                        </div><br>
                        <input type="tel" id="phone" placeholder="Phone" name="phone_driver"> <br>
                        <input type="email" id="email" placeholder="Email" name="email_driver"> <br>
                    </div>


                    <button id="submit-btn" name="submit">
                        Submit
                    </button>
                </form>
            </div>



        </section>
        <!--End-->

    </main>
    <script src="script.js"></script>

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
