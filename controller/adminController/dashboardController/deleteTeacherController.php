<?php

$currentDir = __DIR__;

include_once $currentDir.'\..\..\..\config\app.php';
include_once $currentDir.'\..\..\..\model\Teacher.php';



if(isset($_POST['DeleteTeacher-btn'])){

            $userId = validateInput($db_connection->getConnection(),$_POST['userId']);
            //$userId = $_POST['userId'];
            $result = Teacher::deleteTeacher($userId,$db_connection->getConnection());

            if($result){
                header("Location: ../../../view/admin/adminDashboard.php");
            }else{
                header("Location: ../../../view/admin/adminDashboard.php");
            }
        }
?>


