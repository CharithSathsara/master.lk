<?php

include('../../../config/app.php');
require_once('../../../model/Student.php');

if(isset($_POST['feedback-submit'])){

    if (!empty($db_connection)) {

        $feedback = $_POST['feedback'];
        $subject = $_POST['subject'];
        $lesson = $_POST['lesson'];

        $data = Student::insertFeedback($db_connection->getConnection(), $feedback, $_SESSION['auth_user']['userId'], $lesson );

        unset($_POST["feedback-submit"]);
        if($data){
            $_SESSION['feedback-insert-success']="Insert the feedback successfully!";
        }else{
            $_SESSION['feedback-insert-fail']="Inserting feedback failed, please try again!";
        }
        redirect("","view/student/topicsAndFeedbacks.php?subject=$subject&lesson=$lesson");

    }

}

?>

