<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Model Quiz</title>
    <link rel="stylesheet" href="../../../public/css/modelQuiz.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <!-- <script src="../../../public/js/modelQuizQuestion.js"></script>
    <script src="../../../public/js/modelQuiz.js"></script> -->

</head>

<body>
    <?php

include('../../../controller/studentController/quizController/modelQuizController.php');
include_once('../../../controller/authController/authentication/Authentication.php');
include_once('../../../controller/authController/authorization/Authorization.php');



//check user authenticated or not
//$authentication = new Authentication();
//$authentication->authorizingAdmin();

//User Authentication
Authentication::userAuthentication();
//User Authorization
Authorization::authorizingStudent();



include_once '../../../view/common/header.php';
@include '../../../view/common/navBar-Student.php';

?>
    <div class="content">
        <div class="container">
            <div class="modelQuiz-container">
                <div class="title-modelQuiz"><b>Model Quiz</b>
                    <hr class="hr-line">
                </div>
                





            </div>
        </div>
    </div>





</body>

</html>