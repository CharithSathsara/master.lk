<?php


include_once('../../../config/app.php');
include_once('../../../model/ContentCreator.php');
include_once('../../../model/User.php');

    if(isset($_POST['updateContentCreator-button'])) {

        $userId = validateInput($db_connection->getConnection(), $_POST['userId']);
        $fname = validateInput($db_connection->getConnection(), $_POST['fname']);
        $lname = validateInput($db_connection->getConnection(), $_POST['lname']);
        $address1 = validateInput($db_connection->getConnection(), $_POST['address1']);
        $address2 = validateInput($db_connection->getConnection(), $_POST['address2']);
        $number = validateInput($db_connection->getConnection(), $_POST['number']);
        $email = validateInput($db_connection->getConnection(), $_POST['email']);
        $subjects = validateInput($db_connection->getConnection(), $_POST['subjects']);

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
            unset($_POST['updateContentCreator-button']);
            $_SESSION['upp_Creator'] = 'First name is required';

            redirect("", "view/admin/adminDashboard.php");
        } else if (empty(trim(($lname)))) {
            unset($_POST['updateContentCreator-button']);
            $_SESSION['upp_Creator'] = 'Last name is required';

            redirect("", "view/admin/adminDashboard.php");

        } else if (empty(trim(($address1)))) {
            unset($_POST['updateContentCreator-button']);
            $_SESSION['upp_Creator'] = 'Address is required';

            redirect("", "view/admin/adminDashboard.php");

        } else if (empty(trim(($address2)))) {
            unset($_POST['updateContentCreator-button']);
            $_SESSION['upp_Creator'] = 'Address is required';

            redirect("", "view/admin/adminDashboard.php");

        } else if (empty(trim(($number)))) {
            unset($_POST['updateContentCreator-button']);
            $_SESSION['upp_Creator'] = 'Number is required';

            redirect("", "view/admin/adminDashboard.php");

        } else if (empty(trim(($email)))) {
            unset($_POST['updateContentCreator-button']);
            $_SESSION['upp_Creator'] = 'Email is required';

            redirect("", "view/admin/adminDashboard.php");

        } else if (empty(trim(($subjects)))) {
            unset($_POST['updateContentCreator-button']);
            $_SESSION['upp_Creator'] = 'Subject is required';

            redirect("", "view/admin/adminDashboard.php");

        } else if (strlen($number) != 10) {
            unset($_POST['updateContentCreator-button']);
            $_SESSION['upp_Creator'] = "should be include 10 numbers";

            redirect("", "view/admin/adminDashboard.php");

        } else if (mysqli_num_rows($data_setEmail) == 1 && $email != $before_email) {
            $_SESSION['upp_Creator'] = 'Email is exist';

            redirect("", "view/admin/adminDashboard.php");

        } else {

            $data = ContentCreator::updateContentCreator($userId, $fname, $lname, $address1, $address2, $number, $email, $subjects, $db_connection->getConnection());

            if ($data) {
                header("Location: ../../../view/admin/adminDashboard.php");
            } else {
                //            header("Location: ../../../view/admin/adminDashboard.php");
                echo "ERROr";
            }
        }
    }
?>