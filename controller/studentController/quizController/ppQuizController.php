<?php

include_once('../../../config/app.php');
include('../../../model/Quiz.php');

$topicId = 2;
$result = Quiz::getPpQuizQuestions($topicId, $db_connection->getConnection());

$_SESSION['topicId'] = 2;

if (!isset($_SESSION['ppQuizScore'])) {
    $_SESSION['ppQuizScore'] = 0;
}

if (!isset($_SESSION['ppQuizTotalCorrectAns'])) {
    $_SESSION['ppQuizTotalCorrectAns'] = 0;
}

if (!isset($_SESSION['ppQuizWrongCorrectAns'])) {
    $_SESSION['ppQuizTotalWrongAns'] = 0;
}

if (!isset($_SESSION['ppQuizPercentage'])) {
    $_SESSION['ppQuizPercentage'] = 0;
}



if (isset($_POST['submit'])) {

    if (isset($_POST['choice1'])) {
        $selectedChoice1 = $_POST['choice1'];
    } else {
        // Handle the case where 'choice1' is not set
        $selectedChoice1 = 0;
    }

    if (isset($_POST['choice2'])) {
        $selectedChoice2 = $_POST['choice2'];
    } else {
        // Handle the case where 'choice2' is not set
        $selectedChoice2 = 0;
    }


    if (isset($_POST['choice3'])) {
        $selectedChoice3 = $_POST['choice3'];
    } else {
        // Handle the case where 'choice3' is not set
        $selectedChoice3 = 0;
    }

    if (isset($_POST['choice4'])) {
        $selectedChoice4 = $_POST['choice4'];
    } else {
        // Handle the case where 'choice4' is not set
        $selectedChoice4 = 0;
    }

    if (isset($_POST['choice5'])) {
        $selectedChoice5 = $_POST['choice5'];
    } else {
        // Handle the case where 'choice5' is not set
        $selectedChoice5 = 0;
    }

    if (isset($_POST['choice6'])) {
        $selectedChoice6 = $_POST['choice6'];
    } else {
        // Handle the case where 'choice6' is not set
        $selectedChoice6 = 0;
    }

    if (isset($_POST['choice7'])) {
        $selectedChoice7 = $_POST['choice7'];
    } else {
        // Handle the case where 'choice7' is not set
        $selectedChoice7 = 0;
    }

    if (isset($_POST['choice8'])) {
        $selectedChoice8 = $_POST['choice8'];
    } else {
        // Handle the case where 'choice8' is not set
        $selectedChoice8 = 0;
    }

    if (isset($_POST['choice9'])) {
        $selectedChoice9 = $_POST['choice9'];
    } else {
        // Handle the case where 'choice9' is not set
        $selectedChoice9 = 0;
    }

    if (isset($_POST['choice10'])) {
        $selectedChoice10 = $_POST['choice10'];
    } else {
        // Handle the case where 'choice10' is not set
        $selectedChoice10 = 0;
    }







    // $selectedChoice1 = $_POST['choice1'];
    // $selectedChoice2 = $_POST['choice2'];
    // $selectedChoice3 = $_POST['choice3'];
    // $selectedChoice4 = $_POST['choice4'];
    // $selectedChoice5 = $_POST['choice5'];
    // $selectedChoice6 = $_POST['choice6'];
    // $selectedChoice7 = $_POST['choice7'];
    // $selectedChoice8 = $_POST['choice8'];
    // $selectedChoice9 = $_POST['choice9'];
    // $selectedChoice10 = $_POST['choice10'];

    $selectedChoice = array($selectedChoice1, $selectedChoice2, $selectedChoice3, $selectedChoice4, $selectedChoice5, $selectedChoice6, $selectedChoice7, $selectedChoice8, $selectedChoice9, $selectedChoice10);
    $_SESSION['selectedAnsArray'] = $selectedChoice;
    //check wheather array is empty



    // $ppQuizController = new ModelQuizController();
    // $questions = $ppQuizController->getModelQuizQuestions($_SESSION['topicId']);
    $rows = $_SESSION['pp_question_array'];



    //Get Correct Answer Array
    $correctChoice = array();

    foreach ($rows as $row) {
        $correctChoice[] = $row['correctAnswer'];
    }



    //Compare selected and correct choice
    // compare the arrays
    for ($i = 0; $i < count($selectedChoice); $i++) {
        if ($selectedChoice[$i] === $correctChoice[$i]) {
            $_SESSION['ppQuizScore'] += 1;
        } else {
            $_SESSION['ppQuizTotalWrongAns'] += 1;
        }
    }
    $_SESSION['ppQuizTotalCorrectAns'] = $_SESSION['ppQuizScore'];

    // if ($correctChoice == $selectedChoice) {

    // }

    //Check Wheather It Reached Last Question
    // if ($questionNumber == 3) {
    //     header("Location: ppQuizResult.php");
    //     exit();
    // } else {

    //Percentage Score of the student
    $_SESSION['ppQuizPercentage'] = ($_SESSION['ppQuizScore'] / 10) * 100;

    $studentId = $_SESSION['auth_user']['userId'];



    $selectedArray = $_SESSION['selectedAnsArray'];

    $ppQuizScore = $_SESSION['ppQuizPercentage'];
    $result = Quiz::setPpQuizDetails($topicId, $studentId, $ppQuizScore, $db_connection->getConnection());


    if ($result) {

        redirect("Model Quiz Completion Successful", "view/student/ppQuiz/ppQuizResult.php");
    } else {

        redirect("Model Quiz Completion Successful", "view/student/ppQuiz/ppQuiz.php");
    }
}