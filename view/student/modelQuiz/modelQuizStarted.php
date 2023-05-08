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

$modelQuizController = new ModelQuizController();
    
// $_SESSION["quiz_time"] = 20;
// $quizDate = date("Y-m-d H:i:s");

// $_SESSION["quiz_end_time"] = date("Y-m-d H:i:s" , strtotime($quizDate."+$_SESSION[quiz_time] minutes"));
// $_SESSION["quiz_start"] = "yes";

?>
    <div class="content">
        <div class="container">
            <div class="quiz-box custom-box ">
                <p>Time remaining: <span id="countdown"></span></p>

                <script>
                var timeLimit = 1 * 60; // 20 minutes in seconds
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


                <?php
                
                $_SESSION['topicId'] = 2;
                $questions = $modelQuizController->getModelQuizQuestions($_SESSION['topicId']);
                
                if(isset($questions) && is_array($questions)) {
                    foreach ($questions as $question) {
                    $i = 1; ?>

                <div class="question-number">
                    Question <?php echo $i; $i++;?> of 10
                </div>

                <div class="question-text">
                    <?php echo "<p>Question: " . $question['question'] . "</p>";?>
                </div>

                <div class="option-container">
                    <div class="quiz-option"><?php echo "<p>1.) " . $question['opt01'] . "</p>"; ?></div>
                    <div class="quiz-option"><?php echo "<p>2.) " . $question['opt02'] . "</p>"; ?></div>
                    <div class="quiz-option"><?php echo "<p>3.) " . $question['opt03'] . "</p>"; ?></div>
                    <div class="quiz-option"><?php echo "<p>4.) " . $question['opt04'] . "</p>"; ?></div>
                    <div class="quiz-option"><?php echo "<p>5.) " . $question['opt05'] . "</p>"; ?></div>
                </div>
                <div class="next-question-btn">
                    <button type="button" id="next-quiz-btn" class="quiz-btn" onclick="next()">Next</button>
                </div>

            </div>
            <!-- echo "<p>Question ID: " . $question['questionId'] . "</p>"; -->






            <!-- echo "<p>Correct Answer: " . $question['correctAnswer'] . "</p>";
                        echo "<p>Question Type: " . $question['questionType'] . "</p>";
                        echo "<p>Topic ID: " . $question['topicId'] . "</p>";
                        echo "<hr>"; -->
            <?php }
                } else {
                    echo "No data available.";
                }
                
                ?>
            <div class="slider-indicator">

            </div>









        </div>
    </div>
    </div>

    <!-- <script>
    setInterval(function() {
        timer();
    }, 1000);

    function timer() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                if (xmlhttp.responseText == "00:00:01") {
                    window.location == "../../../view/student/modelQuiz/quizResult.php"
                }

                document.getElementById("countdown-timer").innerHTML = xmlhttp.responseText;
            }
        };

        xmlhttp.open("GET", "../../../view/student/modelQuiz/loadTimer.php", true);
        xmlhttp.send(null);

    }
    </script> -->



</body>

</html>