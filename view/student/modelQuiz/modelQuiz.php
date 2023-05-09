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
    <!-- <script src="../../../public/js/modelQuiz.js"></script> -->

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
                <div class="home-box custom-box hide">
                    <p class="quiz-instuctions"><b>Instructions: </b><br>Duration is 20 minutes.<br>
                        The quiz consists of 10 short questions, and you must answer all questions.<br>
                        Not All questions carry equal marks.<br>
                        Once you attempt a question and click on ‘next’, you cannot go back to the previous
                        question(s).<br>
                    </p>
                    <button type="button" id="start-quiz-btn" class="quiz-btn">Start Quiz</button>
                </div>

                <div class="quiz-box custom-box">
                    <div class="countdown">
                        <p class="timer">Time remaining: <span id="countdown"></span></p>

                        <script>
                        var timeLimit = 20 * 60; // 20 minutes in seconds
                        var timer = setInterval(function() {
                            var minutes = Math.floor(timeLimit / 60);
                            var seconds = timeLimit % 60;
                            document.getElementById("countdown").innerHTML = minutes + ":" + seconds;
                            timeLimit--;
                            if (timeLimit < 0) {
                                clearInterval(timer);
                                window.location.href = "quizResult.php";
                            }
                        }, 1000);
                        </script>
                    </div>
                    <div class="question-number">
                        Question 1 of 3
                    </div>
                    <div class="question-text">The quiz consists of 10 short questions</div>

                    <div class="option-container">
                        <div class="quiz-option">aaa</div>
                        <div class="quiz-option">aaa</div>
                        <div class="quiz-option">aaa</div>
                        <div class="quiz-option">aaa</div>
                        <div class="quiz-option">aaa</div>
                    </div>
                    <div class="question-btn">
                        <button class="quiz-btn" id="next-quiz-btn">Next</button>
                    </div>
                    <div class="slider-indicator">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>

                <div class="result-box custom-box hide">
                    <h1>Quiz Result</h1>

                    <table>
                        <tr>
                            <td>Total Questions</td>
                            <td><span class="total-question">1</span></td>
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
                            <td><span class="total-score">6/10</span></td>
                        </tr>
                    </table>

                    <button type="button" class="quiz-btn">Try Again</button>
                    <button type="button" class="quiz-btn">Review Questions</button>
                    <button type="button" class="quiz-btn">Go to Dashboard</button>

                </div>

            </div>
        </div>
    </div>
</body>

</html>