<?php
include_once('../../../config/app.php');
include_once('../../../model/Teacher.php');
include_once('../../../model/User.php');

    if(isset($_POST['updateteacher-button'])){

        $userId = validateInput($db_connection->getConnection(),$_POST['userId']);
        $fname = validateInput($db_connection->getConnection(),$_POST['fname']);
        $lname = validateInput($db_connection->getConnection(),$_POST['lname']);
        $address1 = validateInput($db_connection->getConnection(),$_POST['address1']);
        $address2 = validateInput($db_connection->getConnection(),$_POST['address2']);
        $number = validateInput($db_connection->getConnection(),$_POST['number']);
        $email = validateInput($db_connection->getConnection(),$_POST['email']);
        $subject = validateInput($db_connection->getConnection(),$_POST['subjects']);
        $qualification = validateInput($db_connection->getConnection(),$_POST['subjects']);


        $numberArray = str_split($number);

        $data_setEmail = User::checkEmailExist($db_connection->getConnection(), $email);


        $_SESSION['user']['userId'] = $userId;
        $_SESSION['user']['firstName'] = $fname;
        $_SESSION['user']['lastName'] = $lname;
        $_SESSION['user']['addLine01'] = $address1;
        $_SESSION['user']['addLine02'] = $address2;
        $_SESSION['user']['mobile'] = $number;
        $_SESSION['user']['email'] = $email;


        $before_email = User::getUserEmail($db_connection->getConnection(),$userId);

        if (empty(trim(($fname)))) {
        unset($_POST['updateteacher-button']);
        $_SESSION['update_Teacher'] = 'First name is required';

        redirect("", "view/admin/adminDashboard.php");
    }else if (empty(trim(($lname)))) {
        unset($_POST['updateteacher-button']);
        $_SESSION['update_Teacher'] = 'Last name is required';

        redirect("", "view/admin/adminDashboard.php");

    } else if (empty(trim(($address1)))) {
        unset($_POST['updateteacher-button']);
        $_SESSION['update_Teacher'] = 'Address is required';

        redirect("", "view/admin/adminDashboard.php");

    } else if (empty(trim(($address2)))) {
        unset($_POST['updateteacher-button']);
        $_SESSION['update_Teacher'] = 'Address is required';

        redirect("", "view/admin/adminDashboard.php");

    } else if (empty(trim(($number)))) {
        unset($_POST['updateteacher-button']);
        $_SESSION['update_Teacher'] = 'Number is required';

        redirect("", "view/admin/adminDashboard.php");

    } else if (empty(trim(($email)))) {
        unset($_POST['updateteacher-button']);
        $_SESSION['update_Teacher'] = 'Email is required';

        redirect("", "view/admin/adminDashboard.php");

    } else  if (empty(trim(($subject)))) {
        unset($_POST['updateteacher-button']);
        $_SESSION['update_Teacher'] = 'Subject is required';

        redirect("", "view/admin/adminDashboard.php");

    } else  if(strlen($number)!= 10){
        unset($_POST['updateteacher-button']);
        $_SESSION['update_Teacher'] = "should be include 10 numbers";

        redirect("", "view/admin/adminDashboard.php");

    }else if(!$numberArray[0]==0) {
            unset($_POST['updateteacher-button']);
            $_SESSION['update_Teacher'] = "Invalid Mobile Number";

            redirect("", "view/admin/adminDashboard.php");

    }else if(mysqli_num_rows($data_setEmail) == 1 && $email != $before_email) {
            unset($_POST['updateteacher-button']);
            $_SESSION['update_Teacher'] = 'Email already exists';

            redirect("", "view/admin/adminDashboard.php");

    }  else {
        $data = Teacher::updateTeacherDetails($fname, $lname, $address1, $address2, $number, $email, $userId, $subject, $db_connection->getConnection());

        if ($data) {
            header("Location: ../../../view/admin/adminDashboard.php");
        } else {
            header("Location: ../../../view/admin/adminDashboard.php");
        }
    }
  }
?>
