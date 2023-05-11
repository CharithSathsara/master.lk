<?php

include_once('../../../config/app.php');
include('../../../model/Quiz.php');



if(isset($_POST['deleteTheory-Yes-btn'])){
$deleteId = $_GET['deleteId'];
$result = ContentCreator::DeleteTheoryContents($db_connection->getConnection(), $deleteId);

if($result){
    $_SESSION['delete_successful'] = true;
    redirect("Theory Content Deleted Successfully", "view/contentcreator/contentCreatorDashboard.php");
    
    
}else{
    $_SESSION['delete_unsuccessful'] = true;
    redirect("Something Went Wrong while Deleting the Theory Content", "view/contentcreator/contentCreatorDashboard.php");
    return false;
}

}
?>
    }

    public function getModelQuizQuestions($topicId){
    
    $result = Quiz::getModelQuizQuestions($topicId, $this->connection);
        
            
    if($result){
        return $result;
    }

}

}

?>