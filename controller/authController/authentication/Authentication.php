<?php

class Authentication {

    public static function userAuthentication(){
        
        if(!isset($_SESSION['authenticated'])){
            restrict_access_redirect("Please log in to access the pages", 'view/authentication/unauthenticatedAccess.php');
            return false;
        }else{
            return true;
        }
    }

}

?>