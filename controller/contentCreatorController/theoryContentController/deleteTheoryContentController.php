<?php

include('../../../config/app.php');
require_once('../../../model/ContentCreator.php');

if(isset($_POST['deleteTheory-Yes-btn'])){

$result = ContentCreator::DeleteTheoryContents($db_connection->getConnection(), $_GET['section_no']);

if($result){
    
    redirect("Theory Content Deleted Successfully", "view/contentcreator/contentCreatorDashboard.php");
    
    
}else{
    redirect("Something Went Wrong while Deleting the Theory Content", "view/contentcreator/contentCreatorDashboard.php");
    return false;
}

}
?>