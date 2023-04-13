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



    <div class="Update-BankDetails">

        <div class="BankDetails-table">
            <div class="box-header">
                <p>Update Bank Details</p>
                <img src="<?= base_url('public/img/close.png') ?>" alt="close icon" class="close-icon" id="UpdateBox-closeIcon">
            </div>

            <div class="details">

                        <form method="post" class="UpdateBankForm" action="<?=base_url('controller/adminController/paymentVerificationController/UpdateBankDetailsController.php') ?>">
                            <label>Account Number</label>
                            <input type="text" name="AccountNumber" id="BankAccountNumber">
                            <label>Account Holder Name</label>
                            <input type="text" name="HolderName" id="BankHolderName">
                            <label>Bank Name</label>
                            <input type="text" name="BankName" id="BankBankName">
                            <label>Branch Name</label>
                            <input type="text" name="BranchName" id="BankBranchName">
                            <input type="submit" value="Save" name="Save-BankButton" class="Update-BankButton">

                        </form>
            </div>

    </div>
</body>
