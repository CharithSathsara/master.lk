<?php

include('../../config/app.php');
include_once('../../model/User.php');


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $current_password = esc($_POST['current-password']);
    $new_password = esc($_POST['new-password']);
    $retype_new_password = esc($_POST['retype-new-password']);
    
    $isUpdateSuccess = User::changePassword($db_connection->getConnection(),$current_password,$new_password,$retype_new_password);

    if($isUpdateSuccess){
        $_SESSION['change-pw-success']="Password has been changed successfully!";
        redirect("", "view/common/profile.php");
        
    }else{
        redirect("", "view/common/profile.php");
    }
    
        
}

?>
