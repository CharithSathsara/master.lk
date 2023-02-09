<?php

class Authentication{

    public static function userAuthentication(){
        if(!isset($_SESSION['authenticated'])){
<<<<<<< HEAD
            restrict_access_redirect("Please login to access the pages", 'view/authentication/index.php');
=======
            redirect("Please Login to Access the Pages", 'view/authentication/login.php');
>>>>>>> origin/master
            return false;
        }else{
            return true;
        }
    }

}

?>
