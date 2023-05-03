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

    <script src="../../../public/js/modelQuizQuestion.js"></script>
    <script src="../../../public/js/modelQuiz.js"></script>

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

include_once '../../common/header.php';
@include '../../common/navBar-Student.php';

?>
    <div class="content">
        <div class="container">
            <div class="modelQuiz-container">
                <div class="title-modelQuiz"><b>Model Quiz</b>
                    <hr class="hr-line">
                </div>
                <div class="home-box custom-box">
                    <p class="quiz-instuctions"><b>Instructions: </b><br>Duration is 20 minutes.<br>
                        The quiz consists of 10 short questions, and you must answer all questions.<br>
                        Not All questions carry equal marks.<br>
                        Once you attempt a question and click on ‘next’, you cannot go back to the previous
                        question(s).<br>
                    </p>
                    <button type="button" id="start-quiz-btn" class="quiz-btn" onclick="startQuiz()">Start Quiz</button>
                </div>

                <div class="quiz-box custom-box hide">
                    <div class="question-number">
                        Question 1 of 5
                    </div>
                    <div class="question-text">
                        What is the first month?
                    </div>
                    <div class="option-container">
                        <div class="quiz-option"></div>
                        <div class="quiz-option"></div>
                        <div class="quiz-option"></div>
                        <div class="quiz-option"></div>
                        <div class="quiz-option"></div>
                    </div>
                    <div class="next-question-btn">
                        <button type="button" id="next-quiz-btn" class="quiz-btn" onclick="next()">Next</button>
                    </div>
                    <div class="slider-indicator">

                    </div>
                </div>
                <div class="result-box custom-box hide">
                    <h1>Model Quiz Result</h1>
                    <table>
                        <tr>
                            <td>Total Questions</td>
                            <td><span class="total-question"></span></td>
                        </tr>
                        <tr>
                            <td>Total Attempt</td>
                            <td><span class="total-attempt"></span></td>
                        </tr>
                        <tr>
                            <td>Correct Answers</td>
                            <td><span class="total-correct"></span></td>
                        </tr>
                        <tr>
                            <td>Wrong Answers</td>
                            <td><span class="total-wrong"></span></td>
                        </tr>
                        <tr>
                            <td>Percentage</td>
                            <td><span class="total-percentage"></span></td>
                        </tr>
                        <tr>
                            <td>Total Score</td>
                            <td><span class="total-score"></span></td>
                        </tr>

                    </table>
                    <button type="button" class="quiz-btn" onclick="tryAgainQuiz()">Try Again</button>
                    <br>
                    <button type="button" class="quiz-btn">Review Questions</button>
                    <br>
                    <button type="button" class="quiz-btn" onclick="goToDashboard()">Back to Dashboard</button>
                </div>

            </div>



        </div>
    </div>
    </div>





</body>

</html>