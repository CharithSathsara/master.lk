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


    $_SESSION['current-topic'] = $_GET['topic'];

    include_once '../../../view/common/header.php';
    @include '../../../view/common/navBar-Student.php';

    ?>
    <div class="content">
        <div class="container">

            <div class="modelQuiz-container">
                <b>
                    <p id="title">
                        <span id="subject-shortcut"><a
                                href="../studentDashboard.php"><?= $_SESSION['current-subject'] ?></a></span>&nbsp;&nbsp;>&nbsp;&nbsp;
                        <span id="lesson-shortcut"><a
                                href="../topicsAndFeedbacks.php?subject=<?= $_SESSION['current-subject'] ?>&lesson=<?= $_SESSION['current-lesson'] ?>"><?= $_SESSION['current-lesson'] ?></a></span>&nbsp;&nbsp;>&nbsp;&nbsp;
                        <span id="topic-shortcut"><a
                                href="../theoryContents.php?subject=<?= $_SESSION['current-subject'] ?>&lesson=<?= $_SESSION['current-lesson'] ?>&topic=<?= $_SESSION['current-topic'] ?>"><?= $_SESSION['current-topic'] ?></a></span>&nbsp;&nbsp;>&nbsp;&nbsp;
                        Model Quiz
                    </p>
                </b>
                <div class="title-modelQuiz"><b>Model Quiz</b>
                    <hr class="hr-line">
                </div>

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





                <script>
                // function hideStartQuizDiv() {
                //     var div = document.querySelector('.home-box'); // Get reference to the div element
                //     // div.classList.add('hide'); // Add the new class to the div
                //     div.style.display = "none";
                //     var div = document.querySelector('.quiz-box'); // Get reference to the div element
                //     // div.classList.remove('hide'); // Add the new class to the div
                //     div.style.display = "block";
                //     var div = document.querySelector('.model-quiz1'); // Get reference to the div element
                //     // div.classList.remove('hide'); // Add the new class
                //     div.style.display = "block";


                // }


                // Define the function that loads data from the database
                function loadModelQuizData() {
                    $.ajax({
                        url: '../../../controller/studentController/quizController/modelQuizController.php', // the URL of the server-side script that retrieves data from the database
                        type: 'GET',
                        // async: false,
                        success: function(data) {
                            window.location.href =
                                '../../../view/student/modelQuiz/modelQuizStarted.php';
                            // hideStartQuizDiv();
                            // alert("success");

                        },
                        error: function(xhr, status, error) {
                            // Handle any errors that occur
                            console.error(error);
                        }
                    });

                }

                // Attach the loadData function to a button click event
                // $('#start-quiz-btn').on('click', function() {
                //     loadModelQuizData();
                // });
                </script>




            </div>
        </div>
    </div>
</body>

</html>