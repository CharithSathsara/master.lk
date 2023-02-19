<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link type="text/css" rel="stylesheet" href="../../public/css/styles.css">
    <title>Register Page</title>
</head>
<body style="background-color: lightblue;">

<?php

include_once('../../config/app.php');
include_once('../../controller/authController/authentication/login/LoginController.php');

LoginController::isLoggedIn();

?>

<div style="background-color: ; width: 50%; height:100vh; float:left; display: grid; justify-content: center;">
    <h1 id="welcome">Welcome to master.lk</h1>
    <img alt="logo" style="width: 40vw; height: 80vh" src="../../public/img/master_with_title.png">

</div>

<div style="background-color: ; width:50%; height:100vh; float:left;">

    <form id="register-form" action="../../controller/authController/authentication/register/register.php" method="post" >

        <h1 id="register-heading">Create Your Account</h1>
        <br>
        <p>Please Enter Your Details</p>
        <hr>
        <br>

        <?php include('../../controller/authController/message.php') ?>
        <br>

        <input type="text" placeholder="Enter First Name" name="firstname" style="width: 18vw" required>

        <input type="text" placeholder="Enter Last Name" name="lastname" style="width: 18vw" required>
        <br>

        <input type="text" name="dob" placeholder="Enter Your Birthdate" onfocus="(this.type='date')" onblur="(this.type='text')" style="width: 18vw" required>
        <br>

        <input type="text" placeholder="Enter Address Line 01" name="add01" style="width: 18vw" required>

        <input type="text" placeholder="Enter Address Line 02" name="add02" style="width: 18vw" required>
        <br>

        <input type="tel" placeholder="Mobile (Format : 0785218858)" name="mobile" pattern="07[0-9]{8}" style="width: 18vw" required>

        <input type="text" placeholder="Enter Email" name="email" style="width: 18vw" required>
        <br>

        <input type="text" placeholder="Enter User Name" name="username" style="width: 18vw" required>
        <br>

        <input type="password" placeholder="Enter Password" name="password" style="width: 18vw" required><br>
        <small style="color: #818181;font-weight: normal">Include at least 8 characters, one upper case, one lower case and one special character</small>
        <br>

        <input type="password" placeholder="Repeat Password" name="r_password" style="width: 18vw" required>
        <br>

        <input type="submit" value="Sign Up" style="width: 18vw" name="register">

    </form>

</div>

</body>
</html>
