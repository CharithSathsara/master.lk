<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./public/css/homePage.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <title>Home Page</title>
</head>
<body>

<?php

//include('./config/app.php');
// redirect("", "view/authentication/index.php");

?>

    <div id="main-card">

        <!-- Header Section -->

        <div id="header-div">
            <img src="./public/img/FullMasterLogo.svg" id="master-img">
            <div id="header-btn-sec">
                <div id="btns">
                    <button class="header-btns" id="home" onclick="getHome()">Home</button>
                    <button class="header-btns" id="about-courses" onclick="getCourses()">About Courses</button>
                    <a href="./view/authentication/index.php" class="header-btns" id="login-btn">Log In</a>
                </div>
            </div>
        </div>

        <!-- Body Section -->

        <div id="join-us-sec">
            <div id="join-us">
                <p id="join-us-text">Join Our Online Learning Community</p>
                <p id="join-us-text-sub">Experience an exciting and engaging learning journey with us!</p>
                <a href="./view/authentication/index.php" id="signup-btn">Join Now</a>
            </div>
            
        </div>
        <div id="img-sec">
            <img src="./public/img/home.svg" id="home-img">
        </div>


    </div>
    
    <!-- About Courses Section -->

    <div id="courses-div">
            
    </div>

    <script src="./public/js/homePage.js"></script>

</body>
</html>
