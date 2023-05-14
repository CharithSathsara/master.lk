<?php

include('../../../config/app.php');

require_once('../../../model/GamifiedQuestion.php');

if(isset($_POST['add-question'])){

    $topicId = validateInput($db_connection->getConnection(), $_POST['topicId']);
    $type = validateInput($db_connection->getConnection(), $_POST['type']);
    $question = validateInput($db_connection->getConnection(), $_POST['question']);
    $answer1 = validateInput($db_connection->getConnection(), $_POST['answer1']);
    $answer2 = validateInput($db_connection->getConnection(), $_POST['answer2']);
    $answer3 = validateInput($db_connection->getConnection(), $_POST['answer3']);
    $answer4 = validateInput($db_connection->getConnection(), $_POST['answer4']);
    $answer5 = validateInput($db_connection->getConnection(), $_POST['answer5']);

    $correctAnswer = validateInput($db_connection->getConnection(), $_POST['correctAnswer']);
   

    $data = GamifiedQuestion::addTheoryQuestion($question, $answer1, $answer2, $answer3, $answer4, $answer5,
        $correctAnswer, $answerDescription, $type, $_SESSION['subject'], $topicId, $_SESSION['auth_user']['userId'], $db_connection->getConnection());

        if ($data) {
            redirect("Something Went Wrong", "view/contentcreator/contentCreatorDashboard.php");
        } else {
            redirect("Something Went Wrong", "view/contentcreator/contentCreatorDashboard.php");
        }

}