<?php

class ContentCreator {

public static function getContentCreatorSubject($connection, $contentCreatorId){

try {
    $query1 = "SELECT subjectTitle FROM subject WHERE subjectId = (SELECT subjectId FROM contentcreator WHERE creatorId = $contentCreatorId)";
    $data = $connection->query($query1);
    $subject = $data->fetch_assoc();

    if($subject){
        return $subject['subjectTitle'];
    }else{
        throw new Exception("Error: Unable to get Content Creator subject");
    }

} catch (Exception $e) {
    $errorMessage = "Error Getting Content Creator Subject: " . $e->getMessage();
    echo '<script>console.error("' . $errorMessage . '")</script>';
    return false;
}

}

public static function ViewTheoryContents($connection, $subject, $topic){

    try {
        $query = "SELECT * FROM question WHERE subjectId = (SELECT subjectId From subject WHERE subjectTitle = '$subject') 
                                     AND topicId = (SELECT topicId From topic WHERE topicTitle = '$topic')";

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


public static function AddTheoryContents($selectTopic, $sectionNo, $visibility, $sectionContent, $contentCreatorId, $connection){
   
    $select1 = "SELECT topicId FROM topic WHERE topicTitle = '$selectTopic'";
    $select2 = "SELECT contentId FROM topic_content WHERE contentId = '$sectionNo'";
    
    $result1 = mysqli_query($connection, $select1);
    $result2 = mysqli_query($connection, $select2);
 
    if(mysqli_num_rows($result2) > 0){
        redirect("Section No. Already Exists!","view/contentcreator/addTheory.php");
     }
 else{
    try {
    $row = mysqli_fetch_array($result1);
       $_SESSION['topicID'] = $row['topicId'];
       $topicID = $_SESSION['topicID'];
       if($visibility== "Visible"){
            $visibility = 1;
            }
        elseif($visibility== "Not Visible"){
            $visibility = 0;
            }
        $insert = "INSERT INTO topic_content (contentId, topicId , content, visibility) VALUES ('$sectionNo','$topicID','$sectionContent','$visibility')";

        $data = $connection->query($insert);
        if($data){
            return $data;
            }else{
            throw new Exception("Error: Unable to add Theory Content");
            }
        }catch(Exception $e) {
            $errorMessage = "An error occurred while adding Theory Content: " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
            }
     
    }
}


public static function DeleteTheoryContents($connection, $section_no){

    try {
        $query = "DELETE FROM topic_content WHERE contentId = $section_no";
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

public static function UpdateTheoryContents($connection, $selectTopic, $sectionNo, $visibility, $sectionContent, $contentCreatorId){

        try {
            $select1 = "SELECT topicId FROM topic WHERE topicTitle = '$selectTopic'";
            $result1 = mysqli_query($connection, $select1);
            $row = mysqli_fetch_array($result1);
            if($row>0){
                $_SESSION['topicID'] = $row['topicId'];
                $topicID = $_SESSION['topicID'];
                if($visibility== "Visible"){
                 $visibility = 1;
                 }
             elseif($visibility== "Not Visible"){
                 $visibility = 0;
                 }
                 }
           
            $query = "UPDATE topic_content
                      SET contentId = '$sectionNo', topicId = '$topicID' , content = '$sectionContent', visibility = '$visibility' 
                      WHERE contentId = $sectionNo";

            $data = $connection->query($query);

            if($data){
                return $data;
            }else{
                throw new Exception("Error: Unable to update Theory Content");
            }

        } catch (Exception $e) {
            $errorMessage = "Error updating the Theory Content: " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }
}