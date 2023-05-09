<?php
$currentDir = __DIR__;

include_once $currentDir.'\..\..\..\config\app.php';
include_once $currentDir.'\..\..\..\model\Subject.php';

    if(isset($_POST['addPhysicsDescription'])){
        $description  = validateInput($db_connection->getConnection(), $_POST['physicsDescription']);
        $price  = validateInput($db_connection->getConnection(), $_POST['physicsName']);

        if(empty(trim($description))){
            unset($_POST['addPhysicsDescription']);
            $_SESSION['add-physicsDescription'] = "Description is required";

            redirect("",'view/admin/systemInfo/systemInformation.php');
        }else if(empty(trim($price))){
            unset($_POST['addPhysicsDescription']);
            $_SESSION['add-physicsDescription'] = "Price is required";

            redirect("",'view/admin/systemInfo/systemInformation.php');
        }else{

            $result = Subject::AddDescription($db_connection->getConnection(),1,$description,$price);

            if($result){
                header('Location: ../../../view/admin/systemInfo/systemInformation.php');
            }else{
                header('Location: ../../../view/admin/systemInfo/systemInformation.php');
            }
        }
    }

    if(isset($_POST['addChemistryDescription'])){

        $description  = validateInput($db_connection->getConnection(), $_POST['ChemistryDescription']);
        $price  = validateInput($db_connection->getConnection(), $_POST['ChemistryName']);

        if(empty(trim($description))){
            unset($_POST['addChemistryDescription']);
            $_SESSION['add-ChemistryDescription'] = "Description is required";

            redirect("",'view/admin/systemInfo/systemInformation.php');
        }else if(empty(trim($price))){
            unset($_POST['addChemistryDescription']);
            $_SESSION['add-ChemistryDescription'] = "Price is required";

            redirect("",'view/admin/systemInfo/systemInformation.php');
        }else{

            $result = Subject::AddDescription($db_connection->getConnection(),2,$description,$price);

            if($result){
                header('Location: ../../../view/admin/systemInfo/systemInformation.php');
            }else{
                header('Location: ../../../view/admin/systemInfo/systemInformation.php');
            }
        }
    }

?>