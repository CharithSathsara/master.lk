<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Topics</title>
    <link rel="stylesheet" href="../../public/css/topicsAndFeedbacks.css?<?php echo time(); ?>">
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

include('../../controller/studentController/topicsController/topicController.php');
include('../../model/Topic.php');

$topicController = new topicController();

$_SESSION['current-subject'] = $_GET['subject'];
$_SESSION['current-lesson'] = $_GET['lesson'];

?>

<div id="lessons-feedbacks-container">
    <div id="lessons-feedbacks">
        <b><p id="title"><span id="subject-shortcut"><a href="studentDashboard.php"><?=$_SESSION['current-subject']?></a></span>&nbsp;&nbsp;>&nbsp;&nbsp;<?=$_SESSION['current-lesson'];?></p></b>
        <b><p class="sub-title">Topics&nbsp;&nbsp;&nbsp;</p></b>

        <div class='topics-container'>
            <?=$topicController->getTopics($_SESSION['current-subject'],$_SESSION['current-lesson']);?>
        </div>
        <br>

        <b><p class="sub-title">Feedbacks&nbsp;&nbsp;&nbsp;</p></b>

        <div id="feedbacks-container">
            <form method="post" action="../../controller/teacherController/feedbackController/insertFeedbackController.php" name="feedback-form" id="feedback-form">
                <textarea id="feedback" name="feedback" placeholder="Write Your Feedback here" required></textarea>
                <input type="text" id="lesson" name="lesson" value=<?php echo $_GET["lesson"] ?> hidden>
                <input type="text" id="subject" name="subject" value=<?php echo $_GET["subject"] ?> hidden>
                <button type="submit" id="feedback-submit" name="feedback-submit">Submit</button>
            </form>
        </div>
        
    </div>

</div>

<div class="page-mask" id="page-mask-upload-feedback-success">

    <div id="upload-success-popup">
        <img id="success-icon" src="../../public/icons/success-yellow.svg">
        <b><p id="upload-title">Feedback Inserted Successfully!</p></b>
        <button onclick="closeUploadSuccessPopup()" class="close-button">
            <img src="../../public/icons/close.svg" class="close-icon">
        </button>
        <p id="upload-success-text">Your feedback has been successfully uploaded.</p>
        <button id="ok-btn" onclick="closeUploadSuccessPopup()">OK</button>
    </div>

</div>

<div class="page-mask" id="page-mask-upload-feedback-fail">

    <div id="upload-success-popup">
        <img id="success-icon" src="../../public/icons/delete-alert.png">
        <b><p id="upload-title">Feedback Inserting failed!</p></b>
        <button onclick="closeUploadFailPopup()" class="close-button">
            <img src="../../public/icons/close.svg" class="close-icon">
        </button>
        <div id="feedback-upload-error">
            <p><?= $_SESSION['feedback-insert-fail']; ?></p>
        </div>
        <button id="ok-btn" onclick="closeUploadFailPopup()">OK</button>
    </div>

</div>

<script src="../../public/js/topicsAndFeedbacks.js"></script>

<?php

if(isset($_SESSION['feedback-insert-success'])){
    echo"
                <style>
                        #page-mask-upload-feedback-success {
                            display:block;
                        }
                </style>
            ";
    unset($_SESSION['feedback-insert-success']);
}

if(isset($_SESSION['feedback-insert-fail'])){
    echo"
                <style>
                        #page-mask-upload-feedback-fail {
                            display:block;
                        }
                </style>
            ";
    unset($_SESSION['feedback-insert-fail']);
}

?>


</body>
</html>
