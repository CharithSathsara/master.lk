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


    <div class="access-popBox">
        <div class="accessPop">
            <div class="accessHead">
                <img src="../../../public/img/verify.png">
                <h3>Verify Payment</h3>
            </div>

            <div class="accessBody">
                <p>If you click the Verify button, an acceptance email will be sent to <br> the student. Do you want to continue?</p>
            </div>

            <div class="access-button">
                <div class="no-button">
                    <button id="close-verifyPop">No</button>
                </div>
                    <form method="post" action="<?= base_url('controller/adminController/paymentVerificationController/paymentAcceptRejectController.php') ?>">
                        <input type="hidden" name="PaymentId" id="yer-PaymentId">
                        <input type="submit" name="yesButton-pop" value="Yes, Verify" class="yesButton-pop">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>