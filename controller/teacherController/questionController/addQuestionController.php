<?php

include('../../../config/app.php');
require_once('../../../model/Teacher.php');

if(isset($_POST['add-question'])){

    if (!empty($db_connection)) {

        $topicId = validateInput($db_connection->getConnection(), $_POST['topicId']);
        $type = validateInput($db_connection->getConnection(), $_POST['type']);
        $question = validateInput($db_connection->getConnection(), $_POST['question']);
        $answer1 = validateInput($db_connection->getConnection(), $_POST['answer1']);
        $answer2 = validateInput($db_connection->getConnection(), $_POST['answer2']);
        $answer3 = validateInput($db_connection->getConnection(), $_POST['answer3']);
        $answer4 = validateInput($db_connection->getConnection(), $_POST['answer4']);
        $answer5 = validateInput($db_connection->getConnection(), $_POST['answer5']);

        $correctAnswer = validateInput($db_connection->getConnection(), $_POST['correctAnswer']);
        $answerDescription = validateInput($db_connection->getConnection(), $_POST['description']);

        $data = Teacher::addQuestion($question, $answer1, $answer2, $answer3, $answer4, $answer5,
            $correctAnswer, $answerDescription, $type, $_SESSION['subject'], $topicId, $_SESSION['auth_user']['userId'], $db_connection->getConnection());

        unset($_POST["add-question"]);
        if($data){
            $_SESSION['question-upload-success']="Uploaded the question successfully!";
        }else{
            $_SESSION['question-upload-fail']="Question upload failed, please try again!";
        }
        redirect("","view/teacher/question/addQuestion.php");

    }

}

?>
