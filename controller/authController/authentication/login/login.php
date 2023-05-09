<?php

include('../../../../config/app.php');
include('../../../../model/Teacher.php');
include('../../../../model/User.php');
include('../../message.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $username_email = esc($_POST['login-username-email']);
    $password = esc($_POST['login-password']);

    if (!empty($db_connection)) {

        $isLoginSuccess = User::login($db_connection->getConnection(), $username_email, $password);

        if($isLoginSuccess){

            if(isset($_POST["remember-me"])) {
                setcookie ("myUsername",$_POST["login-username-email"],time() + 3600, "/");
                setcookie ("myPassword",$_POST["login-password"],time() + 3600 , "/");
            } else {
                if(isset($_COOKIE["myUsername"])) {
                    setcookie("myUsername","", time() - 3600, "/");
                }
                if(isset($_COOKIE["myPassword"])) {
                    setcookie("myPassword","", time() - 3600, "/");
                }
            }

            if($_SESSION['auth_role'] == "ADMIN"){
                redirect("Logged In Successfully !", "view/admin/adminDashboard.php");
            }else if($_SESSION['auth_role'] == "TEACHER"){
                $_SESSION['subject'] = Teacher::getTeacherSubject($db_connection->getConnection(), $_SESSION['auth_user']['userId']);
                redirect("Logged In Successfully !", "view/teacher/teacherDashboard.php");
            }else if($_SESSION['auth_role'] == "CONTENTCREATOR"){
                redirect("Logged In Successfully !", "view/contentcreator/contentCreatorDashboard.php");
            }else if($_SESSION['auth_role'] == "STUDENT"){
                redirect("Logged In Successfully !", "view/student/studentDashboard.php");
            }else{
                redirect("Something Went Wrong", "view/authentication/index.php");
            }

        }else{
            login_error_redirect("Invalid Username or Password !", "view/authentication/index.php");
        }

    }

}

?>
