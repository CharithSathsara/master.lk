<?php

class Subject {

    /**
     * Author:
     * @author Charith Sathsara
     */
    public static function getSubjectTitle($connection, $subjectId){

        try {
            $query = "SELECT subjectTitle FROM subject WHERE subjectId = $subjectId";
            $data = $connection->query($query);
            $subject = $data->fetch_assoc();

            if($subject){
                return $subject['subjectTitle'];
            }else{
                throw new Exception("Error: Unable to fetch subject title");
            }
        } catch (Exception $e) {
            $errorMessage = "An error occurred while fetching subject title: " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }
    /**
     * End of
     * @author Charith Sathsara section
     */

    public static function getSubjectPrice($connection,$subject){

        $query = "SELECT * from subject where subjectTitle = '$subject' limit 1 ";
        $data = $connection->query($query);
        $price = $data->fetch_assoc();

        return $price['price'];

    }

    public static function getSubjectDescription($connection,$subject){

        $query = "SELECT * from subject where subjectTitle = '$subject' limit 1 ";
        $data = $connection->query($query);
        $price = $data->fetch_assoc();

        return $price['description'];

    }

    public static function addToCart($connection,$subject){

        $userId = $_SESSION['auth_user']['userId'];

        $query1 = "SELECT cartId from cart where studentId = '$userId' limit 1 ";
        $data = $connection->query($query1);
        $data_set1 = $data->fetch_assoc();

        $cartId = $data_set1['cartId'];

        $query2 = "SELECT subjectId from subject where subjectTitle = '$subject' limit 1 ";
        $data = $connection->query($query2);
        $data_set2 = $data->fetch_assoc();

        $subjectId = $data_set2['subjectId'];

        $query3 = "SELECT * from cart_subject where cartId='$cartId' AND subjectId='$subjectId' limit 1";
        $result = $connection->query($query3);

        if(!($result && mysqli_num_rows($result) > 0)){
            $query4 = "INSERT into cart_subject (cartId,subjectId) VALUES ('$cartId','$subjectId')";
            $data = $connection->query($query4);
            return true;
        }else{
            return false;
        }
    }

    public static function removeFromCart($connection,$subject){

        $userId = $_SESSION['auth_user']['userId'];

        $query1 = "SELECT cartId from cart where studentId = '$userId' limit 1 ";
        $data = $connection->query($query1);
        $data_set1 = $data->fetch_assoc();

        $cartId = $data_set1['cartId'];

        $query2 = "SELECT subjectId from subject where subjectTitle = '$subject' limit 1 ";
        $data = $connection->query($query2);
        $data_set2 = $data->fetch_assoc();

        $subjectId = $data_set2['subjectId'];

        $query3 = "DELETE FROM cart_subject WHERE cartId='$cartId' AND subjectId = '$subjectId'";
        $result = $connection->query($query3);

        if($result){
            return true;
        }else{
            return false;
        }
    }

    public static function getAllSubject($connection){

        $query = "SELECT * FROM subject";

        $data = $connection->query($query);

        if ($data) {

            return $data;
        }
    }

    public static function AddDescription($connection,$subjectId,$description,$price){

        $query = "UPDATE subject SET description='$description', price = '$price'  WHERE subjectId ='$subjectId'";

        $data = $connection->query($query);

        if($data){
            return true;
        }else{
            return false;
        }

    }

    public static function getSubjectDescriptionUsingId($connection,$subjectId){

        $query = "SELECT * from subject where subjectId = '$subjectId'";
        $data = $connection->query($query);
        $description = $data->fetch_assoc();

        if ($description){
            return $description['description'];
        }else{
           return false;
        }

    }

    public static function updateSubjectDescription($connection,$subjectId,$description,$price){

        $query = "UPDATE subject
                  SET price	='$price', description='$description'
                  WHERE subjectId = '$subjectId'";

        $result = $connection->query($query);

        if($result){
            return $result;
        }else{
            return false;
        }
    }

    public static function getSubjectID($connection,$topicId){

        $query1 = "SELECT lessonId FROM topic WHERE topicId = '$topicId'";

        $lesson = $connection->query($query1);
        $lessonIdSet = mysqli_fetch_assoc($lesson);
        $lessonId = $lessonIdSet['lessonId'];

        $query2 = "SELECT SubjectId FROM lesson WHERE lessonId = '$lessonId'";

        $subjects = $connection->query($query2);
        $subjectIdSet = mysqli_fetch_assoc($subjects);
        $subjectId = $subjectIdSet['SubjectId'];

        if($subjectId){
            return $subjectId;
        }else{
            return false;
        }
    }
}