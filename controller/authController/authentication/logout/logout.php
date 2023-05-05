<?php

include('../../../../config/app.php');
include('../../../../model/User.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $isLogoutSuccess = User::logout($db_connection->getConnection());

    if($isLogoutSuccess){
        popup_redirect("Logged out successfully", 'view/authentication/index.php');
    }

}

?>