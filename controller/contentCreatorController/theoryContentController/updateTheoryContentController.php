<?php

include('../../../config/app.php');
include_once('../../../model/ContentCreator.php');


if(isset($_POST['view-btn'])){

    $sectionNo = validateInput($db_connection->getConnection(), $_POST['sectionNo']);
    

    $data = ContentCreator::ViewToUpdateTheoryContents($sectionNo, $db_connection->getConnection());
    
}

    if($data){
        redirect("Theory Content Added Successfully","view/contentcreator/contentCreatorDashboard.php");
    }else{ 
        redirect("Something Went Wrong while Adding the Theory Content","view/contentcreator/addTheory.php");
    }



?>