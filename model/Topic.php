<?php

class Topic{

    /**
     * Author:
     * @author Charith Sathsara
     */
    public static function getAllTopics($connection, $subject){

        try {
            $query = "SELECT topicId, topicTitle From topic 
                      WHERE lessonId IN (SELECT lessonId From lesson 
                                     WHERE subjectId = (SELECT subjectId From subject  
                                                        WHERE subjectTitle = '$subject'))";
            $data = $connection->query($query);

            if($data){
                return $data;
            }else{
                throw new Exception("Error: Unable to get topics of subject $subject");
            }

        } catch (Exception $e) {
            $errorMessage = "An error occurred while fetching topics of subject $subject: " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }
    /**
     * End of
     * @author Charith Sathsara section
     */

    public static function getTopics($connection,$subject,$lesson){

        $query1 = "SELECT subjectId FROM subject WHERE subjectTitle='$subject'";
        $result1 = $connection->query($query1);
        $data1 = $result1->fetch_assoc();
        $subjectId = $data1['subjectId'];

        $query2 = "SELECT lessonId FROM lesson WHERE subjectId='$subjectId'";
        $result2 = $connection->query($query2);
        $data2 = $result2->fetch_assoc();
        $lessonId = $data2['lessonId'];

        $query3 = "SELECT topicTitle FROM topic WHERE lessonId='$lessonId'";
        $result3 = $connection->query($query3);
        
        while($row_data = mysqli_fetch_array($result3)){
            // echo "<form method='post' action='../../controller/dasboardController/studentSubjectController.php' name='selectsubejct-form' id='selectsubejct-form'>
            //         <button class='goToLesson-button' type='submit'>
            //             <div class='lesson'>
            //                 <p class='lesson-title'>".$row_data['lessonName']."</p>
            //             </div>
            //         </button>
            //     </form>";
            echo "<a href =''>
            <div class='topic'>
                <p class='topic-title'>".$row_data['topicTitle']."</p>
            </div>
            </a>";
        }
        return;

    }


}