<?php

include('../../../config/app.php');
include('../../../model/Topic.php');

class StudentForumController {

    public $connection;

    public function __construct(){

        $db_connection = new DatabaseConnection();
        $this->connection = $db_connection->getConnection();

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

    public function getUserName($userId){

        try {
            $data = User::getUserName($this->connection, $userId);

            if($data){
                return $data;
            }else{
                throw new Exception("Error: can not get user name for userId : $userId");
            }
        } catch(Exception $e) {
            $errorMessage = "An error occurred while getting user name :  " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

}

?>