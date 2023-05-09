<?php
$currentDir = __DIR__;

include_once $currentDir.'\..\..\..\config\app.php';
include_once $currentDir.'\..\..\..\model\instituteDetails.php';


if(isset($_POST['UpdateInstitute-button'])){

    $instituteName = validateInput($db_connection->getConnection(), $_POST['instituteName']);
    $email = validateInput($db_connection->getConnection(),$_POST['email']);
    $number = validateInput($db_connection->getConnection(),$_POST['Number']);
    $fax = validateInput($db_connection->getConnection(),$_POST['fax']);
    $address01 = validateInput($db_connection->getConnection(),$_POST['address01']);
    $address02 = validateInput($db_connection->getConnection(),$_POST['address02']);


    $_SESSION['institute']['name'] = $instituteName;
    $_SESSION['institute']['email'] = $email;
    $_SESSION['institute']['Number'] = $number;
    $_SESSION['institute']['fax'] = $fax;
    $_SESSION['institute']['address01'] = $address01;
    $_SESSION['institute']['address02'] = $address02;

    $numberArray = str_split($number);
    $faxArray = str_split($fax);

    if(empty(trim(($instituteName)))){
        unset($_POST['UpdateInstitute-button']);
        $_SESSION['Update-institute'] = "Institute name is required";

        redirect("",'view/admin/systemInfo/systemInformation.php');
    }else if(empty(trim(($email)))){
        unset($_POST['UpdateInstitute-button']);
        $_SESSION['Update-institute'] = "Institute email is required";

        redirect("",'view/admin/systemInfo/systemInformation.php');
    }else if(empty(trim(($number)))){
        unset($_POST['UpdateInstitute-button']);
        $_SESSION['Update-institute'] = "Institute number is required";

        redirect("",'view/admin/systemInfo/systemInformation.php');
    }else if(empty(trim(($fax)))){
        unset($_POST['UpdateInstitute-button']);
        $_SESSION['Update-institute'] = "Institute fax is required";

        redirect("",'view/admin/systemInfo/systemInformation.php');
    }else if(empty(trim(($address01)))){
        unset($_POST['UpdateInstitute-button']);
        $_SESSION['Update-institute'] = "Institute address 01 is required";

        redirect("",'view/admin/systemInfo/systemInformation.php');
    }else if(empty(trim(($address02)))){
        unset($_POST['UpdateInstitute-button']);
        $_SESSION['Update-institute'] = "Institute address 02 is required";

        redirect("",'view/admin/systemInfo/systemInformation.php');
    }else if(strlen($number)!= 10) {
        unset($_POST['UpdateInstitute-button']);
        $_SESSION['Update-institute'] = "should be include 10 numbers";

        redirect("", 'view/admin/systemInfo/systemInformation.php');
    }else if(!is_numeric($number)) {
        unset($_POST['UpdateInstitute-button']);
        $_SESSION['Update-institute'] = "should be include numbers only";

        redirect("", 'view/admin/systemInfo/systemInformation.php');
    }else if(!$numberArray[0]==0) {
        unset($_POST['UpdateInstitute-button']);
        $_SESSION['Update-institute'] = "should be include valid numbers only";

        redirect("", 'view/admin/systemInfo/systemInformation.php');
    }else if(strlen($fax)!= 10) {
        unset($_POST['UpdateInstitute-button']);
        $_SESSION['Update-institute'] = "should be include 10 numbers";

        redirect("", 'view/admin/systemInfo/systemInformation.php');
    }else if(!is_numeric($fax)) {
        unset($_POST['UpdateInstitute-button']);
        $_SESSION['Update-institute'] = "should be include numbers only";

        redirect("", 'view/admin/systemInfo/systemInformation.php');
    }else if(!$faxArray[0]==0) {
        unset($_POST['UpdateInstitute-button']);
        $_SESSION['Update-institute'] = "should be include valid number only";

        redirect("", 'view/admin/systemInfo/systemInformation.php');
    }else{

        $result = instituteDetails::updateInstituteDetails($db_connection->getConnection(),$instituteName,$number,$email,$fax,$address01,$address02);

        if ($result){
            header('Location: ../../../view/admin/systemInfo/systemInformation.php');
        }
        else{
            header('Location: ../../../view/admin/systemInfo/systemInformation.php');
        }
    }
}


?>