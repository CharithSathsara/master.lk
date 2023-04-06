<?php

$currentDir = __DIR__;


include_once $currentDir.'\..\..\..\config\app.php';
include_once $currentDir.'\..\..\..\model\slipPayment.php';
include_once $currentDir.'\..\..\..\model\Student.php';

// for Accept payment slip
    if(isset($_POST['yesButton-pop'])){

        $paymentId = validateInput($db_connection->getConnection(), $_POST['PaymentId']);

        $details = slipPayment::getAllOwner($paymentId,$db_connection->getConnection());

        $detail = $details->fetch_assoc();
        $studentId = $detail['studentId'];


        // for mail function variable
        $from_email = "master.lk.pvt@gmail.com";
        $studentName = Student::getStudentName($db_connection->getConnection(),$studentId);
        $to = Student::getStudentEmail($db_connection->getConnection(),$studentId);
        $mail_subject = 'Payment slip accept';
        $mail_body = "<div style='background-color: #ebffff;color: black;width: 400px;padding: 15px'>
                       <p >Dear $studentName</p> <br>
                       <p>
                            <p> We are writing to confirm that we have received the bank deposit payment slip for the purchase
                             of the Physics/Chemistry Subject course on <a href='#'>Master.lk</a>.
                              We have successfully verified the payment and your enrollment in the course is now confirmed.
                            </p><br>
                            <p>We are delighted to have you as our student and we are confident that you will find the course both 
                            informative and valuable. 
                            </p><br>
                            <p>
                                If you have any further questions or concerns, please do not hesitate to reach out to us.
                                 We are here to support you in any way we can.Thank you for choosing <a href='#'>Master.lk</a> for 
                                 your learning journey.
                            </p>
                           <p>   
                                Best regards,
                           </p> 
                        </p>
                  </div> ";
        $header = "From :$from_email\r\nContent-Type: text/html;";


        $data = slipPayment::acceptPaymentSlip($paymentId,$db_connection->getConnection());

        if($data){

            mail($to,$mail_subject,$mail_body,$header);
            header('Location: ../../../view/admin/payment/paymentVerification.php');
        }else{
            echo "error";
        }
    }

//    for reject payment slip

    if(isset($_POST['yesRejectButton-pop'])){

        $paymentId = validateInput($db_connection->getConnection(), $_POST['PaymentId']);
        echo $paymentId;

        $details = slipPayment::getAllOwner($paymentId,$db_connection->getConnection());

        $detail = $details->fetch_assoc();
        $studentId = $detail['studentId'];


        // for mail function variable
        $from_email = "master.lk.pvt@gmail.com";
        $studentName = Student::getStudentName($db_connection->getConnection(),$studentId);
        $to = Student::getStudentEmail($db_connection->getConnection(),$studentId);
        $mail_subject = 'Payment slip reject';
        $mail_body = "<div style='background-color: #ebffff;color: black;width: 400px;padding: 15px'>
                           <p >Dear $studentName</p> <br>
                           <p>
                                <p> Thank you for submitting the bank deposit payment slip for the purchase of the 
                                Physics/Chemistry Subject course on <a href='#'>Master.lk</a>. Unfortunately, we were unable to verify the 
                                payment using the bank slip provided.Please double-check that the payment details on the slip 
                                match the information provided in the bank deposit payment instructions. Ensure that the amount, 
                                account number, and other details are correct.
                                </p><br>
                                <p>If you believe that there has been a mistake or error, please do not hesitate to contact us with 
                                any relevant information or documentation that can help us to verify the payment.Once we receive the 
                                corrected payment details or verification,we will process your enrollment in the course promptly. 
                                </p><br>
                                <p>
                                    Thank you for your understanding, and we apologize for any inconvenience caused.
                                </p>
                               <p>   
                                    Best regards,
                               </p> 
                            </p>
                      </div> ";
        $header = "From :$from_email\r\nContent-Type: text/html;";


        $data = slipPayment::rejectPaymentSlip($paymentId,$db_connection->getConnection());

        if($data){

            mail($to,$mail_subject,$mail_body,$header);
            header('Location: ../../../view/admin/payment/paymentVerification.php');
        }else{
            echo "error";
        }
    }


?>
