<?php

class Authorization{

    public static function authorizingAdmin(){

        if($_SESSION['auth_role'] === "ADMIN"){
            return true;
        }else{
            restrict_access_redirect("You are not authorized as an Admin","view/authorization/unauthorizedAccess.php");
        }

    }

    public static function authorizingTeacher(){

        if($_SESSION['auth_role'] === "TEACHER"){

            return true;
        }else{
            restrict_access_redirect("You are not authorized as a Teacher","view/authorization/unauthorizedAccess.php");
        }

    }

    public static function authorizingContentCreator(){

        if($_SESSION['auth_role'] === "CONTENTCREATOR"){
            return true;
        }else{
            restrict_access_redirect("You are not authorized as a Content Creator","view/authorization/unauthorizedAccess.php");
        }

    }

    public static function authorizingStudent(){

        if($_SESSION['auth_role'] === "STUDENT"){
            return true;
        }else{
            restrict_access_redirect("You are not authorized as a Student","view/authorization/unauthorizedAccess.php");
        }

    }

}

?>