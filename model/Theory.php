<?php

class Theory{


    public static function getTheoryContent($connection,$subject,$lesson,$topic){

        $query1 = "SELECT subjectId FROM subject WHERE subjectTitle='$subject'";
        $result1 = $connection->query($query1);
        $data_set1 = $result1->fetch_assoc();
        $subjectId = $data_set1['subjectId'];

        $query2 = "SELECT lessonId FROM lesson WHERE lessonName='$lesson' AND subjectId='$subjectId'";
        $result2 = $connection->query($query2);
        $data_set2 = $result2->fetch_assoc();
        $lessonId = $data_set2['lessonId'];

        $query3 = "SELECT topicId FROM topic WHERE topicTitle='$topic' AND lessonId='$lessonId'";
        $result3 = $connection->query($query3);
        $data_set3 = $result3->fetch_assoc();
        $topicId = $data_set3['topicId'];

        $query4 = "SELECT * FROM topic_content WHERE topicId='$topicId' AND visibility='1' ORDER BY contentId ASC ";
        $result4 = $connection->query($query4);

        if($result4->num_rows > 0){
            while($row_data = mysqli_fetch_array($result4)){
                echo"
                    <p>".$row_data['content']."</p><br>
                ";
                if(!($row_data['image']==null)){
                    $to_echo = "<img class='content-img' src='data:image/jpg;charset=utf8;base64,";
                    $to_echo .= base64_encode($row_data['image']);
                    $to_echo .= "'/><br>";
                    echo $to_echo;
                }
            }
            return true;
        }else{
            echo"
                <div id='no-content-sec'>
                    <img src='../../public/img/no-content.png' id='no-content-img'><br>
                    <p id='no-content-text'>No Contents to Display!</p><br>
                </div>
                ";
            return false;
        }

    }

    

}

?>