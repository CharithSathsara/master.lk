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
    <!-- <script>
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
    </script> -->





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

    if (!isset($_SESSION['questionNo'])) {
        $_SESSION['questionNo'] = 1;
    }
    $questionNo = $_SESSION['questionNo'];
    $rows = $_SESSION['model_question_array'];


    $questions =  $rows[0];


    ?>

    <div class="content">
        <div class="container">
            <div class="modelQuiz-container">
                <div class="title-modelQuiz"><b>Model Quiz</b>
                    <hr class="hr-line">
                </div>

                <div class="quiz-box custom-box">
                    <?php

                    ?>

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
                    <!-- 1 div -->
                    <div class="model-quiz1">


                        <div class="question-number current">
                            Question 1 of 10
                        </div>

                        <div class="question-text">
                            <p class="quiz-question"><?php echo $questions['question']; ?></p>
                        </div>

                        <form id="model-quiz-form" method="post"
                            action="../../../controller/studentController/quizController/modelQuizController.php">

                            <ul class="option-container choices">

                                <li></li>
                                <div class="quiz-option"><input name="choice1" value="1"
                                        type="radio" /><?php echo $questions['opt01']; ?></div>
                                </li>

                                <li>
                                    <div class="quiz-option"><input name="choice1" value="2"
                                            type="radio" /><?php echo $questions['opt02']; ?></div>
                                </li>
                                <li>
                                    <div class="quiz-option"><input name="choice1" value="3"
                                            type="radio" /><?php echo $questions['opt03']; ?></div>
                                </li>
                                <li>
                                    <div class="quiz-option"><input name="choice1" value="4"
                                            type="radio" /><?php echo $questions['opt04']; ?></div>
                                </li>
                                <li>
                                    <div class="quiz-option"><input name="choice1" value="5"
                                            type="radio" /><?php echo $questions['opt05']; ?></div>
                                </li>

                            </ul>

                            <div class="question-btn">
                                <button type="button" class="quiz-btn" id="next-quiz-btn"
                                    onclick="showNextDiv2()">Next</button>

                            </div>
                            <input type="hidden" name="questionNumber" value="<?php echo $_SESSION['questionNo']; ?>" />


                    </div>

                    <!-- 2 Div -->

                    <?php
                    $questions =  $rows[1];
                    ?>


                    <div class="model-quiz2">

                        <div class="question-number current">
                            Question 2 of 10
                        </div>

                        <div class="question-text">
                            <p class="quiz-question"><?php echo $questions['question']; ?></p>
                        </div>

                        <!-- <form id="model-quiz-form" method="post"> -->

                        <ul class="option-container choices">

                            <li></li>
                            <div class="quiz-option"><input name="choice2" value="1"
                                    type="radio" /><?php echo $questions['opt01']; ?></div>
                            </li>

                            <li>
                                <div class="quiz-option"><input name="choice2" value="2"
                                        type="radio" /><?php echo $questions['opt02']; ?></div>
                            </li>
                            <li>
                                <div class="quiz-option"><input name="choice2" value="3"
                                        type="radio" /><?php echo $questions['opt03']; ?></div>
                            </li>
                            <li>
                                <div class="quiz-option"><input name="choice2" value="4"
                                        type="radio" /><?php echo $questions['opt04']; ?></div>
                            </li>
                            <li>
                                <div class="quiz-option"><input name="choice2" value="5"
                                        type="radio" /><?php echo $questions['opt05']; ?></div>
                            </li>

                        </ul>

                        <div class="question-btn">
                            <button type="button" class="quiz-btn" id="next-quiz-btn"
                                onclick="showNextDiv3()">Next</button>

                        </div>
                        <input type="hidden" name="questionNumber" value="<?php echo $_SESSION['questionNo']; ?>" />


                    </div>

                    <!-- 3 Div -->

                    <?php
                    $questions =  $rows[2];
                    ?>


                    <div class="model-quiz3">

                        <div class="question-number current">
                            Question 3 of 10
                        </div>

                        <div class="question-text">
                            <p class="quiz-question"><?php echo $questions['question']; ?></p>
                        </div>

                        <!-- <form id="model-quiz-form" method="post"> -->

                        <ul class="option-container choices">

                            <li>
                                <div class="quiz-option"><input name="choice3" value="1"
                                        type="radio" /><?php echo $questions['opt01']; ?></div>
                            </li>

                            <li>
                                <div class="quiz-option"><input name="choice3" value="2"
                                        type="radio" /><?php echo $questions['opt02']; ?></div>
                            </li>
                            <li>
                                <div class="quiz-option"><input name="choice3" value="3"
                                        type="radio" /><?php echo $questions['opt03']; ?></div>
                            </li>
                            <li>
                                <div class="quiz-option"><input name="choice3" value="4"
                                        type="radio" /><?php echo $questions['opt04']; ?></div>
                            </li>
                            <li>
                                <div class="quiz-option"><input name="choice3" value="5"
                                        type="radio" /><?php echo $questions['opt05']; ?></div>
                            </li>

                        </ul>

                        <div class="question-btn">
                            <button type="button" class="quiz-btn" id="next-quiz-btn"
                                onclick="showNextDiv4()">Next</button>

                        </div>
                        <input type="hidden" name="questionNumber" value="<?php echo $_SESSION['questionNo']; ?>" />


                    </div>

                    <!-- 4 Div -->

                    <?php
                    $questions =  $rows[3];
                    ?>


                    <div class="model-quiz4">

                        <div class="question-number current">
                            Question 4 of 10
                        </div>

                        <div class="question-text">
                            <p class="quiz-question"><?php echo $questions['question']; ?></p>
                        </div>

                        <!-- <form id="model-quiz-form" method="post"> -->

                        <ul class="option-container choices">

                            <li>
                                <div class="quiz-option"><input name="choice4" value="1"
                                        type="radio" /><?php echo $questions['opt01']; ?></div>
                            </li>

                            <li>
                                <div class="quiz-option"><input name="choice4" value="2"
                                        type="radio" /><?php echo $questions['opt02']; ?></div>
                            </li>
                            <li>
                                <div class="quiz-option"><input name="choice4" value="3"
                                        type="radio" /><?php echo $questions['opt03']; ?></div>
                            </li>
                            <li>
                                <div class="quiz-option"><input name="choice4" value="4"
                                        type="radio" /><?php echo $questions['opt04']; ?></div>
                            </li>
                            <li>
                                <div class="quiz-option"><input name="choice4" value="5"
                                        type="radio" /><?php echo $questions['opt05']; ?></div>
                            </li>

                        </ul>

                        <div class="question-btn">
                            <button type="button" class="quiz-btn" id="next-quiz-btn"
                                onclick="showNextDiv5()">Next</button>

                        </div>
                        <input type="hidden" name="questionNumber" value="<?php echo $_SESSION['questionNo']; ?>" />


                    </div>

                    <!-- 5 Div -->

                    <?php
                    $questions =  $rows[4];
                    ?>


                    <div class="model-quiz5">

                        <div class="question-number current">
                            Question 5 of 10
                        </div>

                        <div class="question-text">
                            <p class="quiz-question"><?php echo $questions['question']; ?></p>
                        </div>

                        <!-- <form id="model-quiz-form" method="post"> -->

                        <ul class="option-container choices">

                            <li>
                                <div class="quiz-option"><input name="choice5" value="1"
                                        type="radio" /><?php echo $questions['opt01']; ?></div>
                            </li>

                            <li>
                                <div class="quiz-option"><input name="choice5" value="2"
                                        type="radio" /><?php echo $questions['opt02']; ?></div>
                            </li>
                            <li>
                                <div class="quiz-option"><input name="choice5" value="3"
                                        type="radio" /><?php echo $questions['opt03']; ?></div>
                            </li>
                            <li>
                                <div class="quiz-option"><input name="choice5" value="4"
                                        type="radio" /><?php echo $questions['opt04']; ?></div>
                            </li>
                            <li>
                                <div class="quiz-option"><input name="choice5" value="5"
                                        type="radio" /><?php echo $questions['opt05']; ?></div>
                            </li>

                        </ul>

                        <div class="question-btn">
                            <button type="button" class="quiz-btn" id="next-quiz-btn"
                                onclick="showNextDiv6()">Next</button>

                        </div>
                        <input type="hidden" name="questionNumber" value="<?php echo $_SESSION['questionNo']; ?>" />


                    </div>

                    <!-- 6 Div -->

                    <?php
                    $questions =  $rows[5];
                    ?>


                    <div class="model-quiz6">

                        <div class="question-number current">
                            Question 6 of 10
                        </div>

                        <div class="question-text">
                            <p class="quiz-question"><?php echo $questions['question']; ?></p>
                        </div>

                        <!-- <form id="model-quiz-form" method="post"> -->

                        <ul class="option-container choices">

                            <li>
                                <div class="quiz-option"><input name="choice6" value="1"
                                        type="radio" /><?php echo $questions['opt01']; ?></div>
                            </li>

                            <li>
                                <div class="quiz-option"><input name="choice6" value="2"
                                        type="radio" /><?php echo $questions['opt02']; ?></div>
                            </li>
                            <li>
                                <div class="quiz-option"><input name="choice6" value="3"
                                        type="radio" /><?php echo $questions['opt03']; ?></div>
                            </li>
                            <li>
                                <div class="quiz-option"><input name="choice6" value="4"
                                        type="radio" /><?php echo $questions['opt04']; ?></div>
                            </li>
                            <li>
                                <div class="quiz-option"><input name="choice6" value="5"
                                        type="radio" /><?php echo $questions['opt05']; ?></div>
                            </li>

                        </ul>

                        <div class="question-btn">
                            <button type="button" class="quiz-btn" id="next-quiz-btn"
                                onclick="showNextDiv7()">Next</button>

                        </div>
                        <input type="hidden" name="questionNumber" value="<?php echo $_SESSION['questionNo']; ?>" />


                    </div>

                    <!-- 7 Div -->

                    <?php
                    $questions =  $rows[6];
                    ?>


                    <div class="model-quiz7">

                        <div class="question-number current">
                            Question 7 of 10
                        </div>

                        <div class="question-text">
                            <p class="quiz-question"><?php echo $questions['question']; ?></p>
                        </div>

                        <!-- <form id="model-quiz-form" method="post"> -->

                        <ul class="option-container choices">

                            <li>
                                <div class="quiz-option"><input name="choice7" value="1"
                                        type="radio" /><?php echo $questions['opt01']; ?></div>
                            </li>

                            <li>
                                <div class="quiz-option"><input name="choice7" value="2"
                                        type="radio" /><?php echo $questions['opt02']; ?></div>
                            </li>
                            <li>
                                <div class="quiz-option"><input name="choice7" value="3"
                                        type="radio" /><?php echo $questions['opt03']; ?></div>
                            </li>
                            <li>
                                <div class="quiz-option"><input name="choice7" value="4"
                                        type="radio" /><?php echo $questions['opt04']; ?></div>
                            </li>
                            <li>
                                <div class="quiz-option"><input name="choice7" value="5"
                                        type="radio" /><?php echo $questions['opt05']; ?></div>
                            </li>

                        </ul>

                        <div class="question-btn">
                            <button type="button" class="quiz-btn" id="next-quiz-btn"
                                onclick="showNextDiv8()">Next</button>

                        </div>
                        <input type="hidden" name="questionNumber" value="<?php echo $_SESSION['questionNo']; ?>" />


                    </div>

                    <!-- 8 Div -->

                    <?php
                    $questions =  $rows[7];
                    ?>


                    <div class="model-quiz8">

                        <div class="question-number current">
                            Question 8 of 10
                        </div>

                        <div class="question-text">
                            <p class="quiz-question"><?php echo $questions['question']; ?></p>
                        </div>

                        <!-- <form id="model-quiz-form" method="post"> -->

                        <ul class="option-container choices">

                            <li>
                                <div class="quiz-option"><input name="choice8" value="1"
                                        type="radio" /><?php echo $questions['opt01']; ?></div>
                            </li>

                            <li>
                                <div class="quiz-option"><input name="choice8" value="2"
                                        type="radio" /><?php echo $questions['opt02']; ?></div>
                            </li>
                            <li>
                                <div class="quiz-option"><input name="choice8" value="3"
                                        type="radio" /><?php echo $questions['opt03']; ?></div>
                            </li>
                            <li>
                                <div class="quiz-option"><input name="choice8" value="4"
                                        type="radio" /><?php echo $questions['opt04']; ?></div>
                            </li>
                            <li>
                                <div class="quiz-option"><input name="choice8" value="5"
                                        type="radio" /><?php echo $questions['opt05']; ?></div>
                            </li>

                        </ul>

                        <div class="question-btn">
                            <button type="button" class="quiz-btn" id="next-quiz-btn"
                                onclick="showNextDiv9()">Next</button>

                        </div>
                        <input type="hidden" name="questionNumber" value="<?php echo $_SESSION['questionNo']; ?>" />


                    </div>


                    <!-- 9 Div -->

                    <?php
                    $questions =  $rows[8];
                    ?>


                    <div class="model-quiz9">

                        <div class="question-number current">
                            Question 9 of 10
                        </div>

                        <div class="question-text">
                            <p class="quiz-question"><?php echo $questions['question']; ?></p>
                        </div>

                        <!-- <form id="model-quiz-form" method="post"> -->

                        <ul class="option-container choices">

                            <li>
                                <div class="quiz-option"><input name="choice9" value="1"
                                        type="radio" /><?php echo $questions['opt01']; ?></div>
                            </li>

                            <li>
                                <div class="quiz-option"><input name="choice9" value="2"
                                        type="radio" /><?php echo $questions['opt02']; ?></div>
                            </li>
                            <li>
                                <div class="quiz-option"><input name="choice9" value="3"
                                        type="radio" /><?php echo $questions['opt03']; ?></div>
                            </li>
                            <li>
                                <div class="quiz-option"><input name="choice9" value="4"
                                        type="radio" /><?php echo $questions['opt04']; ?></div>
                            </li>
                            <li>
                                <div class="quiz-option"><input name="choice9" value="5"
                                        type="radio" /><?php echo $questions['opt05']; ?></div>
                            </li>

                        </ul>

                        <div class="question-btn">
                            <button type="button" class="quiz-btn" id="next-quiz-btn"
                                onclick="showNextDiv10()">Next</button>

                        </div>
                        <input type="hidden" name="questionNumber" value="<?php echo $_SESSION['questionNo']; ?>" />


                    </div>


                    <!-- 10 Div -->

                    <?php
                    $questions =  $rows[9];
                    ?>


                    <div class="model-quiz10">

                        <div class="question-number current">
                            Question 10 of 10
                        </div>

                        <div class="question-text">
                            <p class="quiz-question"><?php echo $questions['question']; ?></p>
                        </div>

                        <!-- <form id="model-quiz-form" method="post"> -->

                        <ul class="option-container choices">

                            <li>
                                <div class="quiz-option"><input name="choice10" value="1"
                                        type="radio" /><?php echo $questions['opt01']; ?></div>
                            </li>

                            <li>
                                <div class="quiz-option"><input name="choice10" value="2"
                                        type="radio" /><?php echo $questions['opt02']; ?></div>
                            </li>
                            <li>
                                <div class="quiz-option"><input name="choice10" value="3"
                                        type="radio" /><?php echo $questions['opt03']; ?></div>
                            </li>
                            <li>
                                <div class="quiz-option"><input name="choice10" value="4"
                                        type="radio" /><?php echo $questions['opt04']; ?></div>
                            </li>
                            <li>
                                <div class="quiz-option"><input name="choice10" value="5"
                                        type="radio" /><?php echo $questions['opt05']; ?></div>
                            </li>

                        </ul>



                        <div class="question-btn">
                            <button class="quiz-btn" id="next-quiz-btn" name="submit" type="submit">Finish</button>

                        </div>
                        <input type="hidden" name="questionNumber" value="<?php echo $_SESSION['questionNo']; ?>" />

                        </form>


                    </div>











                    <div class="slider-indicator">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
    // function hideStartQuizDiv() {
    //                 // var div = document.querySelector('.home-box'); // Get reference to the div element
    //                 // // div.classList.add('hide'); // Add the new class to the div
    //                 // div.style.display = "none";
    //                 // var div = document.querySelector('.quiz-box'); // Get reference to the div element
    //                 // // div.classList.remove('hide'); // Add the new class to the div
    //                 // div.style.display = "block";
    //                 var div = document.querySelector('.model-quiz1'); // Get reference to the div element
    //                 // div.classList.remove('hide'); // Add the new class
    //                 div.style.display = "block";


    //             }


    function showNextDiv2() {
        var div = document.querySelector('.model-quiz1'); // Get reference to the div element
        div.style.display = "none"; // Add the new class
        var div = document.querySelector('.model-quiz2'); // Get reference to the div element
        div.style.display = "block";
    }

    function showNextDiv3() {
        var div = document.querySelector('.model-quiz2'); // Get reference to the div element
        div.style.display = "none"; // Add the new class
        var div = document.querySelector('.model-quiz3'); // Get reference to the div element
        div.style.display = "block";
    }

    function showNextDiv4() {
        var div = document.querySelector('.model-quiz3'); // Get reference to the div element
        div.style.display = "none"; // Add the new class
        var div = document.querySelector('.model-quiz4'); // Get reference to the div element
        div.style.display = "block";
    }

    function showNextDiv5() {
        var div = document.querySelector('.model-quiz4'); // Get reference to the div element
        div.style.display = "none"; // Add the new class
        var div = document.querySelector('.model-quiz5'); // Get reference to the div element
        div.style.display = "block";
    }

    function showNextDiv6() {
        var div = document.querySelector('.model-quiz5'); // Get reference to the div element
        div.style.display = "none"; // Add the new class
        var div = document.querySelector('.model-quiz6'); // Get reference to the div element
        div.style.display = "block";
    }

    function showNextDiv7() {
        var div = document.querySelector('.model-quiz6'); // Get reference to the div element
        div.style.display = "none"; // Add the new class
        var div = document.querySelector('.model-quiz7'); // Get reference to the div element
        div.style.display = "block";
    }

    function showNextDiv8() {
        var div = document.querySelector('.model-quiz7'); // Get reference to the div element
        div.style.display = "none"; // Add the new class
        var div = document.querySelector('.model-quiz8'); // Get reference to the div element
        div.style.display = "block";
    }

    function showNextDiv9() {
        var div = document.querySelector('.model-quiz8'); // Get reference to the div element
        div.style.display = "none"; // Add the new class
        var div = document.querySelector('.model-quiz9'); // Get reference to the div element
        div.style.display = "block";
    }

    function showNextDiv10() {
        var div = document.querySelector('.model-quiz9'); // Get reference to the div element
        div.style.display = "none"; // Add the new class
        var div = document.querySelector('.model-quiz10'); // Get reference to the div element
        div.style.display = "block";
    }

    // function finishModelQuiz() {
    //     $.ajax({
    //         url: '../../../view/student/modelQuiz/loadResult.php', // the URL of the server-side script that retrieves data from the database
    //         type: 'GET',
    //         // async: false,
    //         success: function(data) {


    //         },
    //         error: function(xhr, status, error) {
    //             // Handle any errors that occur
    //             console.error(error);
    //         }
    //     });


    // }
    </script>

</body>

</html>