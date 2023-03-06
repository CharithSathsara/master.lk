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

public static function ViewTheoryContents($topicId, $connection){

    $select = "SELECT * FROM  topic_content WHERE topicId = '$topicId'; ";
        
        $data = $connection->query($select);

        return $data;

}


public static function AddTheoryContents( $sectionNo, $selectTopic,$sectionContent, $visibility,  $contentCreatorId, $connection){
   
    
    $select2 = "SELECT contentId FROM topic_content WHERE contentId = '$sectionNo'";
    

    $result2 = mysqli_query($connection, $select2);
 
    if(mysqli_num_rows($result2) > 0){
        popup_redirect("Section No. Already Exists!","view/contentcreator/addTheory.php");
      }
  else{
        
        if($visibility== "Visible"){
             $visibility = 1;
             }
         elseif($visibility== "Not Visible"){
             $visibility = 0;
             }
        $insert = "INSERT INTO topic_content (contentId, topicId , content, visibility, creatorId) VALUES ('$sectionNo','$selectTopic','$sectionContent','$visibility','$contentCreatorId')";
        
        $data = $connection->query($insert);

        return $data;
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
    
    public static function ViewToUpdateTheoryContents($sectionNo,$connection){
        
        $select = "SELECT content FROM  topic_content WHERE contentId = '$sectionNo'; ";
        
        $data = $connection->query($select);

        return $data;
        

}

}