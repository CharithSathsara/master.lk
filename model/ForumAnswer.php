<?php

class ForumAnswer {

    /**
     * Author:
     * @author Charith Sathsara
     */
    public static function insertAnswer($connection, $answer_text, $question_id, $teacher_id){

        try {
            $query = "INSERT INTO `forum_answer` (`answer_text`, `date_time`, `question_id`, `teacherId`) 
                      VALUES ('$answer_text', NOW(), $question_id, $teacher_id)";
            $data = $connection->query($query);

            if($data){
                return true;
            }else{
                throw new Exception("Error: Unable to insert forum answer");
            }
        } catch (Exception $e) {
            $errorMessage = "An error occurred while inserting forum answer in insertAnswer(): " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

}