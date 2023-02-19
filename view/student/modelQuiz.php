<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Model Quiz</title>
    <link rel="stylesheet" href="../../public/css/modelQuiz.css">
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
                <form class="welcome_form" name="welcome_form" onsubmit="submitForm(event)">
                    <button class="start-btn">Start</button>
                </form>
                <p class="quiz-instuctions"><b>Instructions: </b><br>Duration is 10 minutes.<br>
                    The quiz consists of 5 short questions, and you must answer all questions.<br>
                    Not All questions carry equal marks.<br>
                    Once you attempt a question and click on ‘next’, you cannot go back to the previous question(s).<br>
                </p>
                <script src="../../public/js/quizstart.js"></script>
                <div class="modelQuiz">



                </div>

                <div class="quiz-completion-level"></div>
            </div>



        </div>
    </div>



</body>

</html>