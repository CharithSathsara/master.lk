<?php
$currentDir = __DIR__;

include_once $currentDir.'\..\..\..\config\app.php';
include_once $currentDir.'\..\..\..\model\Subject.php';

if(isset($_POST['updatePhysicsDescription'])){
    $description  = validateInput($db_connection->getConnection(), $_POST['physicsDescription']);
    $price  = validateInput($db_connection->getConnection(), $_POST['physicsName']);

    if(empty(trim($description))){
        unset($_POST['updatePhysicsDescription']);
        $_SESSION['update-physicsDescription'] = "Description is required";

        redirect("",'view/admin/systemInfo/systemInformation.php');
    }else if(empty(trim($price))){
        unset($_POST['updatePhysicsDescription']);
        $_SESSION['update-physicsDescription'] = "Price is required";

        redirect("",'view/admin/systemInfo/systemInformation.php');
    }else{

        $result = Subject::updateSubjectDescription($db_connection->getConnection(),1,$description,$price);

        if($result){
            header('Location: ../../../view/admin/systemInfo/systemInformation.php');
        }else{
            header('Location: ../../../view/admin/systemInfo/systemInformation.php');
        }
    }
}

if(isset($_POST['updateChemistryDescription'])){

    $description  = validateInput($db_connection->getConnection(), $_POST['ChemistryDescription']);
    $price  = validateInput($db_connection->getConnection(), $_POST['ChemistryName']);

    if(empty(trim($description))){
        unset($_POST['updateChemistryDescription']);
        $_SESSION['update-ChemistryDescription'] = "Description is required";

        redirect("",'view/admin/systemInfo/systemInformation.php');
    }else if(empty(trim($price))){
        unset($_POST['updateChemistryDescription']);
        $_SESSION['update-ChemistryDescription'] = "Price is required";

        redirect("",'view/admin/systemInfo/systemInformation.php');
    }else{

        $result = Subject::updateSubjectDescription($db_connection->getConnection(),2,$description,$price);

        if($result){
            header('Location: ../../../view/admin/systemInfo/systemInformation.php');
        }else{
            header('Location: ../../../view/admin/systemInfo/systemInformation.php');
        }
    }
}

?>