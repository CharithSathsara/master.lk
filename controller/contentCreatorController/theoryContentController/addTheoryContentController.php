<?php

include('../../../config/app.php');
include_once('../../../model/ContentCreator.php');


if(isset($_POST['add-btn'])){

    $selectTopic = validateInput($db_connection->getConnection(), $_POST['topicId']);
    $sectionNo = validateInput($db_connection->getConnection(), $_POST['sectionNo']);
    $visibility = validateInput($db_connection->getConnection(), $_POST['radio-visibility']);
    $sectionContent = validateInput($db_connection->getConnection(), $_POST['editor1']);
   


    $data = ContentCreator::AddTheoryContents($sectionNo, $selectTopic,$sectionContent, $visibility, $_SESSION['auth_user']['userId'], $db_connection->getConnection());

    if($data){
        redirect("Theory Content Added Successfully","view/contentcreator/contentCreatorDashboard.php");
    }else{ 
        redirect("Something Went Wrong while Adding the Theory Content","view/contentcreator/addTheory.php");
    }

}

?>