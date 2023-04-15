<?php

include('../../config/app.php');
include('../../model/ContentCreator.php');
include('../../model/Topic.php');

class ViewTheoryContentController{

    private $connection;

    public function __construct(){

        $db_connection = DatabaseConnection::getInstance();
        $this->connection = $db_connection->getConnection();
        $_SESSION['subject'] = ContentCreator::getContentCreatorSubject($this->connection, $_SESSION['auth_user']['userId']);

    }

    public function viewTheoryContents($topicId){
    
            $data = ContentCreator::ViewTheoryContents($topicId, $this->connection);
        if($data){
            return $data;
        }

    }
    
    public function viewGivenNoContent($sectionNo){
        $data = ContentCreator::ViewToUpdateTheoryContents($sectionNo, $this->connection);
        if($data){
            return $data;
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

    public function getAllLessons($subject){
    
            $data = Lesson::getAllLessons($this->connection, $subject);

            if($data){
                return $data;
            }
        }

}

?>