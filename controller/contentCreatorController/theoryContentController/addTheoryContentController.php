<?php


require_once('../../model/ContentCreator.php');

if(isset($_POST['add-btn'])){
    $selectTopic = validateInput($db_connection->getConnection(), $_POST['selectTopic']);
    $sectionNo = validateInput($db_connection->getConnection(), $_POST['sectionNo']);
    $visibility = validateInput($db_connection->getConnection(), $_POST['radio-visibility']);
    $sectionContent = validateInput($db_connection->getConnection(), $_POST['sectionContent']);
   

    //Method One
    //$addQuestionController = new AddQuestionController();
    //$data = $addQuestionController->addQuestion($subject, $topic, $type, $question, $answer1, $answer2, $answer3, $answer4, $answer5,
                                        //$correctAnswer, $answerDescription);

    //Method Two
    $data = ContentCreator::AddTheoryContents($selectTopic, $sectionNo, $visibility, $sectionContent, $_SESSION['auth_user']['userId'], $db_connection->getConnection());

    if($data){
        redirect("Theory Content Added Successfully","view/teacher/teacherDashboard.php");
    }else{
        redirect("Something Went Wrong while Adding the Theory Content","view/teacher/question/addQuestion.php");
    }

}

?>