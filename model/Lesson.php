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

        
        $query1 = "SELECT subjectId FROM subject WHERE subjectTitle='$subject'";
        $result1 = $connection->query($query1);
        $data1 = $result1->fetch_assoc();
        $subjectId = $data1['subjectId'];

        $query2 = "SELECT lessonId, lessonName FROM lesson WHERE subjectId='$subjectId'";
        $result2 = $connection->query($query2);

            if($result2){
                return $result2;
            }
    }

    // Function to get progress of each lesson

    public static function getLessonProgress($connection,$subject){

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

}