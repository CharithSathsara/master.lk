<?php

include_once('../../../config/app.php');
include('../../../model/Quiz.php');


$_SESSION['current-topic'] = 2;
$topicId = $_SESSION['current-topic'];

$result = Quiz::getModelQuizQuestions($topicId, $db_connection->getConnection());



if (!isset($_SESSION['modelQuizScore'])) {
    $_SESSION['modelQuizScore'] = 0;
}

if (!isset($_SESSION['modelQuizTotalCorrectAns'])) {
    $_SESSION['modelQuizTotalCorrectAns'] = 0;
}

if (!isset($_SESSION['modelQuizWrongCorrectAns'])) {
    $_SESSION['modelQuizTotalWrongAns'] = 0;
}

if (!isset($_SESSION['modelQuizPercentage'])) {
    $_SESSION['modelQuizPercentage'] = 0;
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



    // $modelQuizController = new ModelQuizController();
    // $questions = $modelQuizController->getModelQuizQuestions($_SESSION['topicId']);
    $rows = $_SESSION['model_question_array'];



    //Get Correct Answer Array
    $correctChoice = array();

    foreach ($rows as $row) {
        $correctChoice[] = $row['correctAnswer'];
    }



    //Compare selected and correct choice
    // compare the arrays
    for ($i = 0; $i < count($selectedChoice); $i++) {
        if ($selectedChoice[$i] === $correctChoice[$i]) {
            $_SESSION['modelQuizScore'] += 1;
        } else {
            $_SESSION['modelQuizTotalWrongAns'] += 1;
        }
    }
    $_SESSION['modelQuizTotalCorrectAns'] = $_SESSION['modelQuizScore'];

    // if ($correctChoice == $selectedChoice) {

    // }

    //Check Wheather It Reached Last Question
    // if ($questionNumber == 3) {
    //     header("Location: modelQuizResult.php");
    //     exit();
    // } else {

    //Percentage Score of the student
    $_SESSION['modelQuizPercentage'] = ($_SESSION['modelQuizScore'] / 10) * 100;

    $studentId = $_SESSION['auth_user']['userId'];



    $selectedArray = $_SESSION['selectedAnsArray'];

    $modelQuizScore = $_SESSION['modelQuizPercentage'];
    $result = Quiz::setModelQuizDetails($topicId, $studentId, $modelQuizScore, $db_connection->getConnection());


    if ($result) {

        redirect("Model Quiz Completion Successful", "view/student/modelQuiz/modelQuizResult.php");
    } else {

        redirect("Model Quiz Completion Successful", "view/student/modelQuiz/modelQuiz.php");
    }
}
