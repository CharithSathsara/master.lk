<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../../public/css/studentDashboard.css?<?php echo time(); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
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

        <!-- My Subjects Section -->

        <b><p class="sub-title">My Subjects&nbsp;&nbsp;&nbsp;</p></b>

        <div id="my-subjects-container">
        
            <div id='chemistry' class='subject-card'>
                    <b><p class='card-title'>Chemistry</p></b>

                    <!-- Displays the progress of Chemistry Subject -->

                    <div class="progress-container">
                        <label id="progress-value-text"><?=$subjectProgressController->getSubjectProgress('Chemistry');?>%</label>
                        <progress id="progress-bar" value="<?=$subjectProgressController->getSubjectProgress('Chemistry');?>" max="100">
                            <div class="progress-value">
                                <span class="progress-perc"><?=$subjectProgressController->getSubjectProgress('Chemistry');?>%</span>
                            </div>
                        </progress>
                    </div>
                    
                    <!-- Gets the lessons of the Chemistry Subject from the database -->

                    <div class='lesson-container'>
                        <?=$lessonController->getLessons("Chemistry");?>
                        
                    </div>
            </div>
        

            <div id='physics' class='subject-card'>
                    <b><p class='card-title'>Physics</p></b>

                    <!-- Displays the progress of Physics Subject -->

                    <div class="progress-container">
                        <label id="progress-value-text"><?=$subjectProgressController->getSubjectProgress('Physics');?>%</label>
                        <progress id="progress-bar" value="<?=$subjectProgressController->getSubjectProgress('Physics');?>" max="100">
                            <div class="progress-value">
                                <span class="progress-perc"><?=$subjectProgressController->getSubjectProgress('Physics');?>%</span>
                            </div>
                        </progress>
                    </div>

                    <!-- Gets the lessons of the Physics Subject from the database -->
                    
                    <div class='lesson-container'>
                        <?=$lessonController->getLessons("Physics")?>
                    </div>
            </div>

            
        </div>

        <br><br> 

        <!-- Progress Section -->

        <b><p class="sub-title">Progress&nbsp;&nbsp;&nbsp;</p></b>

        <div id="progress-container">
           <div id="chem-sec" class="subject-progress-card">
                <p class="progress-card-title">Chemistry</p>
                <div id="inner-container">
                    <?=$lessonController->getLessonProgress("Chemistry")?>
                    <div id="lesson-names">
                        <?php
                        $rows = array();
                        $rows = $_SESSION['lesson_rows'];
                        foreach ($rows as $row) {
                        
                            echo "<p class='lesson-name-item'>" . $row['lessonName'] . "</p>";
                        
                        }?>
                    </div>
                    <div id="progress-values">
                        <?php
                        $values = array();
                        $values = $_SESSION['lesson_progress_values'];
                        foreach ($values as $row2) {
                        
                            echo "<p class='progress-value'>" . $row2 . "%</p>";
                            echo "<progress class ='lesson-progress-bars' value='".$row2."' max='100'></progress><br><br>";
                        
                        }?>
                    </div>  
                </div>
                   
           </div>
           <br>
           <div id="phy-sec" class="subject-progress-card">
                <p class="progress-card-title">Physics</p>
                <div id="inner-container">
                    <?=$lessonController->getLessonProgress("Physics")?>
                    <div id="lesson-names">
                        <?php
                        $rows = array();
                        $rows = $_SESSION['lesson_rows'];
                        foreach ($rows as $row) {
                        
                            echo "<p class='lesson-name-item'>" . $row['lessonName'] . "</p>";
                        
                        }?>
                    </div>
                    <div id="progress-values">
                        <?php
                        $values = array();
                        $values = $_SESSION['lesson_progress_values'];
                        foreach ($values as $row2) {
                        
                            echo "<p class='progress-value'>" . $row2 . "%</p>";
                            echo "<progress class ='lesson-progress-bars-phy' value='".$row2."' max='100'></progress><br><br>";
                        
                        }?>
                    </div>  
                </div>
                   
           </div>
        </div>

        <br><br> 

        <!-- Scores Section -->

        <b><p class="sub-title">Scores&nbsp;&nbsp;&nbsp;</p></b>

        <div id="scores-container">

    
        </div>
        <br><br>

        <!-- Badges Section -->

        <b><p class="sub-title">Badges&nbsp;&nbsp;&nbsp;</p></b>

        <div id="badge-container">

        </div>

        <br><br> 

        <!-- Recommendations Section -->

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
