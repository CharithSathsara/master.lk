<?php

include('../../../config/app.php');
require_once('../../../model/Teacher.php');

$question_id = validateInput($db_connection->getConnection(), $_GET['question_id']);

$result = Teacher::deleteQuestion($db_connection->getConnection(), $question_id);

if($result){
    redirect("Question Deleted Successfully", "view/teacher/teacherDashboard.php");
}else{
<<<<<<< HEAD
    redirect("Something Went Wrong while Deleting a Question", "view/teacher/teacherDashboard.php");
=======
>>>>>>> origin/master
    return false;
}

?>