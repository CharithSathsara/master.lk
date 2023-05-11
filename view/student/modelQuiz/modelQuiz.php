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
                <script>
                $(document).ready(function() {

                    var currentIndex = 0; // Global variable to keep track of current index
                    var divs = document.querySelectorAll('#model-quiz'); // Get all the divs with class 'myDiv'

                    function showNextDiv() {
                        divs[currentIndex].style.display = 'none'; // Hide the current div
                        currentIndex++; // Increment the current index
                        if (currentIndex >= divs.length) {
                            currentIndex = 0; // If we've reached the end, loop back to the beginning
                        }
                        divs[currentIndex].style.display = 'block'; // Show the next div
                    }

                    document.querySelector('next-quiz-btn').addEventListener('click', showNextDiv);


                    function hideStartQuizDiv() {
                        var div = document.getElementById('home-box'); // Get reference to the div element
                        div.classList.add('hide'); // Add the new class to the div

                    }

                    function showModelQuizDiv() {
                        var div = document.getElementById('quiz-box'); // Get reference to the div element
                        div.classList.remove('hide'); // Add the new class to the div
                        showNextDiv();

                    }


                    // Define the function that loads data from the database
                    function loadModelQuizData() {
                        $.ajax({
                            url: '../../../controller/studentController/quizController/modelQuizController.php', // the URL of the server-side script that retrieves data from the database
                            type: 'GET',
                            success: function(data) {
                                // window.location.href =
                                //     '../../../view/student/modelQuiz/modelQuizStarted.php?n=1';
                                hideStartQuizDiv();
                                showModelQuizDiv();
                            },
                            error: function(xhr, status, error) {
                                // Handle any errors that occur
                                console.error(error);
                            }
                        });
                    }

                    // Attach the loadData function to a button click event
                    $('#start-quiz-btn').on('click', function() {
                        loadModelQuizData();
                    });
                });
                </script>

                <div class="home-box custom-box  ">
                    <p class="quiz-instuctions"><b>Instructions: </b><br>Duration is 20 minutes.<br>
                        The quiz consists of 10 short questions, and you must answer all questions.<br>
                        Not All questions carry equal marks.<br>
                        Once you attempt a question and click on ‘next’, you cannot go back to the previous
                        question(s).<br>
                    </p>
                    <button type="button" id="start-quiz-btn" class="quiz-btn" onclick="loadModelQuizData()">Start
                        Quiz</button>
                </div>


                <div class="quiz-box custom-box hide">
                    <?php
                    if(!isset($_SESSION['questionNo'])){
                        $_SESSION['questionNo'] = 1;
                        }
                    
                    $rows = $_SESSION['model_question_array'];
                    $questions =  $rows[$_SESSION['questionNo'] - 1];
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
                    <div id="model-quiz">
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
                                <button class="quiz-btn" id="next-quiz-btn">Next</button>

                            </div>
                            <input type="hidden" name="questionNumber" value="<?php echo "$questionNumber"; ?>" />

                        </form>
                    </div>

                    <!-- Second Div -->
                    <div id="model-quiz">
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
                                <button class="quiz-btn" id="next-quiz-btn">Next</button>

                            </div>
                            <input type="hidden" name="questionNumber" value="<?php echo "$questionNumber"; ?>" />

                        </form>
                    </div>

                    <!-- Third Div -->

                    <div id="model-quiz">
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
                                <button class="quiz-btn" id="next-quiz-btn">Next</button>

                            </div>
                            <input type="hidden" name="questionNumber" value="<?php echo "$questionNumber"; ?>" />

                        </form>
                    </div>

                    <!-- Forth Div -->

                    <div id="model-quiz">
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
                                <button class="quiz-btn" id="next-quiz-btn">Next</button>

                            </div>
                            <input type="hidden" name="questionNumber" value="<?php echo "$questionNumber"; ?>" />

                        </form>
                    </div>

                    <!-- Fifth Div -->

                    <div id="model-quiz">
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
                                <button class="quiz-btn" id="next-quiz-btn">Next</button>

                            </div>
                            <input type="hidden" name="questionNumber" value="<?php echo "$questionNumber"; ?>" />

                        </form>
                    </div>

                    <!-- Sixth Div -->

                    <div id="model-quiz">
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
                                <button class="quiz-btn" id="next-quiz-btn">Next</button>

                            </div>
                            <input type="hidden" name="questionNumber" value="<?php echo "$questionNumber"; ?>" />

                        </form>
                    </div>

                    <!-- Seventh Div -->

                    <div id="model-quiz">
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
                                <button class="quiz-btn" id="next-quiz-btn">Next</button>

                            </div>
                            <input type="hidden" name="questionNumber" value="<?php echo "$questionNumber"; ?>" />

                        </form>
                    </div>

                    <!-- Eighth Div -->

                    <div id="model-quiz">
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
                                <button class="quiz-btn" id="next-quiz-btn">Next</button>

                            </div>
                            <input type="hidden" name="questionNumber" value="<?php echo "$questionNumber"; ?>" />

                        </form>
                    </div>

                    <!-- Nineth Div -->

                    <div id="model-quiz">
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
                                <button class="quiz-btn" id="next-quiz-btn">Next</button>

                            </div>
                            <input type="hidden" name="questionNumber" value="<?php echo "$questionNumber"; ?>" />

                        </form>
                    </div>

                    <!-- Tenth Div -->

                    <div id="model-quiz">
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
                                <button class="quiz-btn" id="next-quiz-btn">Finish</button>

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






            </div>
        </div>
    </div>
</body>

</html>