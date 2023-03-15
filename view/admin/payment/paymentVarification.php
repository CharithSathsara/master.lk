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

    include('../../../controller/adminController/paymentVerificationController/paymentVerifyController.php');
    include('../../../model/slipPayment.php');
    include('../../../model/Admin.php');
    include('../../../model/Student.php');
    include_once('../../common/header.php');
    include_once('../../common/navBar-Admin.php');

    ?>

    <div class="main-container">
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
                                echo "<pre>";
                                print_r($slip);
                                echo "</pre>";
                            $name = $paymentSlips->getStudentName($slip['studentId']);
                            ?>
                    <tr> <?php
                        //$name = $paymentSlips->getStudentName($slip['studentId']);
                        // echo "<pre>";
                        // print_r($name);
                        //echo "</pre>";
                    ?>
                        <td class="td-1" id="user_fullName"><?= $name; ?></td>
                        <td class="td-2" id="user_fullName"><?= $slip['date']; ?></td>
                        <td class="td-3" id="ViewSlip"><button id="view-PaymentSlipButton">View Slip</button></td>
                        <td class="td-4" id="accept"><button id="accept-PaymentSlipButton">Accept</button></td>
                        <td class="td-5" id="reject"><button id="reject-PaymentSlipButton">Reject</button></td>
                    </tr>
             <?php   } ?>


                </tbody>
            </table>

        </div>
    </div>

    <div class="access-popBox">
        <div class="accessPop">
            <div class="accessHead">
                <img src="../../../public/img/verify.png">
                <h4>Verify Payment</h4>
            </div>

            <div class="accessBody">
                <p>If you click the Verify button, an acceptance email will be sent to <br> the student. Do you want to continue?</p>
            </div>

            <div class="access-button">
                <div class="no-button">
                    <button id="close-verifyPop">No</button>
                </div>

                <div class="yes-button">
                    <button id="yesButton-pop">Yes, Verify</button>
                </div>
            </div>
        </div>
    </div>


    <div class="reject-popBox">
        <div class="rejectPop">
            <div class="rejectHead">
                <img src="../../../public/img/exclamationIcon.png">
                <h4>Reject Payment</h4>
            </div>

            <div class="rejectBody">
                <p>If you click the Reject button, a rejection email will be sent to  <br> the student. Do you want to continue?</p>
            </div>

            <div class="reject-button">
                <div class="no-button">
                    <button id="close-rejectPop">No</button>
                </div>

                <div class="yes-button">
                    <button id="rejectYesPop">Yes, Reject</button>
                </div>
            </div>
        </div>
    </div>

<!--    view payment slip-->
    <div class="viewSlip-popBox">
        <div class="viewSlipPop">
            <div class="viewSlipHead">
                <h4>Payment Slip</h4>
                <img src="../../../public/img/close.png" id="close-viewSlipButton">

            </div>

            <div class="viewSlipBody">

                <img src="../../../public/img/paymentSlip.jpg">
            </div>
        </div>
    </div>



<!--verify slip popup js script-->

    <script>
        document.getElementById("accept-PaymentSlipButton").addEventListener("click",function (){
            document.querySelector(".access-popBox").style.display ="flex";
        })

        document.getElementById("close-verifyPop").addEventListener("click",function (){
            document.querySelector(".access-popBox").style.display ="none";
        })

        document.getElementById("yesButton-pop").addEventListener("click",function (){
            document.querySelector(".access-popBox").style.display = "none";
            document.getElementById("tableRow-1").style.display = "none";
        })
    </script>

<!--reject popup js script-->

    <script>
        document.getElementById("reject-PaymentSlipButton").addEventListener("click",function (){
            document.querySelector(".reject-popBox").style.display ="flex";
        })

        document.getElementById("close-rejectPop").addEventListener("click",function (){
            document.querySelector(".reject-popBox").style.display ="none";
        })
    </script>


    <script>
        document.getElementById("rejectPaymentSlipButton").addEventListener("click",function (){
            document.querySelector(".reject-popBox").style.display ="flex";
        })

        document.getElementById("close-rejectPop").addEventListener("click",function (){
            document.querySelector(".reject-popBox").style.display ="none";
        })

        document.getElementById("rejectYesPop").addEventListener("click",function (){
            document.querySelector(".reject-popBox").style.display = "none";
            document.getElementById("tableRow-2").style.display = "none";
        })


    </script>

    <!--view popup js script-->

    <script>
        document.getElementById("view-PaymentSlipButton").addEventListener("click",function (){
            document.querySelector(".viewSlip-popBox").style.display ="flex";
        })

        document.getElementById("close-viewSlipButton").addEventListener("click",function (){
            document.querySelector(".viewSlip-popBox").style.display ="none";
        })
    </script>
</body>
</html>