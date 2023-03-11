<?php

class Leaderboard{
public static function getmodelQuizLeaderBoard($topicId, $connection){

$select = "SELECT quiz_details.quizId, quiz_details.score, quiz_details.date, quiz_details.time, quiz_details.quizType, quiz_details.studentId, quiz_details.topicId,
    user.firstName, user.lastName
  FROM quiz_details
  INNER JOIN user
  ON quiz_details.studentId = user.userId WHERE quiz_details.topicId = '$topicId' AND quiz_details.quizType = 'MODELPAPER'   ORDER  BY quiz_details.score DESC ;";
  
$data = $connection->query($select);


if($data){
return $data;
}
}

public static function getpastQuizLeaderBoard($topicId, $connection){

  $select = "SELECT quiz_details.quizId, quiz_details.score, quiz_details.date, quiz_details.time, quiz_details.quizType, quiz_details.studentId, quiz_details.topicId,
      user.firstName, user.lastName
    FROM quiz_details
    INNER JOIN user
    ON quiz_details.studentId = user.userId WHERE quiz_details.topicId = '$topicId' AND quiz_details.quizType = 'PASTPAPER'   ORDER  BY quiz_details.score DESC ;";
    
  $data = $connection->query($select);
  
  
  if($data){
  return $data;
  }
  }
  
}
?>