<?php

class Authentication{

    public static function userAuthentication(){
        
        if(!isset($_SESSION['authenticated'])){
            echo"awaaaaa";
            restrict_access_redirect("Please login to access the pages", 'view/authentication/index.php');
            return false;
        }else{
            return true;
        }
    }

}

?>