<?php

    class ContentCreator
    {
        public static function updateContentCreator($userId,$fname,$lname,$address1,$address2,$number,$email,$subject,$connection){

            $query = "UPDATE user 
                  SET firstName='$fname',lastName='$lname',email= '$email' ,mobile= '$number' ,addLine01= '$address1' ,addLine02= '$address2'
                  WHERE userId ='$userId'";

            $result = $connection->query($query);

            // return $result;

            if($result){

                $query1 = "SELECT subjectId FROM subject WHERE subjectTitle ='$subject'";
                $result1 = $connection->query($query1);

                $subjectID = $result1->fetch_assoc();
                $subjectId = $subjectID['subjectId'];

                $query2 = "UPDATE contentcreator
                    SET subjectId ='$subjectId'
                    WHERE creatorId ='$userId'";

                $finalResult = $connection->query($query2);

                return $finalResult;
            }else{
                return false;
            }
        }

        public static function deleteContentCreator($userId,$connection){
            $query = "DELETE FROM user WHERE userId='$userId'";

            $data = $connection->query($query);

            if($data){
                return $data;
            }else{
                return false;
            }
        }
    }
?>