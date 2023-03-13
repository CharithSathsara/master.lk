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
include_once('../../controller/studentController/dashboardController/subjectProgressController.php');
include_once('../../model/Student.php');
include_once('../../model/Lesson.php');

$lessonController = new lessonController();
$studentSubjectController = new studentSubjectController();
$subjectProgressController = new subjectProgressController();

?>

<div id="student-dashboard-container">
    <div id="student-dashboard">

        <b><p id="title">Dashboard</p></b>
        <b><p class="sub-title">My Subjects&nbsp;&nbsp;&nbsp;</p></b>

        <div id="my-subjects-container">
        
            <div id='chemistry' class='subject-card'>
                    <b><p class='card-title'>Chemistry</p></b>

                    <div class="progress-container">
                        <label id="progress-value-text"><?=$subjectProgressController->getSubjectProgress('Chemistry');?>%</label>
                        <progress id="progress-bar" value="<?=$subjectProgressController->getSubjectProgress('Chemistry');?>" max="100">
                            <div class="progress-value">
                                <span class="progress-perc"><?=$subjectProgressController->getSubjectProgress('Chemistry');?>%</span>
                            </div>
                        </progress>
                    </div>

                    <!-- <div class="progress-container">
                        <div class="progress-bar">
                            <div class="progress-value"><span><??>%</span></div>
                        </div>
                    </div> -->
                    

                    <div class='lesson-container'>
                        <?=$lessonController->getLessons("Chemistry");
                        // $_SESSION['lesson']=$row_data['lessonName'];
                        ?>
                    </div>
            </div>
        

            <div id='physics' class='subject-card'>
                    <b><p class='card-title'>Physics</p></b>

                    <div class="progress-container">
                        <label id="progress-value-text"><?=$subjectProgressController->getSubjectProgress('Physics');?>%</label>
                        <progress id="progress-bar" value="<?=$subjectProgressController->getSubjectProgress('Physics');?>" max="100">
                            <div class="progress-value">
                                <span class="progress-perc"><?=$subjectProgressController->getSubjectProgress('Physics');?>%</span>
                            </div>
                        </progress>
                    </div>
                    
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
                
                <div class="completion">
                    <div class="outer">
                        <div class="inner">
                            <div id="number">
                                65%
                            </div>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="160px" height="160px">
                        <defs>
                            <linearGradient id="GradientColor">
                                <stop offset="0%" stop-color="#e91e63" />
                                <stop offset="100%" stop-color="#673ab7" />
                            </linearGradient>
                        </defs>
                        <circle cx="70" cy="70" r="60" stroke-linecap="round" />
                    </svg>
                </div>

            </div>
            <div class="progress-card" id="scores-card">
                <b><p class="progress-title">Scores</p></b>
                
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
