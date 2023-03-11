<?php

include_once('../../config/app.php');
include('../../model/Student.php');
include('../../model/Leaderboard.php');

class LeaderBoardController{

    public $connection;

    public function __construct(){

        $db_connection = new DatabaseConnection();
        $this->connection = $db_connection->getConnection();
        

    }

    public function modelQuizLeaderBoard($topicId){
    
        $data = Leaderboard :: getmodelQuizLeaderBoard($topicId, $this->connection);
        if($data){
            return $data;
        }

    }
    
    public function pastQuizLeaderBoard($topicId){
    
        $data = Leaderboard :: getpastQuizLeaderBoard($topicId, $this->connection);
        if($data){
            return $data;
        }

    }
    
}