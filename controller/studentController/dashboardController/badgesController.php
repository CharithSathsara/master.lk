<?php

//$currentDir = __DIR__;
//
//include_once $currentDir.'\..\..\..\config\app.php';

//include_once ('../../../model/Leaderboard.php');

class badgesController
{
    private $connection;

    public function __construct(){

        $db_connection = DatabaseConnection::getInstance();
        $this->connection = $db_connection->getConnection();

    }

//    public function getTopicId($userId){
//
//        $topicId = Leaderboard::getTopicId($this->connection,$userId);
//        if($topicId){
//            return $topicId;
//        }else{
//            return false;
//        }
//
//    }

    public function getAllDetails($userId){

        $AllDetails = Leaderboard::getAllDetails($this->connection,$userId);
        if($AllDetails){
            $chemistryCount = 0;
            $physicsCount = 0;
            $physicsOne = false;
            $physicsTwo = false;
            $physicsThree = false;
            $chemistryOne = false;
            $chemistryTwo = false;
            $chemistryThree = false;
            foreach ($AllDetails as $allDetail){

                $subject = $this->getSubjectId($allDetail['topicId']);

                if($allDetail['rank']== 1 && $subject == 1 ){
                    $physicsCount++;
                    $physicsOne = true;
                }else if($allDetail['rank']== 1 && $subject == 2){
                    $chemistryCount++;
                    $chemistryOne = true;
                }
                if($allDetail['rank']== 2 && $subject == 1 ){
                    $physicsTwo = true;
                }
                if($allDetail['rank']== 3 && $subject == 1 ){
                    $physicsThree = true;
                }
                if($allDetail['rank']== 2 && $subject == 2){
                    $chemistryTwo = true;
                }
                if($allDetail['rank']== 3 && $subject == 2){
                    $chemistryThree = true;
                }
            }

            if($physicsCount >= 3 || $chemistryCount >= 3){
                $badgePic = Badges::getBadgeImage($this->connection,7);
            }

            if($physicsCount >= 2 && $chemistryCount >= 2){
                $badgePic = Badges::getBadgeImage($this->connection,8);
            }

            if($chemistryOne){
                $badgePic = Badges::getBadgeImage($this->connection,1);
            }else if($chemistryTwo){
                $badgePic = Badges::getBadgeImage($this->connection,2);
            }else if($chemistryThree){
                $badgePic = Badges::getBadgeImage($this->connection,3);
            }

            if($physicsOne){
                $badgePic = Badges::getBadgeImage($this->connection,4);
            }else if($physicsTwo){
                $badgePic = Badges::getBadgeImage($this->connection,5);
            }else if($physicsThree){
                $badgePic = Badges::getBadgeImage($this->connection,6);
            }

//            return $badgePic;
        }else{
            return false;
        }

    }

//    public function getRank($userId){
//
//        $rank = Leaderboard::getRank($this->connection,$userId);
//
//        return $rank;
//    }

    public function getSubjectId($topicId){

        $subjectId = Subject::getSubjectID($this->connection,$topicId);

        if($subjectId){
            return $subjectId;
        }else{
            return false;
        }
    }

}