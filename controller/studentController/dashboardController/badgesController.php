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

//    public function getAllDetails($userId){
//
//        $AllDetails = Leaderboard::getAllDetails($this->connection,$userId);
//        if($AllDetails){
//            $chemistryCount = 0;
//            $physicsCount = 0;
//            $physicsOne = false;
//            $physicsTwo = false;
//            $physicsThree = false;
//            $chemistryOne = false;
//            $chemistryTwo = false;
//            $chemistryThree = false;
//            foreach ($AllDetails as $allDetail){
//
//                $subject = $this->getSubjectId($allDetail['topicId']);
//
//                if($allDetail['rank']== 1 && $subject == 1 ){
//                    $physicsCount++;
//                    $physicsOne = true;
//                }else if($allDetail['rank']== 1 && $subject == 2){
//                    $chemistryCount++;
//                    $chemistryOne = true;
//                }
//                if($allDetail['rank']== 2 && $subject == 1 ){
//                    $physicsTwo = true;
//                }
//                if($allDetail['rank']== 3 && $subject == 1 ){
//                    $physicsThree = true;
//                }
//                if($allDetail['rank']== 2 && $subject == 2){
//                    $chemistryTwo = true;
//                }
//                if($allDetail['rank']== 3 && $subject == 2){
//                    $chemistryThree = true;
//                }
//            }
//
//            if($physicsCount >= 3 || $chemistryCount >= 3){
//                $badgePic = Badges::getBadgeImage($this->connection,7);
//            }
//
//            if($physicsCount >= 2 && $chemistryCount >= 2){
//                $badgePic = Badges::getBadgeImage($this->connection,8);
//            }
//
//            if($chemistryOne){
//                $badgePic = Badges::getBadgeImage($this->connection,1);
//            }else if($chemistryTwo){
//                $badgePic = Badges::getBadgeImage($this->connection,2);
//            }else if($chemistryThree){
//                $badgePic = Badges::getBadgeImage($this->connection,3);
//            }
//
//            if($physicsOne){
//                $badgePic = Badges::getBadgeImage($this->connection,4);
//            }else if($physicsTwo){
//                $badgePic = Badges::getBadgeImage($this->connection,5);
//            }else if($physicsThree){
//                $badgePic = Badges::getBadgeImage($this->connection,6);
//            }
//
////            return $badgePic;
//        }else{
//            return false;
//        }
//
//    }

    public function getBadge($rank , $subjectId){

        if($rank == 1 && $subjectId == 1){
            $badgePic = Badges::getBadgeImage($this->connection,4);

            $to_echo = "<img src='data:image/jpg;charset=utf8;base64,";
            $to_echo .= base64_encode($badgePic);
            $to_echo .= "'/>";

            return $to_echo;

        }else if($rank == 1 && $subjectId == 2){
            $badgePic = Badges::getBadgeImage($this->connection,1);

            $to_echo = "<img src='data:image/jpg;charset=utf8;base64,";
            $to_echo .= base64_encode($badgePic);
            $to_echo .= "'/>";

            return $to_echo;

        }else if($rank == 2 && $subjectId == 1){
            $badgePic = Badges::getBadgeImage($this->connection,5);

            $to_echo = "<img src='data:image/jpg;charset=utf8;base64,";
            $to_echo .= base64_encode($badgePic);
            $to_echo .= "'/>";

            return $to_echo;

        }else if($rank == 2 && $subjectId == 2){
            $badgePic = Badges::getBadgeImage($this->connection,2);

            $to_echo = "<img src='data:image/jpg;charset=utf8;base64,";
            $to_echo .= base64_encode($badgePic);
            $to_echo .= "'/>";

            return $to_echo;

        }else if($rank == 3 && $subjectId == 1){
            $badgePic = Badges::getBadgeImage($this->connection,6);

            $to_echo = "<img src='data:image/jpg;charset=utf8;base64,";
            $to_echo .= base64_encode($badgePic);
            $to_echo .= "'/>";

            return $to_echo;

        }else if($rank == 3 && $subjectId == 2){
            $badgePic = Badges::getBadgeImage($this->connection,3);

            $to_echo = "<img src='data:image/jpg;charset=utf8;base64,";
            $to_echo .= base64_encode($badgePic);
            $to_echo .= "'/>";

            return $to_echo;
        }
    }

    public function specialOne(){
        $badgePic = Badges::getBadgeImage($this->connection,8);

        $to_echo = "<img src='data:image/jpg;charset=utf8;base64,";
        $to_echo .= base64_encode($badgePic);
        $to_echo .= "'/>";

//        return $to_echo;
        echo $to_echo;
    }

    public function specialTwo(){
        $badgePic = Badges::getBadgeImage($this->connection,7);

        $to_echo = "<img src='data:image/jpg;charset=utf8;base64,";
        $to_echo .= base64_encode($badgePic);
        $to_echo .= "'/>";

//        return $to_echo;
        echo $to_echo;
    }

    public function getTopic($topicId){

        $topic = Topic::getTopicTitle($this->connection,$topicId);

        if ($topic){
            return $topic;
        }else{
            return false;
        }
    }

    public function getAllTopicId(){

        $allTopics = Badges::getAllTopics($this->connection);

        if($allTopics){
            return $allTopics;
        }
    }

    public function getThreeStudents($topicId){

        $allThreeStudent = Badges::getFirstThreeStudents($this->connection,$topicId);

        if($allThreeStudent){


            return $allThreeStudent;
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