<?php

class LoginController {

    public function __construct(){

    }

    public static function isLoggedIn(){

        //redirect to relevant dashboards
        if(isset($_SESSION['authenticated']) === TRUE){

            if($_SESSION['auth_role'] === "ADMIN"){
                redirect("admin", "view/admin/adminDashboard.php");
            }else if($_SESSION['auth_role'] === "TEACHER"){
                redirect("teacher", "view/teacher/teacherDashboard.php");
            }else if($_SESSION['auth_role'] === "CONTENTCREATOR"){
                redirect("contentcreator", "view/contentcreator/contentCreatorDashboard.php");
            }else{
                redirect("student", "view/student/studentDashboard.php");
            }

        }else{
            return false;
        }

    }

}

?>
