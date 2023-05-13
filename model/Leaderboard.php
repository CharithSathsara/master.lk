<?php

class Leaderboard
{
  public static function getmodelQuizLeaderBoard($topicId, $connection)
  {

    $select = "SELECT quiz_details.quizId, quiz_details.score, quiz_details.date, quiz_details.time, quiz_details.quizType, quiz_details.studentId, quiz_details.topicId,
    user.firstName, user.lastName, user.image
  FROM quiz_details
  INNER JOIN user
  ON quiz_details.studentId = user.userId WHERE quiz_details.topicId = '$topicId' AND quiz_details.quizType = 'MODELPAPER'   ORDER  BY quiz_details.score DESC ;";

    $data = $connection->query($select);

    // Get the number of rows in the result set
    $numRows = mysqli_num_rows($data);


    if ($numRows >= 3) {
      return $data;
    } else {
      echo "
        <div class=''>
            <p >No Details to Show!</p>
        </div>

";
    }
  }

  public static function getpastQuizLeaderBoard($topicId, $connection)
  {

    $select = "SELECT quiz_details.quizId, quiz_details.score, quiz_details.date, quiz_details.time, quiz_details.quizType, quiz_details.studentId, quiz_details.topicId,
      user.firstName, user.lastName
    FROM quiz_details
    INNER JOIN user
    ON quiz_details.studentId = user.userId WHERE quiz_details.topicId = '$topicId' AND quiz_details.quizType = 'PASTPAPER'   ORDER  BY quiz_details.score DESC ;";

    $data = $connection->query($select);
    // Get the number of rows in the result set
    $numRows = mysqli_num_rows($data);

    if ($numRows >= 3) {
      return $data;
    } else {
      echo "
        <div class='no-contents'>
            <p >No Details to Show!</p>
        </div>

";
    }
  }

  public static function getTopicId($connection, $userId)
  {

    $query = "SELECT topicId FROM leaderboard WHERE studentId = '$userId'";

    $result = $connection->query($query);

    if ($result) {
      return $result;
    } else {
      return false;
    }
  }

  public static function getRank($connection, $userId)
  {

    $query = "SELECT rank FROM leaderboard WHERE studentId = '$userId'";

    $result = $connection->query($query);

    if ($result) {
      return $result;
    } else {
      return false;
    }
  }

  public static function getAllDetails($connection, $userId)
  {

    $query = "SELECT * FROM leaderboard WHERE studentId = '$userId'";

    $result = $connection->query($query);

    if ($result) {
      return $result;
    } else {
      return false;
    }
  }
}
