<?php

use PHPMailer\PHPMailer\PHPMailer;

include('../../config/app.php');
include_once('../../model/Student.php');
include_once('../../model/Cart.php');

// Handle the POST request to create a new payment
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $amount = $_POST['totalPrice'];
    $order_id = uniqid();
    $currency = "LKR";

    $hash = strtoupper(
        md5(
            MERCHANT_ID .
            $order_id .
            number_format($amount, 2, '.', '') .
            $currency .
            strtoupper(md5(MERCHANT_SECRET))
        )
    );

    $array = [];

    if (!empty($db_connection)) {

        $student = Student::getStudent($db_connection->getConnection(), $_SESSION['auth_user']['userId']);

        if($student) {

            //set student details
            $array["item"] = "Master.lK Course";
            $array["first_name"] = $student['firstName'];
            $array["last_name"] = $student['lastName'];
            $array["email"] = $student['email'];
            $array["phone"] = $student['mobile'];
            $array["address"] = $student['addLine01'];
            $array["city"] = $student['addLine02'];

            $array["merchant_id"] = MERCHANT_ID;
            $array["order_id"] = $order_id;
            $array["currency"] = $currency;
            $array["merchant_secret"] = MERCHANT_SECRET;
            $array["amount"] = $amount;
            $array["hash"] = $hash;

            $jsonObj = json_encode($array);

            echo $jsonObj;

        }
    }
}

// Update the database
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payment']) && $_POST['payment'] === 'success') {

    if (!empty($db_connection)) {

        $isPaymentSuccess = Student::onlinePayment($db_connection->getConnection(), $_POST['amount'], $_SESSION['auth_user']['userId']);

        if ($isPaymentSuccess) {

            $cart_details = Cart::viewCart($db_connection->getConnection());

            while ($cartRow = $cart_details->fetch_assoc()) {

                $cartId = $cartRow['cartId'];
                $subjectId = $cartRow['subjectId'];

                // give access to student
                $isGiveAccess = Student::giveSubjectAccess($db_connection->getConnection(), $_SESSION['auth_user']['userId'], $subjectId);

            }

            //clear the cart
            Student::clearCart($db_connection->getConnection(), $cartId );

            //send email to student
            $email = Student::getStudentEmail($db_connection->getConnection(), $_SESSION['auth_user']['userId']);

            if($email) {

                $body='<p>Dear user,</p>';
                $body.='<p>We are writing to inform you that your payment for the course(s) you have selected has been successfully processed. Congratulations on taking the first step towards your educational journey!</p>';
                $body.='<br><p>Your account has been updated and you can now access your courses by logging into your account. You will find the course materials in your dashboard.</p>';
                $body.='<br><p>If you have any questions or concerns about the course, please feel free to contact us at master.lk@gmail.com. We will be happy to assist you in any way possible.</p>';
                $body.='<br><p>Thank you for choosing Master.lk as your education partner. We wish you all the best for your future endeavors.</p>';
                $body.='<br><p>Thanks,</p>';
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
                    $mail->Subject = 'Payment Success - Access to Your Courses';
                    $mail->Body    = $body;

                    $mail->Send();

                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error ";
                }
            }
        }
    }
}

?>
