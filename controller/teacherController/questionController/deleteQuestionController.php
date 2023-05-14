<?php

include('../../../config/app.php');
require_once('../../../model/Teacher.php');

if (isset($_GET['confirmed']) && $_GET['confirmed'] === 'true') {

    $question_id = validateInput($db_connection->getConnection(), $_GET['question_id']);

    $result = Teacher::deleteQuestion($db_connection->getConnection(), $question_id);

    if($result){
        $_SESSION['question-delete-success'] = "Deleted Success";
        redirect("Question Deleted Successfully", "view/teacher/teacherDashboard.php");
    }else{
        $_SESSION['question-delete-fail'] = "Deleted Fail";
        redirect("Something Went Wrong while Deleting a Question", "view/teacher/teacherDashboard.php");
        return false;
    }
}



?>