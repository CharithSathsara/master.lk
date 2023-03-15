<?php

include('../../../../config/app.php');
include('../../../../model/Student.php');
require_once('SignupController.php');

$signupController = new SignupController();

//Gets the signup form data
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $first_name = esc($_POST['signup-first-name']);
    $last_name = esc($_POST['signup-last-name']);
    $dob = $_POST['signup-dob'];
    $address_first = esc($_POST['signup-address-first']);
    $address_second = esc($_POST['signup-address-second']);
    $telephone = $_POST['signup-telephone'];
    $email = $_POST['signup-email'];
    $username = esc($_POST['signup-username']);
    $password = esc($_POST['signup-password']);
    $password_retype = esc($_POST['signup-password-retype']);

    $email_validity = $signupController->does_email_exist($email);
    $username_validity = $signupController->is_username_valid($username);
    $password_validity = $signupController->is_password_valid($password);
    $password_confirmation = $signupController->do_passwords_match($password,$password_retype);

    if($email_validity && $username_validity && $password_validity && $password_confirmation){

        if (!empty($db_connection)) {

            // hashing the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $data_entry = Student::register($db_connection->getConnection(), $first_name, $last_name, $dob, $address_first, $address_second, $telephone, $email, $username, $hashed_password);

            if($data_entry){
                popup_redirect("Signed Up Successfully !","view/authentication/index.php");
            }else{
                popup_redirect("Something Went Wrong","view/authentication/index.php");
            }

        }

    }else {
        signup_error_redirect($_SESSION['signup-error-message'],"view/authentication/index.php");
    }
}

?>
