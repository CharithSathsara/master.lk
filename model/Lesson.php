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
        
        while($row_data = mysqli_fetch_array($result2)){
            // echo "<form method='post' action='../../controller/dasboardController/studentSubjectController.php' name='selectsubejct-form' id='selectsubejct-form'>
            //         <button class='goToLesson-button' type='submit'>
            //             <div class='lesson'>
            //                 <p class='lesson-title'>".$row_data['lessonName']."</p>
            //             </div>
            //         </button>
            //     </form>";
            echo "<a href ='../../view/student/topicsAndFeedbacks.php'>
            <div class='lesson'>
                <p class='lesson-title'>".$row_data['lessonName']."</p>
            </div>
            </a>";
        }
        return;

    }


}