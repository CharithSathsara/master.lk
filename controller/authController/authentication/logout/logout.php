<?php

include('../../../../config/app.php');
include_once('LogoutController.php');


$logoutController = new LogoutController();


if($_SERVER['REQUEST_METHOD'] == 'POST'){

$isLogoutSuccess = $logoutController->logout();

if($isLogoutSuccess){
    popup_redirect("Logged out successfully", 'view/authentication/index.php');
}

}

?>