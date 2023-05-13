<?php

$currentDir = __DIR__;

include_once $currentDir.'\..\..\..\config\app.php';
include_once $currentDir.'\..\..\..\model\Admin.php';
include_once $currentDir.'\..\..\..\model\User.php';
include_once $currentDir.'\..\..\..\model\Teacher.php';

if(isset($_POST['addteacher-button'])) {

    $fname = validateInput($db_connection->getConnection(), $_POST['fname']);
    $lname = validateInput($db_connection->getConnection(), $_POST['lname']);
    $address1 = validateInput($db_connection->getConnection(), $_POST['address1']);
    $address2 = validateInput($db_connection->getConnection(), $_POST['address2']);
    $number = validateInput($db_connection->getConnection(), $_POST['number']);
    $email = validateInput($db_connection->getConnection(), $_POST['email']);
    $username = validateInput($db_connection->getConnection(), $_POST['username']);
    $subject = validateInput($db_connection->getConnection(), $_POST['subjects']);
    $qualification = validateInput($db_connection->getConnection(), $_POST['qualification']);

//    $_SESSION['user']['firstName'] =$fname;
//    $_SESSION['user']['lastName'] = $lname;
//    $_SESSION['user']['addLine01'] = $address1;
//    $_SESSION['user']['addLine02'] = $address2;
//    $_SESSION['user']['mobile'] = $number;
//    $_SESSION['user']['email'] = $email;
//    $_SESSION['user']['username'] =$username;
////    $_SESSION['user']['subject'] =$subject;
//    $_SESSION['user']['qualification'] =$qualification;


//    function is_email($email)
//    {
//        return (preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|
//                                    au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu
//                                    |cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt
//                                    |gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls
//                                    |lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt
//                                    |nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv
//                                    |sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$
//                                    |(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i", $email));
//    }

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

    // check required form data;

    if (empty(trim(($fname)))) {
        unset($_POST['addteacher-button']);
        $_SESSION['add_Teacher'] = 'First name is required';

        redirect("", "view/admin/adminDashboard.php");

    } else if (empty(trim(($lname)))) {
        unset($_POST['addteacher-button']);
        $_SESSION['add_Teacher'] = 'Last name is required';

        redirect("", "view/admin/adminDashboard.php");

    } else if (empty(trim(($address1)))) {
        unset($_POST['addteacher-button']);
        $_SESSION['add_Teacher'] = 'Address is required';

        redirect("", "view/admin/adminDashboard.php");

    } else if (empty(trim(($address2)))) {
        unset($_POST['addteacher-button']);
        $_SESSION['add_Teacher'] = 'Address is required';

        redirect("", "view/admin/adminDashboard.php");

    } else if (empty(trim(($number)))) {
        unset($_POST['addteacher-button']);
        $_SESSION['add_Teacher'] = 'Number is required';

        redirect("", "view/admin/adminDashboard.php");

    } else if (empty(trim(($email)))) {
        unset($_POST['addteacher-button']);
        $_SESSION['add_Teacher'] = 'Email is required';

        redirect("", "view/admin/adminDashboard.php");

    } else if (empty(trim(($username)))) {
        unset($_POST['addteacher-button']);
        $_SESSION['add_Teacher'] = 'Username is required';

        redirect("", "view/admin/adminDashboard.php");

    } else if (empty(trim(($subject)))) {
        unset($_POST['addteacher-button']);
        $_SESSION['add_Teacher'] = 'Subject is required';

        redirect("", "view/admin/adminDashboard.php");

    } else if (preg_match("/^[\w\-]+@[\w\-]+.[\w\-]+$/", $username)) {
        unset($_POST['addteacher-button']);
        $_SESSION['add_Teacher'] = "The username should not include '@' symbol";

        redirect("", "view/admin/adminDashboard.php");

    }else if(strlen($number)!= 10){
        unset($_POST['addteacher-button']);
        $_SESSION['add_Teacher'] = "should be include 10 numbers";

        redirect("", "view/admin/adminDashboard.php");

    } else if(mysqli_num_rows($data_setEmail) == 1) {
                $_SESSION['add_Teacher'] = 'Email is exist';
//
                redirect("", "view/admin/adminDashboard.php");

            } else if (mysqli_num_rows($data_setUsername) == 1) {
            $_SESSION['add_Teacher'] = 'User name is exist';
//
            redirect("", "view/admin/adminDashboard.php");
        } else {

// Generate a random password for the content creator
            $passwordLength = 10; // set the desired length of the password
            $password = generateRandomString($passwordLength);

            // for mail function variable
            $from_email = "master.lk.pvt@gmail.com";
            $teacherName = $fname . " " . $lname;
            $to = $email;
            $mail_subject = 'Secure Password Transfer';
            $mail_body = "<div style='background-color: #B1D4E0;color: black;width: 400px;padding: 15px'>
                       <p >Dear $teacherName</p> <br>
                       <p>
                            <p>Welcome to <a href='#'>Master.lk</a> ! We are writing to provide you with a secure password that you will
                             need to access our Teacher account. Please find the password attached to this email.
                            </p><br>
                            <p style='background-color: black;color: white;width:250px;text-align: center;padding: 8px;margin: 5px; font-size: 20px'> Password : $password </p>
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


            $data = Admin::addTeacher($fname, $lname, $address1, $address2, $number, $email, $username, $password, $subject, $db_connection->getConnection());



           // $id = $_GET['id'];
            if ($data) {
                if(isset($_POST['qualification'])){
                    $data1 = Teacher::addQualification($qualification,$email,$db_connection->getConnection());
                }

                mail($to, $mail_subject, $mail_body, $header);
                header('Location: ../../../view/admin/adminDashboard.php');
            } else {
                header("Location: ../../../view/admin/adminDashboard.php");
            }
    }
}
?>