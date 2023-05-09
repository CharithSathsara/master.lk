<?php

include('../../../config/app.php');
include_once('../../../model/ContentCreator.php');

// Check if Section No. Already Exists
$contentId = mysqli_real_escape_string($db_connection->getConnection(), $_POST['contentId']);
$id = ContentCreator::CheckContentId($contentId, $db_connection->getConnection());

if(mysqli_num_rows($id) > 0) {
    echo 'exists'; //Return 'exists' if the content ID exists
  } else {
    echo 'not_exists'; //Return 'not_exists' if the content ID does not exist
  }



// Add Theory Content Pass Values to the Content Creator Model

if(isset($_POST['add-btn'])){

    $selectTopic = validateInput($db_connection->getConnection(), $_POST['topicId']);
    $sectionNo = validateInput($db_connection->getConnection(), $_POST['sectionNo']);
    $visibility = validateInput($db_connection->getConnection(), $_POST['radio-visibility']);
    $sectionContent = validateInput($db_connection->getConnection(), $_POST['editor1']);
   


    $data = ContentCreator::AddTheoryContents($sectionNo, $selectTopic,$sectionContent, $visibility, $_SESSION['auth_user']['userId'], $db_connection->getConnection());

    if($data){
      $_SESSION['add_successful'] = true;
        redirect("Theory Content Added Successfully","view/contentcreator/contentCreatorDashboard.php");
    }else{ 
      $_SESSION['add_unsuccessful'] = true;
        redirect("Something Went Wrong while Adding the Theory Content","view/contentcreator/addTheory.php");
    }

}

?>