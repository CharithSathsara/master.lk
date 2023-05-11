<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Model Quiz Result</title>
    <link rel="stylesheet" href="../../../public/css/modelQuiz.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">



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
                <div class="result-box custom-box ">
                    <h2>Congratulations! You have completed the model quiz...</h2>
                    <h1>Quiz Result</h1>

                    <table>
                        <tr>
                            <td>Total Questions</td>
                            <td><span class="total-question">10</span></td>
                        </tr>
                        <tr>
                            <td>Attempt</td>
                            <td><span class="total-attempt">1</span></td>
                        </tr>
                        <tr>
                            <td>Total Correct</td>
                            <td><span class="total-correct">1</span></td>
                        </tr>
                        <tr>
                            <td>Total Wrong</td>
                            <td><span class="total-wrong">1</span></td>
                        </tr>
                        <tr>
                            <td>Percentage</td>
                            <td><span class="percentage">60.00%</span></td>
                        </tr>
                        <tr>
                            <td>Your Total Score</td>
                            <td><span class="total-score"><?php echo $_SESSION['modelQuizScore'];?>/10</span></td>
                        </tr>
                    </table>

                    <button type="button" class="quiz-btn">Try Again</button>
                    <button type="button" class="quiz-btn">Review Questions</button>
                    <button type="button" class="quiz-btn">Go to Dashboard</button>

                </div>



            </div>
        </div>
    </div>

    <?php 
    // Unset the session variable to destroy it
    // unset($_SESSION['modelQuizScore']); 
    ?>
</body>

</html>