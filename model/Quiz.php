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
    
        $sql = "SELECT * FROM question WHERE topicId = '$topicId' AND questionType = 'MODELQUESTION' ORDER BY RAND() LIMIT 3";
        $result = mysqli_query($connection, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            // Create an empty array to store the data
            // $questions = $result->fetch_assoc();
            return $result;
        
        }
        
        

    }




    //Function to get all the quizzes done by the current user of the given type of the given lesson

    public static function getQuizzesList($connection,$lesson,$topic,$type){

        $userId = $_SESSION['auth_user']['userId'];

        $query2 = "SELECT lessonId FROM lesson WHERE lessonName='$lesson'";
        $result2 = $connection->query($query2);
        $data_set2 = $result2->fetch_assoc();
        $lessonId = $data_set2['lessonId'];

        $query3 = "SELECT topicId FROM topic WHERE topicTitle='$topic' AND lessonId='$lessonId'";
        $result3 = $connection->query($query3);
        $data_set3 = $result3->fetch_assoc();
        $topicId = $data_set3['topicId'];

        $query1 = "SELECT quiz_details.* FROM quiz_details INNER JOIN topic ON quiz_details.topicId=topic.topicId
                WHERE topic.lessonId='$lessonId' AND quiz_details.topicId='$topicId' AND quiz_details.studentId='$userId' AND quiz_details.quizType='$type'
                ORDER BY quiz_details.quizId ASC";
        $result1 = $connection->query($query1);

        if(mysqli_num_rows($result1)>0){
            return $result1;
        }else{
            return false;
        }

    }

    //Function to get the questions,answers and descriptions of the given quiz

    public static function getQuestions($connection,$lesson,$topic,$type,$attempt){

        $userId = $_SESSION['auth_user']['userId'];

        $query2 = "SELECT lessonId FROM lesson WHERE lessonName='$lesson'";
        $result2 = $connection->query($query2);
        $data_set2 = $result2->fetch_assoc();
        $lessonId = $data_set2['lessonId'];

        $query3 = "SELECT topicId FROM topic WHERE topicTitle='$topic' AND lessonId='$lessonId'";
        $result3 = $connection->query($query3);
        $data_set3 = $result3->fetch_assoc();
        $topicId = $data_set3['topicId'];

        $query1 = "SELECT quiz_details.* FROM quiz_details INNER JOIN topic ON quiz_details.topicId=topic.topicId
                WHERE topic.lessonId='$lessonId' AND quiz_details.topicId='$topicId' AND quiz_details.studentId='$userId' AND quiz_details.quizType='$type'
                AND quiz_details.attempts='$attempt'";
        $result1 = $connection->query($query1);
        $data_set1 = $result1->fetch_assoc();
        $quizId = $data_set1['quizId'];

        //Get answers of the questions

        $query6 = "SELECT * FROM quiz_answers WHERE quizId='$quizId'";
        $result6 = $connection->query($query6);
        $data_set6 = $result6->fetch_assoc();

        $answers = array();

        for($i=1;$i<11;$i++){
            $index = 'answer'.$i;
            $answers[] = $data_set6[$index];
        }

        $_SESSION['quiz_answers'] = $answers;

        //Get questions relavant to the given quiz

        $query4 = "SELECT * FROM quiz_questions WHERE quizId='$quizId'";
        $result4 = $connection->query($query4);
        $data_set4 = $result4->fetch_assoc();

        $questionIdList = array();

        for($i=1;$i<11;$i++){
            $q = 'questionId'.$i;
            $questionIdList[] = $data_set4[$q];
        }

        $idList = implode(',', $questionIdList);

        $query5 = "SELECT * FROM question WHERE questionId IN ($idList)";
        $result5 = $connection->query($query5);
        
        if($result5 && mysqli_num_rows($result5) > 0){
            return $result5;
        }else{
            return false;
        }

    }


       


}