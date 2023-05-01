<?php

include('../../../config/app.php');
include_once('../../../model/ContentCreator.php');

if(isset($_POST['update-btn'])){
    $id = $_GET['id'];
    $visibility = validateInput($db_connection->getConnection(), $_POST['radio-visibility']);
    $sectionContent = validateInput($db_connection->getConnection(), $_POST['editor2']);
    

    $data = ContentCreator::UpdateTheoryContents($id, $sectionContent, $visibility, $db_connection->getConnection());
    
}

    if($data){
        $_SESSION['update_successful'] = true;
        redirect("Theory Content Added Successfully","view/contentcreator/contentCreatorDashboard.php");
        
    }else{ 
        redirect("Something Went Wrong while Adding the Theory Content","view/contentcreator/updateTheory.php");
    }



?>