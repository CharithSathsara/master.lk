<?php
$currentDir = __DIR__;

include_once $currentDir.'\..\..\..\config\app.php';
include_once $currentDir.'\..\..\..\model\BankDetails.php';


    if(isset($_POST['addBankAccount-button'])){

        $accountNumber = validateInput($db_connection->getConnection(), $_POST['AccountNumber']);
        $holderName = validateInput($db_connection->getConnection(), $_POST['HolderName']);
        $bankName = validateInput($db_connection->getConnection(), $_POST['BankName']);
        $branchName = validateInput($db_connection->getConnection(), $_POST['BranchName']);

        if(empty(trim(($accountNumber)))){
            unset($_POST['addBankAccount-button']);
            $_SESSION['add-bank'] = "Account Number is required";

            redirect("",'view/admin/systemInfo/systemInformation.php');
        }else if(empty(trim($holderName))){
            unset($_POST['addBankAccount-button']);
            $_SESSION['add-bank'] = "Holder Name is required";

            redirect("",'view/admin/systemInfo/systemInformation.php');
        }else if(empty(trim($bankName))){
            unset($_POST['addBankAccount-button']);
            $_SESSION['add-bank'] = "Bank Name is required";

            redirect("",'view/admin/systemInfo/systemInformation.php');
        }else if(empty(trim($branchName))){
            unset($_POST['addBankAccount-button']);
            $_SESSION['add-bank'] = "Branch Name is required";

            redirect("",'view/admin/systemInfo/systemInformation.php');
        }else if(!is_numeric($accountNumber)){
            unset($_POST['addBankAccount-button']);
            $_SESSION['add-bank'] = "Please enter valid Account number";

            redirect("",'view/admin/systemInfo/systemInformation.php');
        }else{

            $result = BankDetails::addBankDetails($db_connection->getConnection(),$accountNumber,$holderName,$bankName,$branchName);

            if($result){
                header('Location: ../../../view/admin/systemInfo/systemInformation.php');
            }else{
                header('Location: ../../../view/admin/systemInfo/systemInformation.php');
            }
        }

    }
?>