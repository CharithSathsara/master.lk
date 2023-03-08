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
    $select = "SELECT topic_content.contentId, topic_content.content, topic_content.date_published, user.firstName, user.lastName
    FROM topic_content
    INNER JOIN user
    ON topic_content.creatorId = user.userId WHERE topicId = '$topicId'";
        
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


        $delete = "DELETE FROM topic_content WHERE contentId = $section_no";
        $data = $connection->query($delete);

        if($data){
            return $data;
        }
}

public static function UpdateTheoryContents($sectionNo, $sectionContent, $visibility,$connection){
        
    if($visibility== "Visible"){
        $visibility = 1;
        }
    elseif($visibility== "Not Visible"){
        $visibility = 0;
        }
        
        $update = "UPDATE topic_content  SET content = '$sectionContent' , visibility = '$visibility'  WHERE  topic_content.contentId = '$sectionNo';";
        

            $data = $connection->query($update);

            if($data){
                return $data;
            }

}
    
    public static function ViewToUpdateTheoryContents($sectionNo,$connection){
        
        $select = "SELECT contentId , content FROM  topic_content WHERE contentId = '$sectionNo'; ";
        
        $data = $connection->query($select);

        if($data){
            return $data;
        }
        

}

}