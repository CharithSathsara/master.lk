<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subject Contents</title>
    <link rel="stylesheet" href="../../public/css/theoryContents.css?<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
</head>

<body>

    <?php

    include_once('../../config/app.php');
    include_once('../../controller/authController/authentication/Authentication.php');
    include_once('../../controller/authController/authorization/Authorization.php');
    include_once('../common/navBar-Student.php');
    include_once('../common/header.php');

    //User Authentication
    Authentication::userAuthentication();
    //User Authorization
    Authorization::authorizingStudent();

    include('../../controller/studentController/contentController/theoryContentController.php');
    include('../../controller/studentController/contentController/gamifiedQuestionsController.php');
    include('../../model/Theory.php');
    include('../../model/GamifiedQuestion.php');

    $theoryContentController = new theoryContentController();
    $gamifiedQuestionsController = new gamifiedQuestionsController();

    $_SESSION['current-topic'] = $_GET['topic'];

    ?>

    <div id="subject-contents-container">
        <div id="subject-contents">
            <b>
                <p id="title"><span id="subject-shortcut"><a
                            href="studentDashboard.php"><?= $_SESSION['current-subject'] ?></a></span>&nbsp;&nbsp;>&nbsp;&nbsp;
                    <span id="lesson-shortcut"><a
                            href="topicsAndFeedbacks.php?subject=<?= $_SESSION['current-subject'] ?>&lesson=<?= $_SESSION['current-lesson'] ?>">
                            <?= $_SESSION['current-lesson'] ?></a></span>&nbsp;&nbsp;>&nbsp;&nbsp;<?= $_SESSION['current-topic'] ?>
                </p>
            </b>

            <br>
            <div class="scrollmenu">
                <div id="scrollmenu-contents">
                    <a href="./modelQuiz/modelQuiz.php?topic=<?= $_SESSION['current-topic'] ?>" class="list-item"
                        id="model-quiz-item">
                        <p>Model Quiz</p>
                    </a>
                    <a href="./ppQuiz/ppQuiz.php?topic=<?= $_SESSION['current-topic'] ?>" class="list-item"
                        id="pp-quiz-item">
                        <p>Past Paper Quiz</p>
                    </a>
                    <a href="reviewQuizzes.php?topic=<?= $_SESSION['current-topic'] ?>" class="list-item"
                        id="review-item">
                        <p>Review Quizzes</p>
                    </a>
                    <a href="Leaderboard.php?topic=<?= $_SESSION['current-topic'] ?>" class="list-item"
                        id="leaderboard-item">
                        <p>Leaderboard</p>
                    </a>
                </div>
            </div><br><br>

            <div id="thoery-container">
                <p class="sub-title">Theory&nbsp;&nbsp;</p><br>
                <div id="theory-sec">
                    <?= $theoryContentController->getTheoryContent($_SESSION['current-subject'], $_SESSION['current-lesson'], $_SESSION['current-topic']); ?>
                </div>
            </div>

            <div id="test-question-container">
                <b>
                    <p class="sub-title">Test Questions&nbsp;&nbsp;&nbsp;</p>
                </b><br>
                <?php
                $status = $gamifiedQuestionsController->getGamifiedQuestions($_SESSION['current-subject'], $_SESSION['current-lesson'], $_SESSION['current-topic']);
                if ($status) {
                    foreach ($status as $gamified_question) {
                        $question = $gamified_question['question'];
                        $opt01 = $gamified_question['opt01'];
                        $opt02 = $gamified_question['opt02'];
                        $opt03 = $gamified_question['opt03'];
                        $opt04 = $gamified_question['opt04'];
                        $opt05 = $gamified_question['opt05'];
                        $correctAnswer = $gamified_question['correctAnswer'];
                        $description = $gamified_question['description'];
                        $type = $gamified_question['type'];

                        // viewing options here
                    }
                } else {
                    echo "
                            <div class='no-content-sec'>
                                <img src='../../public/img/no-content.png' class='no-content-img'>
                                <p class='no-content-text'>No test questions to display!</p>
                            </div>
                        ";
                }
                ?>
            </div>
        </div>

    </div>

    </div>


</body>

</html>