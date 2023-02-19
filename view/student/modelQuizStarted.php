<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Model Quiz</title>
    <link rel="stylesheet" href="../../public/css/modelQuizStarted.css">
    <?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

</head>

<body>
    <?php

include_once('../../config/app.php');
include_once('../../controller/authController/authentication/Authentication.php');
include_once('../../controller/authController/authorization/Authorization.php');

//check user authenticated or not
//$authentication = new Authentication();
//$authentication->authorizingAdmin();

//User Authentication
Authentication::userAuthentication();
//User Authorization
Authorization::authorizingStudent();

include_once '../common/header.php';
@include '../common/navBar-Student.php';

?>
    <div class="content">
        <div class="container">
            <div class="modelQuiz-container">
                <div class="title-modelQuiz"><b>Model Quiz</b>
                    <hr class="hr-line">
                </div>


                <div class="wrapper">
                    <div class="quiz">
                        <div class="quiz_header">
                            <div class="quiz_timer">
                                <span class="time">00:00</span>
                            </div>
                        </div>
                        <div class="quiz_body">
                            <div id="questions">


                                <!-- <ul class="option_group">
              <li class="option">option 1</li>
              <li class="option">option 2</li>
              <li class="option">option 3</li>
              <li class="option">option 4</li>
            </ul> -->
                            </div>

                            <button class="btn-next" onclick="next()">Next Question</button>
                        </div>
                    </div>
                </div>

                <script src="../../public/js/QuizQuestion.js"></script>
                <script src="../../public/js/quizTimer.js"></script>
                <script src="../../public/js/quizUserInfo.js"></script>



</body>

</html>