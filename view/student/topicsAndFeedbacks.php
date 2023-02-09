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


?>

<div id="lessons-feedbacks-container">
    <div id="lessons-feedbacks">
        <b><p id="title"><span id="subject-shortcut"><a href="studentDashboard.php">Chemistry</a></span>&nbsp;&nbsp;>&nbsp;&nbsp;Organic Chemistry</p></b>
        <b><p class="sub-title">Topics&nbsp;&nbsp;&nbsp;</p></b>

        <div class='topics-container'>
            <?=$topicController->getTopics("Chemistry","Organic Chemistry");?>
        </div>
        <br>

        <b><p class="sub-title">Feedbacks&nbsp;&nbsp;&nbsp;</p></b>

        <div id="feedbacks-container">
            <form method="post" action="" name="feedback-form" id="feedback-form">
                <input type="text" id="feedback" name="feedback" placeholder="Write Your Feedback here" required>
                <button type="submit" id="feedback-submit">Submit</button>
            </form>
        </div>
        
    </div>

</div>


</body>
</html>
