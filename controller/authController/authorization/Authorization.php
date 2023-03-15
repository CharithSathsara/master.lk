<?php

class Authorization {

    public static function authorizingAdmin(){

        if($_SESSION['auth_role'] === "ADMIN"){
            return true;
        }else{
            redirect("You Are not Authorized as an Admin","view/authentication/index.php");
        }

    }

    public static function authorizingTeacher(){

        if($_SESSION['auth_role'] === "TEACHER"){
            return true;
        }else{
            redirect("You Are not Authorized as an TEACHER","view/authentication/index.php");
        }

    }

    public static function authorizingContentCreator(){

        if($_SESSION['auth_role'] === "CONTENTCREATOR"){
            return true;
        }else{
            redirect("You Are not Authorized as an CONTENT CREATOR","view/authentication/index.php");
        }

    }

    public static function authorizingStudent(){

        if($_SESSION['auth_role'] === "STUDENT"){
            return true;
        }else{
            redirect("You Are not Authorized as an STUDENT","view/authentication/index.php");
        }

    }

}

?>