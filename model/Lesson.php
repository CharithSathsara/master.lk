<?php

class Lesson{

    /**
     * Author:
     * @author Charith Sathsara
     */
    public static function getLesson($connection, $lessonId){

        try {
            $query = "SELECT * FROM lesson WHERE lessonId = $lessonId";
            $data = $connection->query($query);
            $lesson = $data->fetch_assoc();

            if($lesson){
                return $lesson;
            }else{
                throw new Exception("Error: Unable to fetch lesson");
            }
        } catch (Exception $e) {
            $errorMessage = "An error occurred while fetching lesson : " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }
    /**
     * End of
     * @author Charith Sathsara section
     */

    public static function getLessons($connection,$subject){

        $query1 = "SELECT subjectId FROM subject WHERE subjectTitle='$subject'";
        $result1 = $connection->query($query1);
        $data1 = $result1->fetch_assoc();
        $subjectId = $data1['subjectId'];

        $query2 = "SELECT lessonName FROM lesson WHERE subjectId='$subjectId'";
        $result2 = $connection->query($query2);

        if($result2 && mysqli_num_rows($result2) > 0){
        
            while($row_data = mysqli_fetch_array($result2)){
                echo " 
                        <a href='../../view/student/topicsAndFeedbacks.php?subject=".$subject."&lesson=".$row_data['lessonName']."' class='goToLesson-button'>
                            <div class='lesson'>
                                <p class='lesson-title'>".$row_data['lessonName']."</p>
                            </div>
                        </a>
                    
                    "; 
            }
            return true;
        }else{
            return false;
        }

    }

    
    public static function getSubjectLessons($connection,$subject){
        //     $query = "SELECT * From lesson 
        //                              WHERE subjectId = (SELECT subjectId From subject  
        //                                                 WHERE subjectTitle = '$subject')";
        //     $data = $connection->query($query);

        //     if($data){
        //         return $data;
        // //     }else{
        //         throw new Exception("Error: Unable to get topics of subject $subject");
        //     }

        // } catch (Exception $e) {
        //     $errorMessage = "An error occurred while fetching topics of subject $subject: " . $e->getMessage();
        //     echo '<script>console.error("' . $errorMessage . '")</script>';
        //     return false;
        // }
        

        $query1 = "SELECT subjectId FROM subject WHERE subjectTitle='$subject'";
        $result1 = $connection->query($query1);
        $data1 = $result1->fetch_assoc();
        $subjectId = $data1['subjectId'];

        $query2 = "SELECT * FROM lesson WHERE subjectId='$subjectId'";
        $result2 = $connection->query($query2);

        if($result2 && mysqli_num_rows($result2) > 0){
            return $result2;
        }else{
            return false;
        }

    }

    public static function getAllLessons($connection,$subject){

        $query1 = "SELECT subjectId FROM subject WHERE subjectTitle='$subject'";
        $result1 = $connection->query($query1);
        $data1 = $result1->fetch_assoc();
        $subjectId = $data1['subjectId'];

        $query2 = "SELECT * FROM lesson WHERE subjectId='$subjectId'";
        $result2 = $connection->query($query2);

        if($result2 && mysqli_num_rows($result2) > 0){
            return $result2;
        }else{
            return false;
        }

    }

    // Function to get completion of each lesson

    public static function getLessonCompletion($connection,$subject){

        $userId = $_SESSION['auth_user']['userId'];

        $query1 = "SELECT subjectId FROM subject WHERE subjectTitle='$subject'";
        $result1 = $connection->query($query1);
        $data1 = $result1->fetch_assoc();
        $subjectId = $data1['subjectId'];

        $query2 = "SELECT lessonName FROM lesson WHERE subjectId='$subjectId' ORDER BY lessonId ASC";
        $result2 = $connection->query($query2);
       
        $rows1 = array();

        if(mysqli_num_rows($result2) > 0){

            // Gets lesson names and stores them in a session array

            while ($row = mysqli_fetch_assoc($result2)) {
                $rows1[] = $row;
            }
            $_SESSION['lesson_rows'] = $rows1;

            // Gets the progress of each lesson and stores them in a session array
            $_SESSION['lesson_progress_values']=array();
            $progressValues = array();

            for($i=0;$i<mysqli_num_rows($result2);$i++){

                $lesson = $rows1[$i]['lessonName'];
            
                $query3 = "SELECT lessonId from lesson WHERE lessonName='$lesson'";
                $result3 = $connection->query($query3);
                $data3 = $result3->fetch_assoc();
                $lessonId = $data3['lessonId'];

                // Gets the no of covered topics of the relevant lesson

                $query4 = "SELECT DISTINCT quiz_details.topicId
                FROM quiz_details
                INNER JOIN topic ON quiz_details.topicId=topic.topicId
                INNER JOIN lesson ON topic.lessonId=lesson.lessonId
                WHERE lesson.lessonId='$lessonId' && quiz_details.studentId='$userId'
                ;";
                $result4 = $connection->query($query4);
                
                //Gets the total no of topics of the relavant lesson

                $query5 = "SELECT topic.topicId FROM topic 
                INNER JOIN lesson ON topic.lessonId=lesson.lessonId 
                WHERE lesson.lessonId='$lessonId'
                ";
                $result5 = $connection->query($query5);

                if(mysqli_num_rows($result5) > 0){
                    $total_no_of_topics = mysqli_num_rows($result5);
        
                    if(mysqli_num_rows($result4) > 0){
                        $no_of_covered_topics = mysqli_num_rows($result4);
                        $covered_percentage = round(($no_of_covered_topics/$total_no_of_topics)*100);
            
                        $progressValues[$i]= $covered_percentage;
        
                    }else{
                        $progressValues[$i]=0;
                        
                    }
                }else{
                    $progressValues[$i]=0;
                        
                }


            }
            $_SESSION['lesson_progress_values']=$progressValues;
            return true;
        }
        else{
            return false;
        }

    }

    //Function to check whether the student has started the given lesson

    public static function hasStarted($connection,$lesson){

        $userId = $_SESSION['auth_user']['userId'];
        $query1 = "SELECT lessonId from lesson WHERE lessonName='$lesson'";
        $result1 = $connection->query($query1);
        $data1 = $result1->fetch_assoc();
        $lessonId = $data1['lessonId'];

        // Checks whether there are any completed quizzes for the current student from the given lesson

        $query2 = "SELECT DISTINCT quiz_details.topicId
                FROM quiz_details
                INNER JOIN topic ON quiz_details.topicId=topic.topicId
                INNER JOIN lesson ON topic.lessonId=lesson.lessonId
                WHERE lesson.lessonId='$lessonId' && quiz_details.studentId='$userId'
                ;";
        $result2 = $connection->query($query2);

        if(mysqli_num_rows($result2) > 0){
            return true;
        }else{
            return false;
        }
    }

    //Function to get lesson progress for each topic

    public static function getLessonProgress($connection,$lesson,$type){

        $userId = $_SESSION['auth_user']['userId'];
        $query1 = "SELECT lessonId from lesson WHERE lessonName='$lesson'";
        $result1 = $connection->query($query1);
        $data1 = $result1->fetch_assoc();
        $lessonId = $data1['lessonId'];

        $query2 = "SELECT * FROM topic WHERE lessonId='$lessonId' ORDER BY topicId ASC";
        $result2 = $connection->query($query2);

        foreach ($result2 as $topicid){
            $topic = $topicid['topicId'];
            $query3 = "SELECT score FROM quiz_details WHERE topicId = '$topic' AND studentId='$userId' AND quizType='$type'";
            $result3 = $connection->query($query3);

            if(mysqli_num_rows($result3) > 0){
                $score_sum =0;
                $score_count=0;
                foreach ($result3 as $score){
                    $score_count++;
                    $score_sum = $score_sum + $score['score'];
                }
                $score_avg = $score_sum / $score_count;
                echo $score_avg.",";
            }else{
                echo "0,";
            }
        }
        
        return true;

    }
}