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

$modelQuizController = new ModelQuizController();
    
// $_SESSION["quiz_time"] = 20;
// $quizDate = date("Y-m-d H:i:s");

// $_SESSION["quiz_end_time"] = date("Y-m-d H:i:s" , strtotime($quizDate."+$_SESSION[quiz_time] minutes"));
// $_SESSION["quiz_start"] = "yes";

?>
    <div class="content">
        <div class="container">

            <div class="home-box custom-box">
                <p class="quiz-instuctions"><b>Instructions: </b><br>Duration is 20 minutes.<br>
                    The quiz consists of 10 short questions, and you must answer all questions.<br>
                    Not All questions carry equal marks.<br>
                    Once you attempt a question and click on ‘next’, you cannot go back to the previous
                    question(s).<br>
                </p>
                <a href="../../../view/student/modelQuiz/modelQuizStarted.php"><button type="button" id="start-quiz-btn"
                        onclick="startQuiz()" class="quiz-btn">Start Quiz</button></a>
            </div>


            <div class="quiz-box custom-box ">
                <p>Time remaining: <span id="countdown"></span></p>

                <script>
                var timeLimit = 5 * 60; // 20 minutes in seconds
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




                <!-- // $_SESSION['topicId'] = 2;
                // $questions = $modelQuizController->getModelQuizQuestions($_SESSION['topicId']);
                // encode the PHP array as a JSON string -->



                <div class="question-number">
                    Question <p class="current-question">0</p> of 10
                </div>

                <div class="question-text" id="load_questions">


                </div>

                <div class="option-container"> -->

                    <div class="question-btn">
                        <input type="button" id="next-quiz-btn" class="next quiz-btn" onclick="loadNext()">Next</button>
                        <input type="button" id="previous-quiz-btn" class="previous quiz-btn"
                            onclick="loadPrevious()">Previous</button>
                    </div>

                </div>
                <!-- echo "<p>Question ID: " . $question['questionId'] . "</p>"; -->






                <!-- echo "<p>Correct Answer: " . $question['correctAnswer'] . "</p>";
                        echo "<p>Question Type: " . $question['questionType'] . "</p>";
                        echo "<p>Topic ID: " . $question['topicId'] . "</p>";
                        echo "<hr>"; -->

                <div class="slider-indicator">

                </div>









            </div>
        </div>
    </div>

    <script>
    var questionNo = "1";
    load_questions(questionNo);

    function load_questions() {
        document.getElementById("current_question").innerHTML = questionNo;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                if (xmlhttp.responseText == "over") {
                    window.location = "quizResult.php";
                } else {
                    document.getElementById("load_questions").innerHTML = xmlhttp.responseText;
                }

            }
        };

        xmlhttp.open("GET", "../../../view/student/modelQuiz/loadQuestions.php?questionNo=" + questionNo, true);
        xmlhttp.send(null);

    }
    </script>



</body>

</html>