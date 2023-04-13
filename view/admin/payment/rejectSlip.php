<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../public/css/paymentVerification.css">
    <title>Document</title>
</head>
<body>
    <div class="reject-popBox" id="reject-popBox">
        <div class="rejectPop">
            <div class="rejectHead">
                <img src="../../../public/img/exclamationIcon.png">
                <h3>Reject Payment</h3>
            </div>

            <div class="rejectBody">
                <p>If you click the Reject button, a rejection email will be sent to  <br> the student. Do you want to continue?</p>
            </div>

            <div class="reject-button">
                <div class="no-button">
                    <button id="close-rejectPop">No</button>
                </div>

                <div class="yes-button">

                    <form method="post" action="<?= base_url('controller/adminController/paymentVerificationController/paymentAcceptRejectController.php') ?>">
                        <input type="hidden" name="PaymentId" id="yer-RejectPaymentId">
                        <input type="submit" id="rejectYesPop" name="yesRejectButton-pop" value="Yes, Reject" class="rejectButton-slip">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
