<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../public/css/slipImage.css">

    <title>Payments</title>
</head>
<body>

    <?php
        include_once('../../../config/app.php');
        include_once('../../../controller/authController/authentication/Authentication.php');
        include_once('../../../controller/authController/authorization/Authorization.php');

        //User Authentication
        Authentication::userAuthentication();
        //User Authorization
        Authorization::authorizingAdmin();
    ?>

    <?php

            include_once ('../../../controller/adminController/paymentVerificationController/paymentVerifyController.php');
            include_once ('../../../model/slipPayment.php');
            include_once ('../../../model/Student.php');
            include_once ('../../../model/Subject.php');
            include_once ('../../../model/Cart.php');
            include_once('../../common/header.php');
            include_once('../../common/navBar-Admin.php');
    ?>

   <div class="main-container">
        <div class="slipImage-second">
            <div class="header-container">
                <b><p><span><a href="paymentVerification.php">Payments</a></span>&nbsp;&nbsp;>&nbsp;&nbsp;View Payment Slip</p></b>
            </div>
            <div class="container-2">
                <p>Payment Slip &nbsp;&nbsp;&nbsp;</p>
            </div>

            <div class="body-container">
                <div class="view-imageDiv">
                    <div class="slipImage-container">
                        <?php
                        $slipImage = new paymentVerifyController();
                        $paymentId = $_GET['paymentId'];
                        $slipImage->getSlipImage($paymentId);
                        ?>
                    </div>

                    <div class="slipDetails-container">
                        <div class="details-student">
                            <div class="details-table">
                                <?php
                                $object = new paymentVerifyController();
                                $details = $object->getSlipOwner($paymentId);
                                foreach ($details as $detail){
                                    $userId = $detail['studentId'];
                                    $name = $object->getStudentName($userId);
                                    ?>
                                    <p>Student full name&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $name;?></p>
                                    <p>Paid amount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;Rs. <?php echo $detail['amount'];?></p>
                                    <p>Submit date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $detail['date'];?></p>
                                    <?php
                                        $subjectsId = $object->getAllSubjectByCart($userId);
                                    $toBePaid = 0;
                                        if($subjectsId){
                                            foreach ($subjectsId as $subjectId){

                                                $toBePaid = $toBePaid + $object->getSubjectPrice($subjectId['subjectId']);
                                            }
                                        }
                                    ?>
                                    <p>To be Paid&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rs.  <?php echo $toBePaid;?></p>

                                <?php }
                                ?>
                            </div>

                            <div class="payment-button">
                                <button id="reject-button" class="reject-button-slipImage" onclick="viewRejectPage('<?php echo $paymentId ?>')">Reject</button>
                                <button id="accept-button" onclick="viewAcceptPage('<?php echo $paymentId ?>')">Accept</button>
                            </div>

                            <!--            accept slip page-->
                            <?php include_once ('acceptSlip.php');?>

                            <!--            accept slip js file-->
                            <script src="../../../public/js/acceptSlipImage.js"></script>

                            <!--            reject slip page-->
                            <?php include_once ('rejectSlip.php');?>


                            <!--            reject slip js  file-->
                            <script src="../../../public/js/rejectSlipImage.js"></script>
                        </div>
                    </div>
                </div>
            </div>

        </div>
   </div>
</body>


