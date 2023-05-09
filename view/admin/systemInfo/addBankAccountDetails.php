<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../public/css/addBankAccountDetails.css">
    <title>Add Bank Account</title>
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
    <div class="mainDiv-addBank" id="mainDiv-addBank">
        <div class="addBank-section">
            <div class="addBank-header">
                <p>Add Bank Account Details</p>
                <div class="addPop-close">
                    <button onclick="closeAddBankPop()"><img src="../../../public/img/close.png" ></button>
                </div>
            </div>

            <div class="addBankDetails-form">
                    <form class="addBankAccount-form" method="post" action="<?= base_url('controller/adminController/systemInformationController/addBankDetailsController.php'); ?>">
                        <input type="text" name="AccountNumber" placeholder="  Account Number">
                        <input type="text" name="HolderName" placeholder="  Holder Name">
                        <input type="text" name="BankName" placeholder="  Bank Name">
                        <input type="text" name="BranchName" placeholder="  Branch Name">

                        <div class="display-error">
                            <div class="error-message-add-bankAccount" id="error-message-add-bankAccount">
                                <?php include "../dashboard/validationMessage.php"?>
                            </div>
                            <div class="addBankDetails-submit">
                                <input type="submit" name="addBankAccount-button" value="Save">
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</body>
</html>
