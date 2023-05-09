<?php
$currentDir = __DIR__;


include_once $currentDir.'\..\..\..\config\app.php';
include_once('../../../model/BankDetails.php');


if(isset($_POST['update-BankButton'])) {
    $AccountNumber = validateInput($db_connection->getConnection(), $_POST['AccountNumber']);
    $HolderName = validateInput($db_connection->getConnection(), $_POST['HolderName']);
    $BankName = validateInput($db_connection->getConnection(), $_POST['BankName']);
    $BranchName = validateInput($db_connection->getConnection(), $_POST['BranchName']);


    if (empty(trim(($AccountNumber)))) {
        unset($_POST['update-BankButton']);
        $_SESSION['update-bank'] = "Account Number is required";

        redirect("", 'view/admin/systemInfo/systemInformation.php');
    } else if (empty(trim($HolderName))) {
        unset($_POST['update-BankButton']);
        $_SESSION['update-bank'] = "Holder Name is required";

        redirect("", 'view/admin/systemInfo/systemInformation.php');
    } else if (empty(trim($BankName))) {
        unset($_POST['update-BankButton']);
        $_SESSION['update-bank'] = "Bank Name is required";

        redirect("", 'view/admin/systemInfo/systemInformation.php');
    } else if (empty(trim($BranchName))) {
        unset($_POST['update-BankButton']);
        $_SESSION['update-bank'] = "Branch Name is required";

        redirect("", 'view/admin/systemInfo/systemInformation.php');
    } else if (!is_numeric($AccountNumber)) {
        unset($_POST['update-BankButton']);
        $_SESSION['update-bank'] = "Please enter valid Account number";

        redirect("", 'view/admin/systemInfo/systemInformation.php');
    } else {

        $result = BankDetails::updateBankDetails($db_connection->getConnection(), $AccountNumber, $HolderName, $BankName, $BranchName);

        if ($result) {
            header('Location: ../../../view/admin/systemInfo/systemInformation.php');
        } else {
            header('Location: ../../../view/admin/systemInfo/systemInformation.php');
        }

    }
}
?>
