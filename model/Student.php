<?php

class Student {

    /**
     * Author:
     * @author Charith Sathsara
     */
    public static function getStudentName($connection, $studentId){

        try {
            $query = "SELECT firstName, lastName FROM user WHERE userId = $studentId";
            $data = $connection->query($query);
            $student = $data->fetch_assoc();

            if($student){
                return $student['firstName'].' '.$student['lastName'];
            }else{
                throw new Exception("Error: Unable to fetch student name");
            }
        } catch(Exception $e) {
            $errorMessage = "An error occurred while fetching student name: " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

    /**
     * End of
     * @author Charith Sathsara section
     */

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