<?php

include('../../../config/app.php');
include_once('../../../model/ContentCreator.php');


if(isset($_POST['add-btn'])){

    $selectTopic = validateInput($db_connection->getConnection(), $_POST['selectTopic']);
    $sectionNo = validateInput($db_connection->getConnection(), $_POST['sectionNo']);
    $visibility = validateInput($db_connection->getConnection(), $_POST['radio-visibility']);
    $sectionContent = validateInput($db_connection->getConnection(), $_POST['sectionContent']);
   


    $data = ContentCreator::AddTheoryContents($selectTopic, $sectionNo, $visibility, $sectionContent, $_SESSION['auth_user']['userId'], $db_connection->getConnection());

    if($data){
        redirect("Theory Content Added Successfully","../../../view/contentcreator/contentCreatorDashboard.php");
    }else{
        redirect("Something Went Wrong while Adding the Theory Content","../../../view/contentcreator/addTheory.php");
    }

}

?>