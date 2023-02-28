<?php

include('../../../config/app.php');
require_once('../../../model/ContentCreator.php');

$sectionNo = validateInput($db_connection->getConnection(), $_GET['section_no']);

$result = ContentCreator::DeleteTheoryContents($db_connection->getConnection(), $section_no);

if($result){
    redirect("Theory Content Deleted Successfully", "view/teacher/teacherDashboard.php");
}else{
    redirect("Something Went Wrong while Deleting the Theory Content", "view/teacher/teacherDashboard.php");
    return false;
}

?>