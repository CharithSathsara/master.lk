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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#model-quiz-form').submit(function(event) {
            // Prevent the form from submitting normally
            event.preventDefault();

            // Get form data
            var formData = $(this).serialize();

            // Send the data using AJAX
            $.ajax({
                type: 'POST',
                url: '../../../view/student/modelQuiz/loadQuestions.php',
                data: formData,
                success: function(response) {
                    // $('#myForm')[0].reset(); // Reset the form
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                    console.log(error);
                }
            });
        });
    });
    </script>





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

// include_once '../../../view/common/header.php';
// @include '../../../view/common/navBar-Student.php';

//Set Question Number
$questionNumber = (int) $_GET['n'];
// Get the session array
$rows = $_SESSION['model_question_array'];

// if($questionNumber == 1){
$questions =  $rows[$questionNumber-1];
// }else{
// $questions =  $rows[$_SESSION['questionNo'] - 1];
// }


?>


    <div class="quiz-box custom-box">
        <div class="model-quiz">
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
                        window.location.href = "modelQuizResult.php";
                    }
                }, 1000);
                </script>
            </div>

            <div class="question-number current">
                Question <?php echo"$questionNumber";?> of 10
            </div>
            <div class="question-text">
                <p class="quiz-question"><?php echo $questions['question']; ?></p>
            </div>

            <form id="model-quiz-form" method="post">

                <ul class="option-container choices">

                    <li>
                        <div class="quiz-option"><input name="choice" value="1"
                                type="radio" /><?php echo $questions['opt01'];?></div>
                    </li>

                    <li>
                        <div class="quiz-option"><input name="choice" value="2"
                                type="radio" /><?php echo $questions['opt02'];?></div>
                    </li>
                    <li>
                        <div class="quiz-option"><input name="choice" value="3"
                                type="radio" /><?php echo $questions['opt03'];?></div>
                    </li>
                    <li>
                        <div class="quiz-option"><input name="choice" value="4"
                                type="radio" /><?php echo $questions['opt04'];?></div>
                    </li>
                    <li>
                        <div class="quiz-option"><input name="choice" value="5"
                                type="radio" /><?php echo $questions['opt05'];?></div>
                    </li>

                </ul>

                <div class="question-btn">
                    <input class="quiz-btn" id="next-quiz-btn" type="submit" value="Submit">

                </div>
                <input type="hidden" name="questionNumber" value="<?php echo "$questionNumber"; ?>" />

            </form>
        </div>



        <div class="slider-indicator">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- <script>
    $(document).ready(function() {
        $('#model-quiz-form').submit(function(event) {
            event.preventDefault(); // prevent form from submitting

            // Send an AJAX request to loadQuestions.php
            $.ajax({
                type: 'POST',
                url: '../../../view/student/modelQuiz/loadQuestions.php',
                data: $(this).serialize(),
                success: function(response) {
                    // Update the question and options on the page
                    $('.question-text').html(response.question);
                    $('.choices').html(response.options);

                    // Update the question number
                    $('.question-number').html('Question ' + response.questionNumber +
                        ' of 10');

                    // Update the slider indicator
                    $('.slider-indicator div').removeClass('active');
                    $('.slider-indicator div').eq(response.questionNumber - 1).addClass(
                        'active');
                },
                error: function() {
                    alert('An error occurred while loading the question.');
                }
            });
        });
    });
    </script> -->







</body>

</html>