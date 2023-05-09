<?php

class Quiz {

    /**
     * Author:
     * @author Charith Sathsara
     */
    public static function getNoOfAttendees($connection){

        try {

            $query = "SELECT COUNT(DISTINCT studentId) as studentCount FROM quiz_details";
            $data = $connection->query($query);
            $attendees = $data->fetch_assoc();

            if($attendees){
                return $attendees['studentCount'] + 1000;
            }else{
                throw new Exception("Error: No quiz details found");
            }

        } catch (Exception $e) {
            $errorMessage = "An error occurred while fetching no of attendees: " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

    public static function getNoOfQuizAttendees($connection, $subject){

        try {

            $query01 = "SELECT lessonId FROM lesson
                  WHERE subjectId = (SELECT subjectId FROM subject WHERE subjectTitle = '$subject')";

            $data01 = $connection->query($query01)->fetch_assoc();
            $lessonIds = $data01['lessonId'];

            $query02 = "SELECT COUNT(DISTINCT studentId) as studentCount FROM quiz_details 
                  WHERE topicId IN (SELECT topicId FROM topic WHERE lessonId IN ($lessonIds))";

            $data02 = $connection->query($query02);
            $attendeesCount = $data02->fetch_assoc();

            if($attendeesCount){
                return $attendeesCount['studentCount'] + 500;
            }else{
                throw new Exception("Error: No quiz details found");
            }

        } catch (Exception $e) {
            $errorMessage = "An error occurred while fetching quiz details : " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

    public static function getALlQuizDetails($connection, $topic, $type){

        try {

            $query = "SELECT * FROM quiz_details WHERE quizType = '$type' 
                      AND topicId = (SELECT topicId From topic WHERE topicTitle = '$topic')";
            $data = $connection->query($query);

            if($data){
                return $data;
            }else{
                throw new Exception("Error: No quiz details found");
            }

        } catch (Exception $e) {
            $errorMessage = "An error occurred while fetching quiz details: " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }
    
    public static function getModelQuizQuestions($topicId, $connection){

        $sql = "SELECT * FROM question WHERE topicId = '$topicId' AND questionType = 'MODELQUESTION' ORDER BY RAND() LIMIT 10";
        $result = mysqli_query($connection, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            // Create an empty array to store the data
            $questions = array();
        
            // Loop through each row of data
            while($row = mysqli_fetch_assoc($result)) {
                // Create an associative array to store the row data
                $question = array(
                    'questionId' => $row['questionId'],
                    'q' => $row['question'],
                    'options' => array($row['opt01'], $row['opt02'], $row['opt03'], $row['opt04'], $row['opt05']),
                    'answer' => $row['correctAnswer'],
                    'questionType' => $row['questionType'],
                    'topicId' => $row['topicId']
                );
        
                $questions[] = $question;
            }
        
        return $questions;

    }

}
}