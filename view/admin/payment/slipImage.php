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

            include_once ('../../../controller/adminController/paymentVerificationController/paymentVerifyController.php');
            include_once ('../../../model/slipPayment.php');
            include_once ('../../../model/Student.php');
            include_once('../../common/header.php');
            include_once('../../common/navBar-Admin.php');
    ?>

   <div class="main-container">
        <div class="header-container">
        </div>
       <h2><a class="back-to-payments" href="paymentVerification.php"><button>Payments</button></a> > View Payment Slip </h2>
       <hr>
        <div class="body-container">
            <div class="slipImage-container">
                <h2>Slip Image</h2>
                   <?php
                   $slipImage = new paymentVerifyController();
                   $paymentId = $_GET['paymentId'];
                   $slipImage->getSlipImage($paymentId);
                   ?>
                <div class="payment-button">
                    <button id="reject-button" onclick="viewRejectPage('<?php echo $paymentId ?>')">Reject</button>
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

            <div class="slipDetails-container">
                <div class="details-student">
                    <h1>Details</h1>
                    <div class="details-table">
                        <?php
                        $object = new paymentVerifyController();
                        $details = $object->getSlipOwner($paymentId);
                        foreach ($details as $detail){
                            $userId = $detail['studentId'];
                            $name = $object->getStudentName($userId);
                            ?>
                            <p>Student full name : <?php echo $name;?></p>
                            <p>Course amount : Rs. <?php echo $detail['amount'];?></p>
                            <p>Submit date : <?php echo $detail['date'];?></p>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>
   </div>
</body>


