<?php

include_once('../../../config/app.php');
//require_once('AdminDashboardController.php');
include_once('../../../model/Admin.php');
//require_once('../../../model/Subject.php');

if(isset($_POST['addteacher-button'])){

    $fname = validateInput($db_connection->getConnection(),$_POST['fname']);
    $lname = validateInput($db_connection->getConnection(),$_POST['lname']);
    $address1 = validateInput($db_connection->getConnection(),$_POST['address1']);
    $address2 = validateInput($db_connection->getConnection(),$_POST['address2']);
    $number = validateInput($db_connection->getConnection(),$_POST['number']);
    $email = validateInput($db_connection->getConnection(),$_POST['email']);
    $username = validateInput($db_connection->getConnection(),$_POST['username']);
    $password = validateInput($db_connection->getConnection(),$_POST['password']);
    $subject = validateInput($db_connection->getConnection(),$_POST['subjects']);
    $qualification = validateInput($db_connection->getConnection(),$_POST['qualification']);

    $data = Admin::addTeacher($fname,$lname,$address1,$address2,$number,$email,$username,$password,$subject,$db_connection->getConnection());

    $id = $_GET['id'];
    if($data){
       header('Location: ../../../view/admin/adminDashboard.php');
    }else{
        header("Location: ../../../view/admin/dashboard/addTeacher.php");
    }
}
?>