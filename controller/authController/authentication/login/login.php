<?php

//include('../../config/app.php');
include('../../../../config/app.php');
include('../../../../model/Teacher.php');
include_once('LoginController.php');

$loginController = new LoginController();

if(isset($_POST['login'])){

    $username = validateInput($db_connection->getConnection(), $_POST['username']);
    $password = validateInput($db_connection->getConnection(), $_POST['password']);

    $isLoginSuccess = $loginController->login($username, $password);

    if($isLoginSuccess){

        if(isset($_POST["remember-me"])) {
            setcookie ("myUsername",$_POST["username"],time() + 3600, "/");
            setcookie ("myPassword",$_POST["password"],time() + 3600 , "/");
        } else {
            if(isset($_COOKIE["myUsername"])) {
                setcookie("myUsername","", time() - 3600, "/");
            }
            if(isset($_COOKIE["myPassword"])) {
                setcookie("myPassword","", time() - 3600, "/");
            }
        }

        if($_SESSION['auth_role'] == "ADMIN"){
            redirect("", "view/admin/adminDashboard.php");
        }else if($_SESSION['auth_role'] == "TEACHER"){
            $_SESSION['subject'] = Teacher::getTeacherSubject($db_connection->getConnection(), $_SESSION['auth_user']['userId']);
            redirect("", "view/teacher/teacherDashboard.php");
        }else if($_SESSION['auth_role'] == "CONTENTCREATOR"){
            redirect("", "view/contentcreator/contentCreatorDashboard.php");
        }else if($_SESSION['auth_role'] == "STUDENT"){
            redirect("", "view/student/studentDashboard.php");
        }else{
            redirect("Something Went Wrong", "view/authentication/login.php");
        }

    }

}

if(isset($_POST['logout'])){

    $isLogoutSuccess = $loginController->logout();

    if($isLogoutSuccess){
        redirect("Log out successfully", 'view/authentication/login.php');
    }

}

?>
