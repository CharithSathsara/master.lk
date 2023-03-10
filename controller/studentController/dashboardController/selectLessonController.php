<?php


include('../../../../config/app.php');

if(isset($_POST['lesson'])){
    // Getting the value of button
    $_SESSION['current-lesson'] = $_POST['lesson'];
    redirect("", "view/student/topicsAndFeedbacks.php");
}


?>