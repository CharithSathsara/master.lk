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

include('./config/app.php');
include('./controller/studentController/newSubjectsController/subjectController.php');
include('./controller/adminController/systemInformationController/systemInformationController.php');
include('./model/Subject.php');
include('./model/instituteDetails.php');

$subjectController = new subjectController();
$systemInformationController = new systemInformationController();

?>

    <div id="main-card">

        <!-- Header Section -->

        <div id="header-div">
            <img src="./public/img/FullMasterLogo.svg" id="master-img">
            <div id="header-btn-sec">
                <div id="btns">
                    <button class="header-btns" id="home" onclick="getHome()">Home</button>
                    <button class="header-btns" id="about-courses" onclick="getCourses()">About Us</button>
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
        <div id="courses-sec">
            <p id='subtitle'>Our Courses</p><br>
            <p id='medium'>Sinhala Medium</p>
            <div id='subjects-sec'>
                <div class="subject-description" id="physics">
                    <p class='sub-title'><b>Physics</b></p>
                    <p class='sub-text'><?= $subjectController->getSubjectDescription("Physics") ; ?></p>
                </div>
                <div class="subject-description" id="chemistry">
                    <p class='sub-title'><b>Chemistry</b></p>
                    <p class='sub-text'><?= $subjectController->getSubjectDescription("Chemistry") ; ?></p>
                </div>
            </div>
            <hr>
        </div>
        
        <div id="institute-sec">
            <p><b>Contact Us&nbsp;
            <?php
                $result = $systemInformationController->getAllDetailsInstitute();
                foreach ($result as $institute){
                    echo "
                    -&nbsp;&nbsp;".$institute['instituteName']."</b></p>
                    <div id='info-container'>
                    <div id='email' class='contact-box'>
                        <img src='./public/icons/mail.svg' class='contact-icon'>
                        <div class='contact-text'>
                            <p class='contact-title'>EMAIL</p>
                            <p class='info'>".$institute['email']."</p>
                        </div>
                    </div>
                    <div id='telephone' class='contact-box'>
                        <img src='./public/icons/phone.svg' class='contact-icon'>
                        <div class='contact-text'>
                            <p class='contact-title'>TELEPHONE</p>
                            <p class='info'>".$institute['number']."</p>
                        </div>
                    </div>";
                    if($institute['fax'] != null){
                        echo "
                            <div id='fax' class='contact-box'>
                                <img src='./public/icons/fax.svg' class='contact-icon'>
                                <div class='contact-text'>
                                    <p class='contact-title'>FAX</p>
                                    <p class='info'>".$institute['fax']."</p>
                                </div>
                            </div>
                        
                        ";
                    }
                    if($institute['address01'] != null && $institute['address02'] != null){
                        echo "
                            <div id='location' class='contact-box'>
                                <img src='./public/icons/location.svg' class='contact-icon' id='location-icon'>
                                <div class='contact-text'>
                                    <p class='contact-title'>LOCATION</p>
                                    <p class='info'>".$institute['address01']."</p>
                                    <p class='info'>".$institute['address02']."</p>
                                </div>
                            </div>
                        </div>
                        ";
                    }   
                    
                }
                
            ?>
            
        </div>
    </div>

    <script src="./public/js/homePage.js"></script>

</body>
</html>
