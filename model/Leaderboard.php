<?php

class Leaderboard{
public static function getmodelQuizLeaderBoard($topicId, $connection){
$data = "SELECT contentId , content FROM  topic_content WHERE contentId = '$topicId'; ";

if($data){
return $data;
}
}
}
?>