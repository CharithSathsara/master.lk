<?php
    include('../../../config/app.php');
    require_once('AdminDashboardController.php');
    require_once('../../../model/Admin.php');
    require_once('../../../model/Teacher.php');

    if(isset($_POST['updateteacher-button'])){

        $userId = validateInput($db_connection->getConnection(),$_POST['userId']);
        $fname = validateInput($db_connection->getConnection(),$_POST['fname']);
        $lname = validateInput($db_connection->getConnection(),$_POST['lname']);
        $address1 = validateInput($db_connection->getConnection(),$_POST['address1']);
        $address2 = validateInput($db_connection->getConnection(),$_POST['address2']);
        $number = validateInput($db_connection->getConnection(),$_POST['number']);
        $email = validateInput($db_connection->getConnection(),$_POST['email']);
        $username = validateInput($db_connection->getConnection(),$_POST['username']);
        $subject = validateInput($db_connection->getConnection(),$_POST['subjects']);


        $data = Teacher::updateTeacherDetails($fname,$lname,$address1,$address2,$number,$email,$username,$userId,$subject,$db_connection->getConnection());

        if($data){
            header("Location: ../../../view/admin/adminDashboard.php");
        }else{
            header("Location: ../../../view/admin/dashboard/updateTeacher.php");
        }

    }
?>
