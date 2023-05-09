<?php

class badges
{
    public static function getBadgeImage($connection,$badgeId){

        $query = "SELECT badgeImage FROM badge WHERE badgeId ='$badgeId'";

        $result = $connection->query($query);
        $row = $result->fetch_assoc();

        if($row['badgeImage']!=null){

            $to_echo = "<img id='BadgePicture' src='data:image/jpg;charset=utf8;base64,";
            $to_echo .= base64_encode($row['badgeImage']);
            $to_echo .= "'/>";
            echo $to_echo;

            return true;
        }else{
//            echo "<img id='profilePictureUsers' src='../../public/img/default-profPic.png'/>";
            return false;
        }
    }
}