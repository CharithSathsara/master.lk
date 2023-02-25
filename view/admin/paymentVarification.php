<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/paymentVerification.css">
    <title>Payments</title>
</head>
<body>
    <?php
    include_once('../../config/app.php');
    include('../../controller/adminController/paymentVerificationController/paymentVerifyController.php');
    include('../../model/Admin.php');
    include_once('../common/header.php');
    include_once ('../common/navBar-Admin.php');
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

                    <tr id="tableRow-1">
                        <td class="td-1" id="user_fullName">Janith Heshara</td>
                        <td class="td-1" id="ViewSlip"><button id="view-PaymentSlipButton">View Slip</button></td>
                        <td class="td-2" id="accept"><button id="accept-PaymentSlipButton">Accept</button></td>
                        <td class="td-2" id="reject"><button id="reject-PaymentSlipButton">Reject</button></td>
                    </tr>


                <tr id="tableRow-2">
                    <td class="td-1" id="user_fullName">Dilanka Hesara</td>
                    <td class="td-1" id="ViewSlip"><button>View Slip</button></td>
                    <td class="td-2" id="accept"><button>Accept</button></td>
                    <td class="td-2" id="reject"><button id="rejectPaymentSlipButton">Reject</button></td>
                </tr>

                <tr>
                    <td class="td-1" id="user_fullName">Rushin Sandeepane</td>
                    <td class="td-1" id="ViewSlip"><button>View Slip</button></td>
                    <td class="td-2" id="accept"><button>Accept</button></td>
                    <td class="td-2" id="reject"><button>Reject<button></td>
                </tr>

                <tr>
                    <td class="td-1" id="user_fullName">Kavindu Nadeejaya</td>
                    <td class="td-1" id="ViewSlip"><button>View Slip</button></td>
                    <td class="td-2" id="accept"><button>Accept<button></td>
                    <td class="td-2" id="reject"><button>Reject<button></td>
                </tr>
            </table>
<!--            --><?php
//                $adminPaymentVerificationController = new paymentVerifyController();
//
//            ?>

        </div>
    </div>

    <div class="access-popBox">
        <div class="accessPop">
            <div class="accessHead">
                <img src="../../public/img/verify.png">
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
                <img src="../../public/img/exclamationIcon.png">
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
                <img src="../../public/img/close.png" id="close-viewSlipButton">

            </div>

            <div class="viewSlipBody">

                <img src="../../public/img/paymentSlip.jpg">
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