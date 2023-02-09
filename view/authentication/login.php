<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link type="text/css" rel="stylesheet" href="../../public/css/styles.css">
    <title>Login Page</title>
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
    <form id="login-form" action="../../controller/authController/authentication/login/login.php" method="post">

        <h1 id="login-heading">Login to master.lk</h1>
        <br>
        <br>
        <p>Please Enter Your Credentials</p>
        <br>
        <br>
        <hr>
        <br>
        <?php include('../../controller/authController/message.php') ?>
        <br>

        <input name="username" type="text" value="<?php if(isset($_COOKIE["myUsername"])) { echo $_COOKIE["myUsername"]; } ?>" style="width: 25vw" placeholder="Enter Your UserName" required>
        <br>
        <br>

        <input type="password" value="<?php if(isset($_COOKIE["myPassword"])) { echo $_COOKIE["myPassword"]; } ?>" placeholder="Enter Your Password" name="password" style="width: 25vw" required>
        <br>
        <input type="checkbox" name="remember-me"/> Remember me
        <br>
        <br>

        <input type="submit" style="width: 25vw" value="Log In" name="login">

        <p id="to-register">Don't have an account? <a href="register.php"> Sign Up</a></p>

    </form>

</div>

</body>
</html>
