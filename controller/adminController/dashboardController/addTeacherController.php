<?php

$currentDir = __DIR__;

include_once $currentDir.'\..\..\..\config\app.php';
include_once $currentDir.'\..\..\..\model\Admin.php';

if(isset($_POST['addteacher-button'])){

    $fname = validateInput($db_connection->getConnection(),$_POST['fname']);
    $lname = validateInput($db_connection->getConnection(),$_POST['lname']);
    $address1 = validateInput($db_connection->getConnection(),$_POST['address1']);
    $address2 = validateInput($db_connection->getConnection(),$_POST['address2']);
    $number = validateInput($db_connection->getConnection(),$_POST['number']);
    $email = validateInput($db_connection->getConnection(),$_POST['email']);
    $username = validateInput($db_connection->getConnection(),$_POST['username']);
   // $password = validateInput($db_connection->getConnection(),$_POST['password']);
    $subject = validateInput($db_connection->getConnection(),$_POST['subjects']);
    $qualification = validateInput($db_connection->getConnection(),$_POST['qualification']);

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

// Generate a random password for the content creator
    $passwordLength = 10; // set the desired length of the password
    $password = generateRandomString($passwordLength);

    // for mail function variable
    $from_email = "master.lk.pvt@gmail.com";
    $teacherName = $fname ." ". $lname;
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





    $data = Admin::addTeacher($fname,$lname,$address1,$address2,$number,$email,$username,$password,$subject,$db_connection->getConnection());


    $id = $_GET['id'];
    if($data){
        mail($to,$mail_subject,$mail_body,$header);
       header('Location: ../../../view/admin/adminDashboard.php');
    }else{
        header("Location: ../../../view/admin/dashboard/addTeacher.php");
    }
}
?>