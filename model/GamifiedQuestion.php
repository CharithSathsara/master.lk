<?php

class GamifiedQuestion {

    public static function getGamifiedQuestions($connection,$subject,$lesson,$topic){
        
        $query1 = "SELECT subjectId FROM subject WHERE subjectTitle='$subject'";
        $result1 = $connection->query($query1);
        $data_set1 = $result1->fetch_assoc();
        $subjectId = $data_set1['subjectId'];

        $query2 = "SELECT lessonId FROM lesson WHERE lessonName='$lesson' AND subjectId='$subjectId'";
        $result2 = $connection->query($query2);
        $data_set2 = $result2->fetch_assoc();
        $lessonId = $data_set2['lessonId'];

        $query3 = "SELECT topicId FROM topic WHERE topicTitle='$topic' AND lessonId='$lessonId'";
        $result3 = $connection->query($query3);
        $data_set3 = $result3->fetch_assoc();
        $topicId = $data_set3['topicId'];

        $query4 = "SELECT * FROM gamified_question WHERE lessonId='$lessonId' AND topicId='$topicId' ORDER BY questionId ASC";
        $result4 = $connection->query($query4);

        if($result4 && mysqli_num_rows($result4)>0){
            return $result4;
        }else{
            return false;
        }

        
    }



}