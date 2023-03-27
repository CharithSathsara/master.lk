<?php
$currentDir = __DIR__;

include_once $currentDir.'\..\..\..\config\app.php';
include_once $currentDir.'\..\..\..\model\contentCreator.php';

    if(isset($_POST['DeleteCreator-btn'])){
        $userId = validateInput($db_connection->getConnection(),$_POST['userId']);

        $data = contentCreator::deleteContentCreator($userId,$db_connection->getConnection());

        if($data){
            header("Location: ../../../view/admin/adminDashboard.php");
        }else{
            header("Location: ../../../view/admin/adminDashboard.php");
        }
    }

?>
