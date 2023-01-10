<?php

//include('../../config/app.php');
include('../../../../config/app.php');
require_once('RegisterController.php');

if(isset($_POST['register'])){

    $firstname = validateInput($db_connection->getConnection(), $_POST['firstname']);
    $lastname = validateInput($db_connection->getConnection(), $_POST['lastname']);
    $dob = validateInput($db_connection->getConnection(), $_POST['dob']);
    $add01 = validateInput($db_connection->getConnection(), $_POST['add01']);
    $add02 = validateInput($db_connection->getConnection(), $_POST['add02']);
    $mobile = validateInput($db_connection->getConnection(), $_POST['mobile']);
    $email = validateInput($db_connection->getConnection(), $_POST['email']);
    $username = validateInput($db_connection->getConnection(), $_POST['username']);
    $password = validateInput($db_connection->getConnection(), $_POST['password']);
    $r_password = validateInput($db_connection->getConnection(), $_POST['r_password']);

    $registerController = new RegisterController();

    //Check password strength
    if($registerController->checkPasswordStrength($password)){
        $confirmPassword = $registerController->confirmPassword($password, $r_password);
        if($confirmPassword){
            if($registerController->isUserNameExists($username)){
                redirect("This UserName is already used\nUser Name : $username", "view/authentication/register.php");
            }else if($registerController->isEmailExists($email)){
                redirect("This Email is already used\nEmail : $email", "view/authentication/register.php");
            }else{

                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $data = $registerController->register($firstname, $lastname, $dob, $add01, $add02, $mobile, $email, $username, $hashed_password);

                if($data){
                    redirect("Registration Successfully","view/authentication/login.php");
                }else{
                    redirect("Something Went Wrong","view/authentication/register.php");
                }
            }
        }else{
            redirect("Password and Confirm Password does not match", "view/authentication/register.php");
        }
    }
}

?>
