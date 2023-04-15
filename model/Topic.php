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

        $query2 = "SELECT lessonId FROM lesson WHERE subjectId='$subjectId' AND lessonName='$lesson'";
        $result2 = $connection->query($query2);
        $data2 = $result2->fetch_assoc();
        $lessonId = $data2['lessonId'];

        $query3 = "SELECT topicTitle FROM topic WHERE lessonId='$lessonId'";
        $result3 = $connection->query($query3);
        
        if($result3->num_rows > 0){
            while($row_data = mysqli_fetch_array($result3)){
                echo "<a href ='../student/theoryContents.php?topic=".$row_data['topicTitle']."'>
                <div class='topic'>
                    <p class='topic-title'>".$row_data['topicTitle']."</p>
                </div>
                </a>";
            }
            return;
        }else{
            echo"
                    <br>
                    <div id='no-content-sec'>
                        <img src='../../public/img/no-content.png' id='no-content-img'><br>
                        <p id='no-content-text'>No Topics to Display!</p>
                    </div>
                ";
            return false;
        }
        

    }

    public static function getTopicsOfLesson($connection,$lesson){

        $query2 = "SELECT lessonId FROM lesson WHERE lessonName='$lesson'";
        $result2 = $connection->query($query2);
        $data2 = $result2->fetch_assoc();
        $lessonId = $data2['lessonId'];

        $query3 = "SELECT topicTitle FROM topic WHERE lessonId='$lessonId' ORDER BY topicId ASC";
        $result3 = $connection->query($query3);
        
        if($result3->num_rows > 0){
            return $result3;
        }else{
            return false;
        }
        

    }

}