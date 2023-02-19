<?php
    include_once('../../config/app.php');
    include_once('../../controller/authController/authentication/login/LoginController.php');

    LoginController::isLoggedIn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/index.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="../../public/css/popup.css?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"> -->

    <title>Home</title>
</head>
<body>

    <div id="main-card">

        <!-- Login Section -->

        <div id="login-nav">
            <ul>
                <li id="login-list-item">
                    <div id="login">
                        <a onclick="getLogin()">
                            <img src="../../public/icons/login.svg" id="login-icon" class="main-card-icons">
                            <h2 id="login-title">Log In</h2>
                        </a>
                    </div>
                </li>
                <li id="signup-list-item">
                    <div id="signup">
                        <a onclick="getSignup()">
                            <img src="../../public/icons/signup.svg" id="signup-icon" class="main-card-icons">
                            <h2 id="signup-title">Sign Up</h2>
                        </a>
                    </div>
                </li>
            </ul>
        </div>

        <div id="login-form-container">
            <h3>Welcome!</h3>
            <form method="POST" action="../../controller/authController/authentication/login/login.php" name="login-form" id="login-form">

                <input type="text" id="login-username-email" name="login-username-email" placeholder="Username or Email" value="<?php if(isset($_COOKIE["myUsername"])) { echo $_COOKIE["myUsername"]; } ?>" oninput="inputChange()"required><br>
                <input type="password" id="login-password" name="login-password" placeholder="Password" value="<?php if(isset($_COOKIE["myPassword"])) { echo $_COOKIE["myPassword"]; } ?>" oninput="inputChange()" required><br>
                <!-- <i class="far fa-eye" id="togglePassword"></i><br> -->

                <div id="remember-me-section">
                    <input type="checkbox" id="remember-me" name="remember-me" >
                    <label for="remember-me" id="remember-me-text">Remember Me</label><br>
                </div>
                <p id="forgot-password"><a onclick="forgotPassword()">Forgot Your Password?</a></p><br>

                <div id="login-error">
                    <?php include "../../controller/authController/message.php"?>
                </div>

                <button id="login-button" type="submit" name="login">Log In</button>
                <p id="no-account">Don't have an account? <a onclick="getSignup()">Sign Up</a></p>
            </form>
        </div>

    </div>

    <div id="master-card">
        <div id="master-title">
            <img src="../../public/img/master-title.svg" alt="Title">
        </div>
        <br>
        <div id="master-image">
            <img src="../../public/img/master.svg" alt="Logo">
        </div>
        <br>
        <div id="about-us">
            <p>About Us</p>
            <img src="../../public/icons/dropdown.svg">
        </div>
    </div>

    <!-- Signup Section -->

    <div id="signup-card">
        <div id="signup-content">
            <h3>Create Your Account</h3>
            <form method="post" action="../../controller/authController/authentication/signup/signup.php" name="signup-form" id="signup-form">
                <div id="signup-first">
                    <input type="text" id="signup-first-name" name="signup-first-name" placeholder="First Name" oninput="inputChange()" required><br>
                    <input type="text" id="signup-last-name" name="signup-last-name" placeholder="Last Name" oninput="inputChange()" required><br>
                    <input type="text" placeholder="Date of Birth" name="signup-dob" onfocus="(this.type='date')" onblur="(this.type='text')" oninput="inputChange()" required>
                    <input type="text" id="signup-address-first" name="signup-address-first" placeholder="Address Line 1" oninput="inputChange()" required><br>
                    <input type="text" id="signup-address-second" name="signup-address-second" placeholder="Address Line 2" oninput="inputChange()" required>
                </div>
                <div id="signup-second">
                    <input type="text" id="signup-telephone" name="signup-telephone" placeholder="Telephone" oninput="inputChange()" required><br>
                    <input type="email" id="signup-email" name="signup-email" placeholder="Email address" oninput="inputChange()" required><br>
                    <input type="text" id="signup-username" class="to-verify" name="signup-username" placeholder="Username" oninput="inputChange()" required><br>
                    <input type="password" id="signup-password" class="to-verify" name="signup-password" placeholder="Password" oninput="inputChange()" required><br>
                    <input type="password" id="signup-password-retype" class="to-verify" name="signup-password-retype" placeholder="Re-enter Password" oninput="inputChange()" required><br>
                    <div id="signup-error">
                        <?php include "../../controller/authController/signupMessage.php"?>
                    </div>
                    <button id="signup-button" type="submit" >Sign Up</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Forgot Password Section-->

    <div id="forgot-pw-card">
        <div id="forgot-pw-form-container">
            <h3>Forgot Password?</h3><br>
            <p>Verify your email address below to recieve a link to reset your password.</p>
            <form method="post" action="" name="forgot-pw-form" id="forgot-pw-form">
                <div id="show-email"><p id="verifying-email">Email to be verified</p></div><br>
                <button id="verify-email-button" type="submit" onclick="resetPassword()">Verify</button>
            </form>
            <br>
            <a onclick="getLogin()"><p>Go Back</p></a>
        </div>
    </div>

    <div id="signup-success">
        <?php include_once('../common/popup.php"') ?>
    </div>

    <script src="../../public/js/index.js"></script>

    <?php
        if(isset($_SESSION['signup-error-message'])){
            echo"
                <style>
                        #signup-list-item{
                            border-left: 6px solid #f49f0a;
                        }
                        #login-list-item{
                            border-left: 6px solid white;
                        }
                        #signup-card{
                            visibility:visible;
                        }
                        #master-card{
                            visibility:hidden;
                        }
                        #forgot-pw-card{
                            visibility:hidden;
                        }
                </style>
            ";
            unset($_SESSION['signup-error-message']);
        }

    ?>

</body>
</html>