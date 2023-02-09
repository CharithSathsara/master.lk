<?php

class Authorization{

    public static function authorizingAdmin(){

        /*
        $userid = $_SESSION['auth_user']['userId'];
        $query = "SELECT userId,userType FROM user WHERE userId='$userid' AND userType='ADMIN' LIMIT 1";

        $response = $this->connection->query($query);

        if($response->num_rows == 1){
            return true;
        }else{
            redirect("You are not authorized as an Admin","index1.php");
        }
        */

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