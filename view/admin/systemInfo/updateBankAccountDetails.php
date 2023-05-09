<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../public/css/updateBankDetails.css">

    <title>Payments</title>
</head>
<body>

    <?php
        include_once('../../../controller/authController/authentication/Authentication.php');
        include_once('../../../controller/authController/authorization/Authorization.php');

        //User Authentication
        Authentication::userAuthentication();
        //User Authorization
        Authorization::authorizingAdmin();
    ?>

<div class="Update-BankDetails" id="Update-BankDetails">

    <div class="BankDetails-table">
        <div class="box-header">
            <p>Update Bank Details</p>
            <div class="close-updateBank">
                <button onclick="closeUpdateBankPop()"><img src="<?= base_url('public/img/close.png') ?>" alt="close icon" class="close-icon" id="UpdateBox-closeIcon"></button>
            </div>
        </div>

        <div class="details">

            <form method="post" class="UpdateBankForm" action="<?= base_url('controller/adminController/systemInformationController/updateBankAccountDetailsController.php') ?>">
                <input type="text" name="AccountNumber" id="BankAccountNumber" value="<?= $_SESSION['Bank']['AccountNumber'] ?>" >
                <input type="text" name="HolderName" id="BankHolderName" value="<?= $_SESSION['Bank']['HolderName'] ?>">
                <input type="text" name="BankName" id="BankBankName" value="<?= $_SESSION['Bank']['BankName'] ?>">
                <input type="text" name="BranchName" id="BankBranchName" value="<?= $_SESSION['Bank']['BranchName'] ?>">


                <div class="view-error">
                    <div class="error-message-update-bankDetails" id="error-message-update-bankDetails">
                        <?php include "../dashboard/validationMessage.php"?>
                    </div>
                    <input type="submit" value="Update" name="update-BankButton" class="Update-BankButton">
                </div>

            </form>
        </div>

    </div>
</div>
</body>
