<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/css/paymentVerification.css">
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

    include('../../../controller/adminController/paymentVerificationController/paymentVerifyController.php');
    include('../../../model/slipPayment.php');
    include('../../../model/Admin.php');
    include('../../../model/Student.php');
    include('../../../model/BankDetails.php');
    include_once('../../common/header.php');
    include_once('../../common/navBar-Admin.php');

    ?>

    <?php
    $bankDetails = new paymentVerifyController();
    $viewBankDetails  = $bankDetails->getBankDetails();
    ?>

    <div class="main-container">
        <div id="paymentPage">
            <div class="container-1">
                <p>Payment Verification</p>
            </div>

            <div class="container-2">
                <p>To Be Verified &nbsp;&nbsp;&nbsp;</p>
            </div>

            <div class="get-AllSlip">

                <table class="styled-table">
                    <tbody>
                        <?php
                            $paymentSlips = new paymentVerifyController();
                            $slips = $paymentSlips->getAllPaymentSlip();

                            foreach ($slips as $slip){

                                 $users = $paymentSlips->getSlipOwner($slip['paymentId']);
                                    foreach ($users as $user){

                                 $name = $paymentSlips->getStudentName($user['studentId']);
                                ?>
                        <tr>
                            <td class="td-1" id="user_fullName"><?= $name; ?></td>
                            <td class="td-2" id="user_fullName"><?= $user['date']; ?></td>
                            <td> <a href="<?=base_url('view/admin/payment/slipImage.php?paymentId='.$slip['paymentId']) ?>"><button>View Slip</button></a> </td>
                        </tr>
                        <?php   } ?>
                 <?php   } ?>

    <!--      View slip js function-->
<!--                        <script src="../../../public/js/viewSlipImage.js"></script>-->

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>