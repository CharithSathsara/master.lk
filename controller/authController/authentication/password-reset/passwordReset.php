<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../../vendor/autoload.php';

include('../../../../config/app.php');
include('../../../../model/PasswordReset.php');
require_once('PasswordResetController.php');

$passwordResetController = new PasswordResetController();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["verify-email"])){

    $verifyEmail = esc($_POST['user-email']);

    $isVerifyEmail = $passwordResetController->verify_email($verifyEmail);

    if($isVerifyEmail){

        if (!empty($db_connection)) {

            $token = bin2hex(openssl_random_pseudo_bytes(32));
            $expires = date('Y-m-d H:i:s', strtotime('+24 hours'));
            $link = "http://localhost/master.lk/view/authentication/index.php?email=$verifyEmail&token=$token&action=reset";

            $data_entry = PasswordReset::insertToken($db_connection->getConnection(), $verifyEmail, $token, $expires);

            if($data_entry){

                // Send email with password reset link
                $body='<p>Dear user,</p>';
                $body.='<p>Please click on the following link to reset your password.</p>';
                $body.='<p>-------------------------------------------------------------</p>';
                $body.='<p><a href='.$link.' target="_blank">'.$link.'</a></p>';
                $body.='<p>-------------------------------------------------------------</p>';
                $body.='<p>Please be sure to copy the entire link into your browser. The link will expire after 1 day for security reason.</p>';
                $body.='<p>If you did not request this forgotten password email, no action is needed, your password will not be reset. However, you may want to log into 
                             your account and change your security password as someone may have guessed it.</p>';
                $body.='<p>Thanks,</p>';
                $body.='<p>Master.lk Team</p>';

                try {
                    $mail = new PHPMailer();

                    // Enable verbose debug output
                    $mail->isSMTP();                        // Set mailer to use SMTP
                    $mail->Host       = 'smtp.gmail.com;';    // Specify main SMTP server
                    $mail->SMTPAuth   = true;               // Enable SMTP authentication
                    $mail->Username   = 'cloudcharith@gmail.com';     // SMTP username
                    $mail->Password   = 'kqlownfkdeeqvrob';         // SMTP password
                    $mail->SMTPSecure = 'tls';              // Enable TLS encryption
                    $mail->Port       = 587;

                    $mail->setFrom('cloudcharith@gmail.com', 'Master.lk Academy');// Set sender of the mail

                    $mail->addAddress($verifyEmail);// Add a recipient

                    $mail->isHTML(true);
                    $mail->Subject = 'Password Recovery - Master.lk';
                    $mail->Body    = $body;

                    if($mail->Send()) {
                        $_SESSION['verify-email-success']="Sent email successfully!";
                        redirect("","view/authentication/index.php?action=verify-email");
                    }else {
                        echo "Message could not be sent. Mailer Error " . $mail->ErrorInfo;
                    }

                } catch (Exception $e) {
                    verify_email_error_redirect("Mail Error","view/authentication/index.php?action=verify-email");
                }

            }else{
                verify_email_error_redirect("Something Went Wrong","view/authentication/index.php?action=verify-email");
            }
        }

    }else {
        verify_email_error_redirect("The $verifyEmail address is not valid","view/authentication/index.php?action=verify-email");
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["reset-password"])){

    $new_password = $_POST['reset-pwd'];
    $retype_new_password = $_POST['retype-reset-pwd'];

    if($new_password === $retype_new_password) {

        $email = $_POST['email'];
        $token = $_POST['token'];

        $isTokenValid = $passwordResetController->verify_token_and_time($email, $token);

        if($isTokenValid){

            if(!empty($db_connection)){

                //new password
                $password = password_hash($new_password, PASSWORD_DEFAULT);
                $updateResult = PasswordReset::updatePassword($db_connection->getConnection(), $email, $password);

                if($updateResult){

                    // Send email with password reset link
                    $body='<p>Dear user,</p>';
                    $body.='<p>-------------------------------------------------------------</p>';
                    $body.='<p>This email is to confirm that your password has been successfully updated. If you did not initiate this change, please contact us immediately at master.lk@gmail.com to report any unauthorized access to your account.</p>';
                    $body.='<p>-------------------------------------------------------------</p>';
                    $body.='<p>Thanks,</p>';
                    $body.='<p>Master.lk Team</p>';

                    try {
                        $mail = new PHPMailer();

                        // Enable verbose debug output
                        $mail->isSMTP();                        // Set mailer to use SMTP
                        $mail->Host       = 'smtp.gmail.com;';    // Specify main SMTP server
                        $mail->SMTPAuth   = true;               // Enable SMTP authentication
                        $mail->Username   = 'cloudcharith@gmail.com';     // SMTP username
                        $mail->Password   = 'kqlownfkdeeqvrob';         // SMTP password
                        $mail->SMTPSecure = 'tls';              // Enable TLS encryption
                        $mail->Port       = 587;

                        $mail->setFrom('cloudcharith@gmail.com', 'Master.lk Academy');// Set sender of the mail

                        $mail->addAddress($email);// Add a recipient

                        $mail->isHTML(true);
                        $mail->Subject = 'Password Updated - Master.lk';
                        $mail->Body    = $body;

                        if($mail->Send()) {
                            $_SESSION['update-password-success']="Password update success!";
                            redirect("","view/authentication/index.php?action=reset");
                        }else {
                            echo "Message could not be sent. Mailer Error " . $mail->ErrorInfo;
                        }

                    } catch (Exception $e) {
                        verify_email_error_redirect("Mail Error","view/authentication/index.php?action=verify-email");
                    }

                }else {
                    $_SESSION['password-reset-error'] = "Something went wrong.";
                    $url = "view/authentication/index.php?email=".$_POST['email']."&token=".$_POST['token']."&action=reset";
                    redirect("",$url);
                }

            }

        }else {
            $_SESSION['password-reset-error'] = "your password reset link has expired or invalid. Please try again by verifying your email.";
            $url = "view/authentication/index.php?email=".$_POST['email']."&token=".$_POST['token']."&action=reset";
            redirect("",$url);
        }
    }else {
        $_SESSION['password-reset-error'] = "Password and retype password does not match!";
        $url = "view/authentication/index.php?email=".$_POST['email']."&token=".$_POST['token']."&action=reset";
        redirect("",$url);
    }

}


?>

