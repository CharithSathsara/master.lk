<?php

class badges
{
    public static function getBadgeImage($connection,$badgeId){

        $query = "SELECT badgeImage FROM badge WHERE badgeId ='$badgeId'";

        $result = $connection->query($query);
        $row = $result->fetch_assoc();

        if($row['badgeImage']!=null){

//            $to_echo = "<img id='BadgePicture' src='data:image/jpg;charset=utf8;base64,";
//            $to_echo .= base64_encode($row['badgeImage']);
//            $to_echo .= "'/>";
//            echo $to_echo;

            return $row['badgeImage'];
        }else{
//            echo "<img id='profilePictureUsers' src='../../public/img/default-profPic.png'/>";
            return false;
        }
    }

    public static function getAllTopics($connection){

        $query = "SELECT topicId FROM quiz_details GROUP BY topicId";

        $AllTopics = $connection->query($query);

        if($AllTopics){
            return $AllTopics;
        }else{
            return false;
        }
    }

    public static function getFirstThreeStudents($connection , $topicId){

        $query = "SELECT studentId FROM quiz_details WHERE topicId = '$topicId' ORDER BY score DESC LIMIT 3";

        $result = $connection->query($query);

        if($result){
            return $result;
        }else{
            return false;
        }
    }

}