<?php

class Admin{


    public static function getAllTeachers($connection)
    {

        $query = "SELECT * FROM user WHERE userType = 'TEACHER'";

        $data = $connection->query($query);

        return $data;

    }

    public static function getTeacherSubject($connection, $teacherId){

        $query = "SELECT subjectTitle FROM subject WHERE subjectId = (SELECT subjectId FROM teacher WHERE teacherId = $teacherId)";

        $data = $connection->query($query);

        $subject = $data->fetch_assoc();

        if ($subject) {
            return $subject['subjectTitle'];
        } else {
            return false;
        }
    }

        public static function getAllContentCreators($connection){

            $query = "SELECT * FROM user WHERE userType = 'CONTENTCREATOR'";

            $data = $connection->query($query);

            return $data;

        }

        public static function getContentCreatorSubject($connection, $creatorId){

            $query = "SELECT subjectTitle FROM subject WHERE subjectId = (SELECT subjectId FROM contentcreator WHERE creatorId  = $creatorId)";

            $data = $connection->query($query);

            $subject = $data->fetch_assoc();

            if ($subject) {
                return $subject['subjectTitle'];
            } else {
                return false;
            }

        }

//        public static function getAllSubject($connection){
//
//            $query = "SELECT * FROM subject";
//
//            $data = $connection->query($query);
//
//            $subject = $data->fetch_assoc();
//
//                return $subject;
//            }
        public static function addTeacher($fname,$lname,$address1,$address2,$number,$email,$username,$password,$subject,$connection){

            $passHash = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO user(userName ,password ,firstName,lastName,email ,mobile,addLine01,addLine02,userType) VALUES ('$username','$passHash','$fname','$lname','$email','$number','$address1','$address2','TEACHER')";

            $data = $connection->query($query);

            if($data){

                $query1 = "SELECT userId FROM user WHERE email='$email'";
                $data1 = $connection->query($query1);

                $result = $data1->fetch_assoc();
                $teacherId = $result['userId'];

                $query2 = "SELECT subjectId FROM subject WHERE subjectTitle='$subject'";

                $data2 = $connection->query($query2);
                $result = $data2->fetch_assoc();
                $subjectId = $result['subjectId'];

                $queryToTeacher = "INSERT INTO teacher(teacherId,subjectId) VALUES ('$teacherId','$subjectId')";

                $dataSubject = $connection->query($queryToTeacher);

                return $dataSubject;
            } else{
                return false;
            }

        }



        public static function getAdminDetails($userId,$connection){

            $query = "SELECT * FROM user WHERE userId = $userId";

            $data = $connection->query($query);

            if($data){
                return $data;
            }
        }


        public static function getAllPaymentSlip(){

            $query = "SELECT * FROM `student` INNER JOIN `payment` ON student.studentId = payment.studentId INNER JOIN `slip_payment` ON payment.paymentId = slip_payment.paymentId";

            var_dump($query);
            exit();

        }

        public static function addContentCreator($fname,$lname,$address1,$address2,$number,$email,$username,$password,$subject,$connection){

            $passHash = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO user(userName ,password ,firstName,lastName,email ,mobile,addLine01,addLine02,userType) VALUES ('$username','$passHash','$fname','$lname','$email','$number','$address1','$address2','CONTENTCREATOR')";

            $data = $connection->query($query);

            if($data){

                $query1 = "SELECT userId FROM user WHERE email='$email'";
                $data1 = $connection->query($query1);

                $result = $data1->fetch_assoc();
                $teacherId = $result['userId'];

                $query2 = "SELECT subjectId FROM subject WHERE subjectTitle='$subject'";

                $data2 = $connection->query($query2);
                $result = $data2->fetch_assoc();
                $subjectId = $result['subjectId'];

                $queryToTeacher = "INSERT INTO contentcreator(teacherId,subjectId) VALUES ('$teacherId','$subjectId')";

                $dataSubject = $connection->query($queryToTeacher);

                return $dataSubject;
            } else{
                return false;
            }

        }





}