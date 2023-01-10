<?php

class Admin{

    public static function getAllTeachers($connection){

        $query = "SELECT * FROM user WHERE userType = 'TEACHER'";

        $data = $connection->query($query);

        return $data;

    }

    public static function getTeacherSubject($connection, $teacherId){

        $query = "SELECT subjectTitle FROM subject WHERE subjectId = (SELECT subjectId FROM teacher WHERE teacherId = $teacherId)";

        $data = $connection->query($query);

        $subject = $data->fetch_assoc();

        if($subject){
            return $subject['subjectTitle'];
        }else{
            return false;
        }

    }

}