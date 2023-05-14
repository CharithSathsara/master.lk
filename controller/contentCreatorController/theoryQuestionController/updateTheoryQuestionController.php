<?php

include('../../../config/app.php');
require_once('../../../model/GamifiedQuestion.php');

if (isset($_POST['submit-update-question'])) {

    $questionId = validateInput($db_connection->getConnection(), $_POST['questionId']);
    $updateQuestion = validateInput($db_connection->getConnection(), $_POST['update-question']);
    $updateOption1 = validateInput($db_connection->getConnection(), $_POST['update-option1']);
    $updateOption2 = validateInput($db_connection->getConnection(), $_POST['update-option2']);
    $updateOption3 = validateInput($db_connection->getConnection(), $_POST['update-option3']);
    $updateOption4 = validateInput($db_connection->getConnection(), $_POST['update-option4']);
    $updateOption5 = validateInput($db_connection->getConnection(), $_POST['update-option5']);
    $correctAnswer = validateInput($db_connection->getConnection(), $_POST['correctAnswer']);


    // echo $updateQuestion;
    // echo $updateOption1;
    // echo $updateOption2;
    // echo $updateOption3;
    // echo $updateOption4;
    // echo $updateOption5;

    echo $questionId;

    $data = GamifiedQuestion::updateTheoryQuestion(
        $db_connection->getConnection(),
        $questionId,
        $updateQuestion,
        $updateOption1,
        $updateOption2,
        $updateOption3,
        $updateOption4,
        $updateOption5,
        $correctAnswer

    );

    if ($data) {
        redirect("Something Went Wrong", "view/contentcreator/contentCreatorDashboard.php");
    } else {
        redirect("Something Went Wrong", "view/contentcreator/contentCreatorDashboard.php");
    }
}