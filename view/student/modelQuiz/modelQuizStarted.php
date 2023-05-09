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


</head>

<style>
.slider {
    display: flex;
    overflow: hidden;
    width: 100%;
}

.slide {
    flex-shrink: 0;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 3rem;
    opacity: 0;
    transition: opacity 1s ease-in-out;
}

/* Show only the active slide */
.slide.active {
    opacity: 1;
}
</style>

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


    

?>
    <div class="content">
        <div class="container">


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


            <?php 
                $_SESSION['topicId'] = 2;
                $questions = $modelQuizController->getModelQuizQuestions($_SESSION['topicId']);
                
                // Encode the quiz data array as JSON
                if($questions){
                $json_quiz_data = json_encode($questions);
                
            } else {
                echo "No questions found.";
            }

                ?>
            <script>
            const model_quiz = <?php echo $json_quiz_data; ?>;
            </script>

            <!-- <div class="slider">
                <
                <div class="slide">
                    <div class="question-number">
                        Question of 10
                    </div>
                    <div class="question-text" id="load_questions"></div>

                    <div class="option-container"></div>

                </div>

                <div class="question-btn">
                    <button class="next-btn" id="next-quiz-btn"></button>
                    <button type="button" id="next-btn" class="next quiz-btn">Next</button> -->






            <div class="slider-indicator">

            </div>

            <!-- <script>
            $(document).ready(function() {
                var currentSlide = 1;
                var totalSlides = $('.slider .slide').length;

                // Show the first slide
                $('.slider .slide:first-child').addClass('active');

                $('.next-btn').click(function() {
                    // Hide the current slide
                    $('.slider .slide.active').removeClass('active');

                    // Show the next slide
                    currentSlide++;
                    $('.slider .slide:nth-child(' + currentSlide + ')').addClass('active');

                    // Change the button text to "Finish" on the last slide
                    if (currentSlide === totalSlides) {
                        $('.next-btn').text('Finish');
                    }
                });
            });
            </script>


 -->





        </div>
    </div>

    <!-- <script>
    function load_total_questions() {

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("total_question").innerHTML = xmlhttp.responseText;

            }
        };

        xmlhttp.open("GET", "../../../view/student/modelQuiz/loadTotalQuestions.php", true);
        xmlhttp.send(null);

    }

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
                    load
                }

            }
        };

        xmlhttp.open("GET", "../../../view/student/modelQuiz/loadQuestions.php?questionNo=" + questionNo, true);
        xmlhttp.send(null);

    }

    function loadPrevious() {
        if (questionNo == "1") {
            load_questions(questionNo);
        } else {
            questionNo = eval(questionNo) - 1;
            load_questions(questionNo);
        }


    };


    function loadNext() {
        questionNo = eval(questionNo) + 1;
        load_questions(questionNo);

    }
    </script> -->



</body>

</html>