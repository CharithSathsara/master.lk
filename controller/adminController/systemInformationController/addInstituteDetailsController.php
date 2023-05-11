<?php
$currentDir = __DIR__;

include_once $currentDir.'\..\..\..\config\app.php';
include_once $currentDir.'\..\..\..\model\instituteDetails.php';


    if(isset($_POST['addInstitute-button'])){

        $instituteName = validateInput($db_connection->getConnection(), $_POST['instituteName']);
        $email = validateInput($db_connection->getConnection(),$_POST['email']);
        $number = validateInput($db_connection->getConnection(),$_POST['Number']);
        $fax = validateInput($db_connection->getConnection(),$_POST['fax']);
        $address01 = validateInput($db_connection->getConnection(),$_POST['address01']);
        $address02 = validateInput($db_connection->getConnection(),$_POST['address02']);

        $numberArray = str_split($number);
        $faxArray = str_split($fax);

        if(empty(trim(($instituteName)))){
            unset($_POST['addInstitute-button']);
            $_SESSION['add-institute'] = "Institute name is required";

            redirect("",'view/admin/systemInfo/systemInformation.php');
        }else if(empty(trim(($email)))){
            unset($_POST['addInstitute-button']);
            $_SESSION['add-institute'] = "Institute email is required";

            redirect("",'view/admin/systemInfo/systemInformation.php');
        }else if(empty(trim(($number)))){
            unset($_POST['addInstitute-button']);
            $_SESSION['add-institute'] = "Institute number is required";

            redirect("",'view/admin/systemInfo/systemInformation.php');
        }else if(empty(trim(($fax)))){
            unset($_POST['addInstitute-button']);
            $_SESSION['add-institute'] = "Institute fax is required";

            redirect("",'view/admin/systemInfo/systemInformation.php');
        }
//        else if(empty(trim(($address01)))){
//            unset($_POST['addInstitute-button']);
//            $_SESSION['add-institute'] = "Institute address 01 is required";
//
//            redirect("",'view/admin/systemInfo/systemInformation.php');
//        }else if(empty(trim(($address02)))){
//            unset($_POST['addInstitute-button']);
//            $_SESSION['add-institute'] = "Institute address 02 is required";
//
//            redirect("",'view/admin/systemInfo/systemInformation.php');
//        }
        else if(strlen($number)!= 10) {
            unset($_POST['addInstitute-button']);
            $_SESSION['add-institute'] = "should be include 10 numbers";

            redirect("", 'view/admin/systemInfo/systemInformation.php');
        }else if(!is_numeric($number)) {
            unset($_POST['addInstitute-button']);
            $_SESSION['add-institute'] = "should be include numbers only";

            redirect("", 'view/admin/systemInfo/systemInformation.php');
        }else if(strlen($fax)!= 10) {
            unset($_POST['addInstitute-button']);
            $_SESSION['add-institute'] = "should be include 10 numbers";

            redirect("", 'view/admin/systemInfo/systemInformation.php');
        }else if(!is_numeric($fax)) {
            unset($_POST['addInstitute-button']);
            $_SESSION['add-institute'] = "should be include numbers only";

            redirect("", 'view/admin/systemInfo/systemInformation.php');
        }else if(!$faxArray[0]==0) {
            unset($_POST['addInstitute-button']);
            $_SESSION['add-institute'] = "should be include valid number only";

            redirect("", 'view/admin/systemInfo/systemInformation.php');
        }else if(!$numberArray[0]==0) {
            unset($_POST['addInstitute-button']);
            $_SESSION['add-institute'] = "should be include valid numbers only";

            redirect("", 'view/admin/systemInfo/systemInformation.php');
        }else{

            $result = instituteDetails::addInstituteDetails($db_connection->getConnection(),$instituteName,$number,$email,$fax,$address01,$address02);

            if ($result){
                header('Location: ../../../view/admin/systemInfo/systemInformation.php');
            }
            else{
                header('Location: ../../../view/admin/systemInfo/systemInformation.php');
            }
        }
    }


?>