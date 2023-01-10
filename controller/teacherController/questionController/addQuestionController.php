<?php

include('../../../config/app.php');
require_once('AddQuestionController.php');
require_once('../../../model/Teacher.php');

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
    $answerDescription = validateInput($db_connection->getConnection(), $_POST['description']);

    //Method One
    //$addQuestionController = new AddQuestionController();
    //$data = $addQuestionController->addQuestion($subject, $topic, $type, $question, $answer1, $answer2, $answer3, $answer4, $answer5,
                                        //$correctAnswer, $answerDescription);

    //Method Two
    $data = Teacher::addQuestion($question, $answer1, $answer2, $answer3, $answer4, $answer5,
        $correctAnswer, $answerDescription, $type, $_SESSION['subject'], $topicId, $_SESSION['auth_user']['userId'], $db_connection->getConnection());

    if($data){
        redirect("Question Added Successfully","view/teacher/teacherDashboard.php");
    }else{
        redirect("Something Went Wrong","view/teacher/question/addQuestion.php");
    }

}

?>
