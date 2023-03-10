<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subject Contents</title>
    <link rel="stylesheet" href="../../public/css/theoryContents.css?<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
</head>
<body>

<?php

include_once('../../config/app.php');
include_once('../../controller/authController/authentication/Authentication.php');
include_once('../../controller/authController/authorization/Authorization.php');
include_once('../common/navBar-Student.php');
include_once('../common/header.php');

//User Authentication
Authentication::userAuthentication();
//User Authorization
Authorization::authorizingStudent();

include('../../controller/studentController/contentController/theoryContentController.php');
include('../../model/Theory.php');

$theoryContentController = new theoryContentController();

?>

<div id="subject-contents-container">
    <div id="subject-contents">
        <b><p id="title"><span id="subject-shortcut"><a href="studentDashboard.php">Chemistry</a></span>&nbsp;&nbsp;>&nbsp;&nbsp;
        <span id="lesson-shortcut"><a href="topicsAndFeedbacks.php">Organic Chemistry</a></span>&nbsp;&nbsp;>&nbsp;&nbsp;Basic Concepts</p></b>

        <br>
        <div class="scrollmenu">
            <div id="scrollmenu-contents">
                <a href="modelQuiz.php"  class="list-item" id="model-quiz-item">Model Quiz</a>
                <a href="modelQuiz.php"  class="list-item" id="pp-quiz-item">Past Paper Quiz</a>
                <a href="Leaderboard.php"  class="list-item" id="leaderboard-item">Leaderboard</a>
            </div>
        </div><br><br>
        
        <div id="thoery-container">
            <p class="sub-title">Theory&nbsp;&nbsp;</p><br>
            <div id="theory-sec"><?=$theoryContentController->getTheoryContent("Chemistry","Organic Chemistry","Basic Concepts"); ?></div>            
        </div>

        <div id="test-question-container">
            <b><p class="sub-title">Test Questions&nbsp;&nbsp;&nbsp;</p></b><br>
                
            </div>
        </div>
        
    </div>

</div>


</body>
</html>
