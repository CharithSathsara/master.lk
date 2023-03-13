<?php

include('../../config/app.php');
include_once('../../model/User.php');


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $first_name = esc($_POST['first-name']);
    $last_name = esc($_POST['last-name']);
    $dob = $_POST['dob'];
    $address_first = esc($_POST['address-first']);
    $address_second = esc($_POST['address-second']);
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $username = esc($_POST['username']);
    
    $isUpdateSuccess = User::changeUserInfo($db_connection->getConnection(),$first_name, $last_name, $dob, $address_first, $address_second, $telephone, $email, $username);

    if($isUpdateSuccess){
        $_SESSION['change-info-success']="User Information has been changed successfully!";
        redirect("", "view/common/profile.php");
        
    }else{
        redirect("", "view/common/profile.php");
    }
    
        
}

?>