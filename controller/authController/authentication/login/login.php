<?php

include('../../../../config/app.php');
include('../../../../model/Teacher.php');
include_once('LoginController.php');
include('../../message.php');

$loginController = new LoginController();


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $username_email = esc($_POST['login-username-email']);
    $password = esc($_POST['login-password']);
    
    $isLoginSuccess = $loginController->login($username_email, $password);

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
            popup_redirect("Logged In Successfully !", "view/admin/adminDashboard.php");
        }else if($_SESSION['auth_role'] == "TEACHER"){
            popup_redirect("Logged In Successfully !", "view/teacher/teacherDashboard.php");
        }else if($_SESSION['auth_role'] == "CONTENTCREATOR"){
            popup_redirect("Logged In Successfully !", "view/contentcreator/contentCreatorDashboard.php");
        }else if($_SESSION['auth_role'] == "STUDENT"){
            popup_redirect("Logged In Successfully !", "view/student/studentDashboard.php");
        }else{
            popup_redirect("Something Went Wrong", "view/authentication/index.php");
        }
        
    }else{
        login_error_redirect("Invalid Username or Password !", "view/authentication/index.php");
    }
    
        
}

?>
