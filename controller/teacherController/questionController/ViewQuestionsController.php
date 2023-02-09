<?php

include('../../../config/app.php');
include('../../../model/Teacher.php');
include('../../../model/Topic.php');

class ViewQuestionsController{

    public $connection;

    public function __construct(){

        $db_connection = new DatabaseConnection();
        $this->connection = $db_connection->getConnection();

    }

    public function viewQuestions($subject, $topic, $type){

        $data = Teacher::viewQuestions($this->connection, $subject, $topic, $type);

        if($data){
            return $data;
        }else{
            return false;
        }

    }

    public function getAllTopics($subject){

        $data = Topic::getAllTopics($this->connection, $subject);

        if($data){
            return $data;
        }

    }


}

?>