<?php

class Student{

    public static function getProfileDataStudent($connection){

        $userId = $_SESSION['auth_user']['userId'];

        $query = "SELECT dob FROM student WHERE studentId='$userId'";

        $result = $connection->query($query);
        $data = $result->fetch_assoc();

        if($result && mysqli_num_rows($result) > 0){
            return $data['dob'];
        }else{
            return false;
        }

    }

    public static function hasBought($connection,$subject){

        $userId = $_SESSION['auth_user']['userId'];

        $query1 = "SELECT subjectId FROM subject WHERE subjectTitle='$subject'";
        $result1 = $connection->query($query1);
        $data1 = $result1->fetch_assoc();
        $subjectId = $data1['subjectId'];

        $query2 = "SELECT * FROM student_subject WHERE studentId='$userId' AND subjectId='$subjectId'";

        $result2 = $connection->query($query2);

        if($result2 && mysqli_num_rows($result2) > 0){
            return true;
        }else{
            return false;
        }

    }


}