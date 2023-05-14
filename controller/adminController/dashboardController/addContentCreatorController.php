<?php


$currentDir = __DIR__;

include_once $currentDir.'\..\..\..\config\app.php';
include_once $currentDir.'\..\..\..\model\Admin.php';
include_once $currentDir.'\..\..\..\model\User.php';

if (isset($_POST['addContentCreator-button'])) {

    $fname = validateInput($db_connection->getConnection(), $_POST['fname']);
    $lname = validateInput($db_connection->getConnection(), $_POST['lname']);
    $address1 = validateInput($db_connection->getConnection(), $_POST['address1']);
    $address2 = validateInput($db_connection->getConnection(), $_POST['address2']);
    $number = validateInput($db_connection->getConnection(), $_POST['number']);
    $email = validateInput($db_connection->getConnection(), $_POST['email']);
    $username = validateInput($db_connection->getConnection(), $_POST['username']);
    // $password = validateInput($db_connection->getConnection(), $_POST['password']);
    $subject = validateInput($db_connection->getConnection(), $_POST['subjects']);
    $qualification = validateInput($db_connection->getConnection(), $_POST['qualification']);


// Function to generate a random string
    function generateRandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $result;
    }

    $data_setEmail = User::checkEmailExist($db_connection->getConnection(), $email);
    $data_setUsername = User::checkUsernameExist($db_connection->getConnection(), $username);

    if (empty(trim(($fname)))) {
        unset($_POST['addContentCreator-button']);
        $_SESSION['add_Creator'] = 'First name is required';

        redirect("", "view/admin/adminDashboard.php");

    } else if (empty(trim(($lname)))) {
        unset($_POST['addContentCreator-button']);
        $_SESSION['add_Creator'] = 'Last name is required';

        redirect("", "view/admin/adminDashboard.php");

    } else if (empty(trim(($address1)))) {
        unset($_POST['addContentCreator-button']);
        $_SESSION['add_Creator'] = 'Address is required';

        redirect("", "view/admin/adminDashboard.php");

    } else if (empty(trim(($address2)))) {
        unset($_POST['addContentCreator-button']);
        $_SESSION['add_Creator'] = 'Address is required';

        redirect("", "view/admin/adminDashboard.php");

    } else if (empty(trim(($number)))) {
        unset($_POST['addContentCreator-button']);
        $_SESSION['add_Creator'] = 'Number is required';

        redirect("", "view/admin/adminDashboard.php");

    } else if (empty(trim(($email)))) {
        unset($_POST['addContentCreator-button']);
        $_SESSION['add_Creator'] = 'Email is required';

        redirect("", "view/admin/adminDashboard.php");

    } else if (empty(trim(($username)))) {
        unset($_POST['addContentCreator-button']);
        $_SESSION['add_Creator'] = 'Username is required';

        redirect("", "view/admin/adminDashboard.php");

    } else if (empty(trim(($subject)))) {
        unset($_POST['addContentCreator-button']);
        $_SESSION['add_Creator'] = 'Subject is required';

        redirect("", "view/admin/adminDashboard.php");

    } else if (preg_match("/^[\w\-]+@[\w\-]+.[\w\-]+$/", $username)) {
        unset($_POST['addContentCreator-button']);
        $_SESSION['add_Creator'] = "The username should not include '@' symbol";

        redirect("", "view/admin/adminDashboard.php");

    } else if (strlen($number) != 10) {
        unset($_POST['addContentCreator-button']);
        $_SESSION['add_Creator'] = "should be include 10 numbers";

        redirect("", "view/admin/adminDashboard.php");

    } else if (mysqli_num_rows($data_setEmail) == 1) {
        $_SESSION['add_Creator'] = 'Email already exists';
//
        redirect("", "view/admin/adminDashboard.php");

    } else if (mysqli_num_rows($data_setUsername) == 1) {
        $_SESSION['add_Creator'] = 'User name already exists';
//
        redirect("", "view/admin/adminDashboard.php");
    } else {

// Generate a random password for the content creator
        $passwordLength = 10; // set the desired length of the password
        $password = generateRandomString($passwordLength);


// for mail function variable
        $from_email = "master.lk.pvt@gmail.com";
        $ContentCreatorName = $fname . " " . $lname;
        $to = $email;
        $mail_subject = 'Secure Password Transfer';
        $mail_body = "<div style='background-color: #B1D4E0;color: black;width: 400px;padding: 15px'>
                       <p >Dear $ContentCreatorName</p> <br>
                       <p>
                            <p>Welcome to <a href='#'>Master.lk</a> ! We are writing to provide you with a secure password that you will
                             need to access our Content Creator account. Please find the password attached to this email.
                            </p><br>
                            <p style='black;color: white;width:250px;text-align: center;padding: 8px;margin: 5px; font-size: 20px'> Password : $password </p>
                            <p>To ensure the security of the password, We have taken the following precautions:</p><br>
                            <p>
                                <ul>
                                    <li>The password is a strong and unique combination of letters, numbers, and symbols.</li>
                                    <li>We have not included any identifying information in this email, such as the account name or username.</li>
                                    <li>We kindly request that you change the password once you have successfully logged into the account. Please do not share the password with anyone else.</li>
                                </ul>
                            </p>
                           <p>
                                If you have any questions or concerns, please do not hesitate to contact us. Thank you for your attention to this matter.
                           </p> 
                        </p>
                  </div> ";
        $header = "From :$from_email\r\nContent-Type: text/html;";


// Insert the content creator details and password into the database
// Code to insert the details into the database goes here
        $data = Admin::addContentCreator($fname, $lname, $address1, $address2, $number, $email, $username, $password, $subject, $db_connection->getConnection());


        if ($data) {

            mail($to, $mail_subject, $mail_body, $header);


            header('Location: ../../../view/admin/adminDashboard.php');
        } else {
            header("Location: ../../../view/admin/dashboard/addContentCreator.php");
        }
    }
}

?>