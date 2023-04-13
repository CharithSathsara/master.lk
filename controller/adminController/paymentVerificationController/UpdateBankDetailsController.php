<?php
$currentDir = __DIR__;


include_once $currentDir.'\..\..\..\config\app.php';
include_once('../../../model/BankDetails.php');


    if(isset($_POST['Save-BankButton'])){
        $AccountNumber  = validateInput($db_connection->getConnection(),$_POST['AccountNumber']);
        $HolderName  = validateInput($db_connection->getConnection(),$_POST['HolderName']);
        $BankName  = validateInput($db_connection->getConnection(),$_POST['BankName']);
        $BranchName  = validateInput($db_connection->getConnection(),$_POST['BranchName']);

        $result = BankDetails::updateBankDetails($db_connection->getConnection(),$AccountNumber,$HolderName,$BankName,$BranchName);

        if($result){
            header("Location: ../../../view/admin/payment/paymentVerification.php?ms=1");
        }else{
            header("Location: ../../../view/admin/payment/paymentVerification.php?ms=0");
        }

    }
?>
