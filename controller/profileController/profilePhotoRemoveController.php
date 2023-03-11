<?php

include('../../config/app.php');
include_once('../../model/User.php');


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    
    $isRemoveSuccess = User::removeProfilePhoto($db_connection->getConnection());

    if($isRemoveSuccess){
        $_SESSION['remove-photo-success']="Profile Photo has been removed successfully!";
        redirect("", "view/common/profile.php");
        
    }else{
        redirect("", "view/common/profile.php");
    }
    
        
}

?>