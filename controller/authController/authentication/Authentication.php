<?php

class Authentication{

    public static function userAuthentication(){
        if(!isset($_SESSION['authenticated'])){
            redirect("Please Login to Access the Pages", 'view/authentication/login.php');
            return false;
        }else{
            return true;
        }
    }

}

?>
