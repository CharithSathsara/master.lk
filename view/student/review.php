<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Review Quizzes</title>
    <link rel="stylesheet" href="../../public/css/review.css?<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
</head>

<body>

    <?php

    include_once('../../config/app.php');
    include_once('../../controller/authController/authentication/Authentication.php');
    include_once('../../controller/authController/authorization/Authorization.php');
    include_once('../../controller/studentController/quizController/quizReviewController.php');
    include_once('../../model/Quiz.php');
    include_once('../common/navBar-Student.php');
    include_once('../common/header.php');

    //User Authentication
    Authentication::userAuthentication();
    //User Authorization
    Authorization::authorizingStudent();

    $quizReviewController = new quizReviewController();
    $type = $_GET['type'];
    $attempt = $_GET['attempt'];

    ?>

    <div id="reviewQuizzes-container">
        <div id="reviewQuizzes-contents">
            <b>
                <p id="title">
                    <span id="subject-shortcut"><a
                            href="studentDashboard.php"><?= $_SESSION['current-subject'] ?></a></span>&nbsp;&nbsp;>&nbsp;&nbsp;
                    <span id="lesson-shortcut"><a
                            href="topicsAndFeedbacks.php?subject=<?= $_SESSION['current-subject'] ?>&lesson=<?= $_SESSION['current-lesson'] ?>"><?= $_SESSION['current-lesson'] ?></a></span>&nbsp;&nbsp;>&nbsp;&nbsp;
                    <span id="topic-shortcut"><a
                            href="theoryContents.php?subject=<?= $_SESSION['current-subject'] ?>&lesson=<?= $_SESSION['current-lesson'] ?>&topic=<?= $_SESSION['current-topic'] ?>"><?= $_SESSION['current-topic'] ?></a></span>&nbsp;&nbsp;>&nbsp;&nbsp;
                    <span>Review Quizzes</span>
                </p>
            </b>

            <a
                href="reviewQuizzes.php?subject=<?= $_SESSION['current-subject'] ?>&lesson=<?= $_SESSION['current-lesson'] ?>&topic=<?= $_SESSION['current-topic'] ?>"><img
                    src="../../public/icons/back.svg" id="back-btn" title="Back"></a>
            <b>
                <p class="sub-title">
                    <?php
                    if ($type == 'MODELPAPER') {
                        echo "Model Paper &nbsp;:&nbsp; Attempt &nbsp;" . $attempt;
                    }
                    if ($type == 'PASTPAPER') {
                        echo "Past Paper &nbsp;:&nbsp; Attempt &nbsp;" . $attempt;
                    }
                    ?>
                    &nbsp;&nbsp;&nbsp;</p>
            </b>

            <div id="quiz-review-container">

                <?php
                $status = $quizReviewController->getQuestions($_SESSION['current-lesson'], $_SESSION['current-topic'], $type, $attempt);

                if ($status) {
                    $qNum = 0;
                    foreach ($status as $question_row) {
                        $qNum++;
                        $question = $question_row['question'];
                        $opt01 = $question_row['opt01'];
                        $opt02 = $question_row['opt02'];
                        $opt03 = $question_row['opt03'];
                        $opt04 = $question_row['opt04'];
                        $opt05 = $question_row['opt05'];
                        $correctAnswer = $question_row['correctAnswer'];
                        $answerDescription = $question_row['answerDescription'];

                        echo "
                        <div class='review-card'>
                            <div class='question-div'>
                                <p class='questionNo'>(" . $qNum . ")</p>
                                <p class='question'>" . $question . "</p>
                            </div>
                            <ol>
                                <li class='question" . $qNum . "opt01'>1." . $opt01 . "</li>
                                <li class='question" . $qNum . "opt02'>2." . $opt02 . "</li>
                                <li class='question" . $qNum . "opt03'>3." . $opt03 . "</li>
                                <li class='question" . $qNum . "opt04'>4." . $opt04 . "</li>
                                <li class='question" . $qNum . "opt05'>5." . $opt05 . "</li>
                            </ol><br>
                            <div class='answer-div'>
                                <p class='correctAns'><span><b>Correct Answer :</b></span> <span class='correctAnsNo'>0" . $correctAnswer . "</span></p>
                                <p><span><b>Answer Description :</b></span><br>" . $answerDescription . "</p>
                            </div>
                        </div>
                        ";

                        $current_answer = $_SESSION['quiz_answers'][$qNum - 1];

                        if ($current_answer == $correctAnswer) {

                            echo "
                            <style>
                                .question" . $qNum . "opt0" . $current_answer . "{
                                        color : #48c024;
                                    }
                            </style>
                            ";
                        } else if ($current_answer == 0) {
                        } else {
                            echo "
                            <style>
                                .question" . $qNum . "opt0" . $current_answer . "{
                                        color : red;
                                    }
                            </style>
                            ";
                        }
                    }
                } else {
                    echo "<p>Something went wrong!</p>";
                }
                ?>

            </div>


        </div>

    </div>


</body>

</html>