<?php

include_once('../../../config/app.php');
include('../../../model/Quiz.php');
$questions = array();
class ModelQuizController{

    private $connection;

    public function __construct(){

        $db_connection = DatabaseConnection::getInstance();
        $this->connection = $db_connection->getConnection();
        

    }

    public function getModelQuizQuestions($topicId){
    
    $questions = Quiz::getModelQuizQuestions($topicId, $this->connection);
        
            
    if($questions){
        return $questions;
    }

}

}

?>