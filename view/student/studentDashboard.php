<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../../public/css/studentDashboard.css?<?php echo time(); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
</head>
<body>

<?php

include_once('../../config/app.php');
include_once('../../controller/authController/authentication/Authentication.php');
include_once('../../controller/authController/authorization/Authorization.php');

//User Authentication
Authentication::userAuthentication();
//User Authorization
Authorization::authorizingStudent();

include_once('../common/navBar-Student.php');
include_once('../common/header.php');
include_once('../../controller/studentController/dashboardController/lessonController.php');
include_once('../../controller/studentController/dashboardController/studentSubjectController.php');
include_once('../../model/Student.php');
include_once('../../model/Lesson.php');

$lessonController = new lessonController();
$studentSubjectController = new studentSubjectController();

?>

<div id="student-dashboard-container">
    <div id="student-dashboard">

        <b><p id="title">Dashboard</p></b>
        <b><p class="sub-title">My Subjects&nbsp;&nbsp;&nbsp;</p></b>

        <div id="my-subjects-container">
        
            <div id='chemistry' class='subject-card'>
                    <b><p class='card-title'>Chemistry</p></b>
                    <!-- completion bar here -->
                    <div class='lesson-container'>
                        <?=$lessonController->getLessons("Chemistry");
                        // $_SESSION['lesson']=$row_data['lessonName'];
                        ?>
                    </div>
            </div>
        

            <div id='physics' class='subject-card'>
                    <b><p class='card-title'>Physics</p></b>
                    <!-- completion bar here --> 
                    <div class='lesson-container'>
                        <?=$lessonController->getLessons("Physics")?>
                    </div>
            </div>

            
        </div>

        <br><br> 
        <b><p class="sub-title">Progress&nbsp;&nbsp;&nbsp;</p></b>

        <div id="progress-container">
            <div class="progress-card" id="completion-card">
                <b><p class="progress-title">Completion</p></b>
                <img src="../../public/img/completion-graph.PNG" id="completion-img" class="progress-img">
            </div>
            <div class="progress-card" id="scores-card">
                <b><p class="progress-title">Scores</p></b>
                <img src="../../public/img/scores-graph.PNG" id="scores-img" class="progress-img">
            </div>
        </div>

        <br><br> 
        <b><p class="sub-title">Badges&nbsp;&nbsp;&nbsp;</p></b>

        <div id="badge-container">

        </div>

        <br><br> 
        <b><p class="sub-title">Recommendations&nbsp;&nbsp;&nbsp;</p></b>

        <div id="rec-container">

        </div>

    </div>
</div>

<?php
    
    if(!($studentSubjectController->hasBought("Chemistry"))){
        echo"
        <style>
        #chemistry{
            display:none;
        }
        </style>
        ";
    }
    if(!($studentSubjectController->hasBought("Physics"))){
        echo"
        <style>
        #physics{
            display:none;
        }
        </style>
        ";
    }

?>

<script src="../../public/js/studentDashboard.js"></script>


</body>
</html>
