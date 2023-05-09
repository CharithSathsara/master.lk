<?php

class Teacher {

    /**
     * Author:
     * @author Charith Sathsara
     */
    public static function addQuestion($question, $answer1, $answer2, $answer3, $answer4, $answer5,
                                       $correctAnswer, $answerDescription, $type, $subject, $topicId, $teacherId, $connection){

        try {
            $query = "INSERT INTO `question` (`questionId`, `question`, `opt01`, `opt02`, `opt03`, `opt04`, `opt05`, 
                                          `correctAnswer`, `answerDescription`, `questionType`, `topicId`, `teacherId`, `subjectId`) 
                  VALUES (NULL, '$question', '$answer1', '$answer2', '$answer3', '$answer4', '$answer5', $correctAnswer, 
                          '$answerDescription', '$type', 
                          $topicId, 
                          $teacherId,
                          (SELECT subjectId From subject WHERE subjectTitle = '$subject'))";

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

    }

    public static function viewQuestions($connection, $subject, $topic, $type){

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

    }

    public static function getTeacherSubject($connection, $teacherId){

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

    public static function getAllStudents($connection, $search){

        try {
            $query = "SELECT * FROM user WHERE userType = 'STUDENT'";

            // Add a filter if a search parameter is provided
            if (!empty($search)) {
                $query .= " AND (firstName LIKE '%{$search}%' OR lastName LIKE '%{$search}%' OR CONCAT(firstName, ' ', lastName) LIKE '%{$search}%' OR email LIKE '%{$search}%')";
            }

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

    public static function getAllFeedbacks($connection, $lessonId, $subjectId){

        try {

            // common part
            $query = "SELECT feedback.* FROM feedback";

            if (!empty($lessonId) && !empty($subjectId)) {
                $query .= " JOIN lesson ON feedback.lessonId = lesson.lessonId
                            JOIN subject ON lesson.subjectId = subject.subjectId";
            }else {
                $query .= " JOIN lesson ON feedback.lessonId = lesson.lessonId";
            }

            // If both lessonId and subjectId are provided, add WHERE clause
            if (!empty($lessonId) && !empty($subjectId)) {
                $query .= " WHERE lesson.lessonId = $lessonId AND subject.subjectId = $subjectId";
            }else if (!empty($lessonId)) {
                $query .= " WHERE lesson.lessonId = $lessonId";
            }else if (!empty($subjectId)) {
                $query .= " WHERE lesson.subjectId = $subjectId";
            }

            // Add order by clause
            $query .= " ORDER BY timestamp DESC";

            $data = $connection->query($query);

            if($data){
                return $data;
            }else{
                throw new Exception("Error: Unable to get student feedbacks");
            }

        } catch (Exception $e) {
            $errorMessage = "An error occurred while fetching student feedbacks: " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

    public static function getAllSubjects($connection) {

        try {
            $query = "SELECT * FROM subject";
            $data = $connection->query($query);

            if($data){
                return $data;
            }else{
                throw new Exception("Error: Unable to get subjects:");
            }

        } catch (Exception $e) {
            $errorMessage = "An error occurred while fetching subjects: " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

    public static function getAllLessons($connection, $subject){

        try {

            $query = "SELECT * From lesson 
                      WHERE subjectId IN (SELECT subjectId From subject WHERE subjectTitle = '$subject')";

            $data = $connection->query($query);

            if($data){
                return $data;
            }else{
                throw new Exception("Error: Unable to get lessons:");
            }

        } catch (Exception $e) {
            $errorMessage = "An error occurred while fetching lessons: " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

    /**
     * End of
     * @author Charith Sathsara section
     */


    public static function updateTeacherDetails($fname,$lname,$address1,$address2,$number,$email,$userId,$subject,$connection){


        $query = "UPDATE user 
                  SET firstName='$fname',lastName='$lname',email= '$email' ,mobile= '$number' ,addLine01= '$address1' ,addLine02= '$address2'
                  WHERE userId ='$userId'";

        $data = $connection->query($query);

        if($data){

            $query2 = "SELECT subjectId  FROM subject WHERE subjectTitle = '$subject'";
            $data2 = $connection->query($query2);

            $result = $data2->fetch_assoc();
            $subjectId = $result['subjectId'];

            $query3 = "UPDATE teacher
                       SET subjectId = '$subjectId'
                       WHERE teacherId ='$userId'";

            $data3 = $connection->query($query3);

                      return $data3;
                 }else{
                     return false;
                      }
    }

    public static function deleteTeacher($userId,$connection){
        $query = "DELETE FROM user WHERE userId = '$userId'";

        $result = $connection->query($query);

        if($result){
            return $result;
        }
    }
}