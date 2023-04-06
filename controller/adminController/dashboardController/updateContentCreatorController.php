<?php


include_once('../../../config/app.php');
include_once('../../../model/contentCreator.php');
//$currentDir = __DIR__;
//
//include_once $currentDir.'\..\..\..\config\app.php';
//
//include_once $currentDir.'\..\..\..\model\contentCreator.php';

    if(isset($_POST['updateContentCreator-button'])){

        $userId = validateInput($db_connection->getConnection(),$_POST['userId']);
        $fname = validateInput($db_connection->getConnection(),$_POST['fname']);
        $lname = validateInput($db_connection->getConnection(),$_POST['lname']);
        $address1 = validateInput($db_connection->getConnection(),$_POST['address1']);
        $address2 = validateInput($db_connection->getConnection(),$_POST['address2']);
        $number = validateInput($db_connection->getConnection(),$_POST['number']);
        $email = validateInput($db_connection->getConnection(),$_POST['email']);
        $subjects = validateInput($db_connection->getConnection(),$_POST['subjects']);


        $data = contentCreator::updateContentCreator($userId,$fname,$lname,$address1,$address2,$number,$email,$subjects,$db_connection->getConnection());

        if ($data){
            header("Location: ../../../view/admin/adminDashboard.php");
        }else{
//            header("Location: ../../../view/admin/adminDashboard.php");
            echo "ERROr";
        }
    }
?>
