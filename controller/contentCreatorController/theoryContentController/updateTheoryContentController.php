<?php

include('../../../config/app.php');
include_once('../../../model/ContentCreator.php');

if(isset($_POST['update-btn'])){

    $visibility = validateInput($db_connection->getConnection(), $_POST['radio-visibility']);
    $sectionContent = validateInput($db_connection->getConnection(), $_POST['editor2']);
    

    $data = ContentCreator::UpdateTheoryContents($_SESSION['contentId'], $sectionContent, $visibility, $db_connection->getConnection());
    
}

    if($data){
        redirect("Theory Content Added Successfully","view/contentcreator/contentCreatorDashboard.php");
        
    }else{ 
        redirect("Something Went Wrong while Adding the Theory Content","view/contentcreator/updateTheory.php");
    }



?>