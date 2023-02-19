<?php

<<<<<<< HEAD
class Teacher {

    /**
     * Author:
     * @author Charith Sathsara
     */
    public static function addQuestion($question, $answer1, $answer2, $answer3, $answer4, $answer5,
                                       $correctAnswer, $answerDescription, $type, $subject, $topicId, $teacherId, $connection){

        try {
            $query = "INSERT INTO `question` (`questionId`, `question`, `opt01`, `opt02`, `opt03`, `opt04`, `opt05`, 
=======
class Teacher{

    public static function addQuestion($question, $answer1, $answer2, $answer3, $answer4, $answer5,
                                       $correctAnswer, $answerDescription, $type, $subject, $topicId, $teacherId, $connection){

        $query = "INSERT INTO `question` (`questionId`, `question`, `opt01`, `opt02`, `opt03`, `opt04`, `opt05`, 
>>>>>>> origin/master
                                          `correctAnswer`, `answerDescription`, `questionType`, `topicId`, `teacherId`, `subjectId`) 
                  VALUES (NULL, '$question', '$answer1', '$answer2', '$answer3', '$answer4', '$answer5', $correctAnswer, 
                          '$answerDescription', '$type', 
                          $topicId, 
                          $teacherId,
                          (SELECT subjectId From subject WHERE subjectTitle = '$subject'))";
<<<<<<< HEAD

            $data = $connection->query($query);

            if($data){
                return $data;
            }else{
                throw new Exception("Error: Unable to add question");
            }
        } catch(Exception $e) {
            $errorMessage = "An error occurred while adding question: " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

    public static function deleteQuestion($connection, $question_id){

        try {
            $query = "DELETE FROM question WHERE questionId = $question_id";
            $data = $connection->query($query);

            if($data){
                return $data;
            }else{
                throw new Exception("Error: Unable to delete question");
            }
        } catch(Exception $e) {
            $errorMessage = "An error occurred while delete question: " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }
    }

    public static function updateQuestion($connection, $questionId, $question, $answer1, $answer2, $answer3, $answer4, $answer5,
                                          $correctAnswer, $answerDescription){

        try {
            $query = "UPDATE question
                      SET question = '$question', opt01 = '$answer1', opt02 = '$answer2', opt03 = '$answer3', opt04 = '$answer4', 
                          opt05= '$answer5', correctAnswer = '$correctAnswer', answerDescription = '$answerDescription'
                      WHERE questionId = $questionId";

            $data = $connection->query($query);

            if($data){
                return $data;
            }else{
                throw new Exception("Error: Unable to update question");
            }

        } catch (Exception $e) {
            $errorMessage = "Error updating a question: " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }
=======
        $data = $connection->query($query);

        return $data;
>>>>>>> origin/master

    }

    public static function viewQuestions($connection, $subject, $topic, $type){

<<<<<<< HEAD
        try {
            $query = "SELECT * FROM question WHERE subjectId = (SELECT subjectId From subject WHERE subjectTitle = '$subject') 
                                         AND topicId = (SELECT topicId From topic WHERE topicTitle = '$topic') 
                                         AND questionType = '$type'";

            $data = $connection->query($query);

            if($data){
                return $data;
            }else{
                throw new Exception("Error: Unable to view questions");
            }

        } catch (Exception $e) {
            $errorMessage = "Error viewing questions: " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }
=======
        $query = "SELECT * FROM question WHERE subjectId = (SELECT subjectId From subject WHERE subjectTitle = '$subject') 
                                         AND topicId = (SELECT topicId From topic WHERE topicTitle = '$topic') 
                                         AND questionType = '$type'";

        $data = $connection->query($query);

        return $data;
>>>>>>> origin/master

    }

    public static function getTeacherSubject($connection, $teacherId){

<<<<<<< HEAD
        try {
            $query = "SELECT subjectTitle FROM subject WHERE subjectId = (SELECT subjectId FROM teacher WHERE teacherId = $teacherId)";
            $data = $connection->query($query);
            $subject = $data->fetch_assoc();

            if($subject){
                return $subject['subjectTitle'];
            }else{
                throw new Exception("Error: Unable to get teacher subject");
            }

        } catch (Exception $e) {
            $errorMessage = "Error getting teacher subject: " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

    public static function getAllStudents($connection){

        try {
            $query = "SELECT * FROM user WHERE userType = 'STUDENT'";
            $data = $connection->query($query);

            if($data){
                return $data;
            }else{
                throw new Exception("Error: Unable to get all students");
            }

        } catch (Exception $e) {
            $errorMessage = "Error getting all students: " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

    public static function getStudentSubjects($connection, $studentId){

        try {
            $query = "SELECT * FROM student_subject WHERE studentId = $studentId";
            $data = $connection->query($query);

            if($data){
                return $data;
            }else{
                throw new Exception("Error: Unable to get student subjects:");
            }

        } catch (Exception $e) {
            $errorMessage = "An error occurred while fetching student subjects: " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

    public static function getAllFeedbacks($connection){

        try {
            $query = "SELECT * FROM feedback";
            $data = $connection->query($query);

            if($data){
                return $data;
            }else{
                throw new Exception("Error: Unable to get student feedbacks");
            }

        } catch (Exception $e) {
            $errorMessage = "An error occurred while fetching student feedbacks: " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
=======
        $query = "SELECT subjectTitle FROM subject WHERE subjectId = (SELECT subjectId FROM teacher WHERE teacherId = $teacherId)";

        $data = $connection->query($query);
        $subject = $data->fetch_assoc();

        if($subject){
            return $subject['subjectTitle'];
        }else{
>>>>>>> origin/master
            return false;
        }

    }
<<<<<<< HEAD
    /**
     * End of
     * @author Charith Sathsara section
     */
=======
>>>>>>> origin/master

}