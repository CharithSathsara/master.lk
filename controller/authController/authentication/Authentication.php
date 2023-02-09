<?php

class Authentication{

    public static function userAuthentication(){
        if(!isset($_SESSION['authenticated'])){
            restrict_access_redirect("Please login to access the pages", 'view/authentication/index.php');
            return false;
        }else{
            return true;
        }
    }

}

?>
