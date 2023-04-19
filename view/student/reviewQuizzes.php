<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subject Contents</title>
    <link rel="stylesheet" href="../../public/css/reviewQuizzes.css?<?php echo time(); ?>">
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

$_SESSION['current-topic'] = $_GET['topic'];

?>

<div id="reviewQuizzes-container">
    <div id="reviewQuizzes-contents">
        <b><p id="title">
        <span id="subject-shortcut"><a href="studentDashboard.php"><?=$_SESSION['current-subject']?></a></span>&nbsp;&nbsp;>&nbsp;&nbsp;
        <span id="lesson-shortcut"><a href="topicsAndFeedbacks.php?subject=<?=$_SESSION['current-subject']?>&lesson=<?=$_SESSION['current-lesson']?>"><?=$_SESSION['current-lesson']?></a></span>&nbsp;&nbsp;>&nbsp;&nbsp;
        <span id="topic-shortcut"><a href="theoryContents.php?subject=<?=$_SESSION['current-subject']?>&lesson=<?=$_SESSION['current-lesson']?>&topic=<?=$_SESSION['current-topic']?>"><?=$_SESSION['current-topic']?></a></span>&nbsp;&nbsp;>&nbsp;&nbsp;
        Review Quizzes
        </p></b>

        <b><p class="sub-title">Model Papers&nbsp;&nbsp;&nbsp;</p></b>

        <div id="model-paper-review-container" class="review-container">
             
        </div>
        
        
    </div>

</div>


</body>
</html>
