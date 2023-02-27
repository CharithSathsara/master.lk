<?php

include('../../config/app.php');
include('../../model/ContentCreator.php');
include('../../model/Topic.php');

class ViewTheoryContentController{

    public $connection;

    public function __construct(){

        $db_connection = new DatabaseConnection();
        $this->connection = $db_connection->getConnection();

    }

    public function viewTheoryContents($subject, $topic){

        try {
            $data = ContentCreator::ViewTheoryContents($this->connection, $subject, $topic);

            if($data){
                return $data;
            }else{
                throw new Exception("Error: can not get Theory Contents of $subject subject : topic $topic");
            }
        } catch(Exception $e) {
            $errorMessage = "An error occurred while getting Theory Contents of $subject subject : topic $topic " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

    public function getAllTopics($subject){

        try {
            $data = Topic::getAllTopics($this->connection, $subject);

            if($data){
                return $data;
            }else{
                throw new Exception("Error: can not get all topics of $subject subject");
            }
        } catch(Exception $e) {
            $errorMessage = "An error occurred while getting all topics:  " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }


}

?>