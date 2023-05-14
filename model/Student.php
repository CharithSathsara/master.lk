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

    public static function register($connection, $first_name, $last_name, $dob, $address_first, $address_second, $telephone, $email, $username, $password){

        // Inserts data into the database - 'User Table'
        if(!empty($first_name) && !empty($last_name) && !empty($dob) && !empty($address_first) && !empty($address_second) &&
            !empty($telephone) && !empty($email) && !empty($username) && !empty($password)){

            try {

                $query1 = "INSERT into user (
                    userName,password,
                    firstName,lastName,
                    email,mobile,addLine01,
                    addLine02,userType 
                    ) VALUES ('$username', '$password',
                        '$first_name', '$last_name',
                        '$email', '$telephone',
                        '$address_first','$address_second','STUDENT'
                        )";

                $response = $connection->query($query1);

                if($response) {

                    // Inserts data into the database - 'Student Table'
                    $query2 = "SELECT userId from user where userName = '$username'";
                    $result = $connection->query($query2);

                    if($result && mysqli_num_rows($result) > 0){

                        $user_data = mysqli_fetch_assoc($result);
                        $user_id = $user_data["userId"];

                        $query3 = "INSERT into student (studentId, dob) VALUES($user_id, '$dob')";

                        $data = $connection->query($query3);

                        if($data) {
                            return $data;
                        }else {
                            return false;
                        }
                    }
                }

            } catch(Exception $e) {
                $errorMessage = "An error occurred while register a student : " . $e->getMessage();
                echo '<script>console.error("' . $errorMessage . '")</script>';
                return false;
            }

        }else{
            $errorMessage = "Form fields can not be empty";
            echo '<script>console.error("' . $errorMessage . '")</script>'."\n";
            return false;
        }
    }

    public static function slipUpload($connection, $amount, $slipContent, $studentId){

        try {

            $queryToPayment = "INSERT INTO payment (`amount`, `date`, `paymentType`, `studentId`) VALUES ($amount, NOW(), 'SLIP', $studentId)";
            $response = $connection->query($queryToPayment);

            if($response){

                // Get the last inserted paymentId
                $paymentId = mysqli_insert_id($connection);

                $queryToSlip = "INSERT INTO `slip_payment` (`paymentId`, `isVerified`, `slipImage` , `isCheck`) 
                                VALUES ($paymentId, 0, '$slipContent', 0)";

                $data = $connection->query($queryToSlip);

                if($data){
                    return true;
                }else{
                    throw new Exception("Error: Unable insert to slip payment table");
                }

            }else{
                throw new Exception("Error: Unable insert to payment table");
            }

        } catch(Exception $e) {
            $errorMessage = "An error occurred while fetching student name: " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

    public static function insertFeedback($connection, $feedback, $studentId, $lesson){

        try {

            $query = "INSERT INTO `feedback` (`feedback`, `studentId`, `lessonId`) VALUES ('$feedback', $studentId , (SELECT lessonId FROM lesson WHERE lessonName = '$lesson'));";
            $data = $connection->query($query);

            if($data){
                return true;
            }else{
                throw new Exception("Error: Unable insert to feedback table");
            }

        } catch(Exception $e) {
            $errorMessage = "An error occurred while inserting feedback : " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }


    }

    public static function onlinePayment($connection, $amount, $studentId){

        try {

            $queryToPayment = "INSERT INTO `payment` (`amount`, `date`, `paymentType`, `studentId`) VALUES ($amount, NOW(), 'ONLINE', $studentId);";
            $response = $connection->query($queryToPayment);

            if($response){

                // Get the last inserted paymentId
                $paymentId = mysqli_insert_id($connection);

                $queryToOnline = "INSERT INTO online_payment (`paymentId`)
                                VALUES ($paymentId)";

                $data = $connection->query($queryToOnline);

                if($data){
                    return true;
                }else{
                    throw new Exception("Error: Unable insert to online payment table");
                }

            }else{
                throw new Exception("Error: Unable insert to payment table");
            }

        } catch(Exception $e) {
            $errorMessage = "An error occurred while updating payments : " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

    public static function giveSubjectAccessUsingId($connection, $studentId, $subjectId){

        try {
            $currentDate = date('Y-m-d');
            $query = "INSERT INTO `student_subject` (`studentId`, `subjectId`, `startDate`) VALUES ($studentId, $subjectId, '$currentDate')";

            $data = $connection->query($query);

            if($data){
                return true;
            }else{
                throw new Exception("Error: Unable to give subject access");
            }

        } catch(Exception $e) {
            $errorMessage = "An error occurred while giving subject access: " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

    public static function clearCartUsingId($connection, $cartId){

        try {

            $query = "DELETE FROM `cart` WHERE cartId = $cartId";

            $data = $connection->query($query);

            if($data){
                return true;
            }else{
                throw new Exception("Error: Unable to clear cart");
            }

        } catch(Exception $e) {
            $errorMessage = "An error occurred while clearing student cart : " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

    public static function getStudent($connection, $studentId){

        try {
            $query = "SELECT * FROM user WHERE userId = $studentId";
            $data = $connection->query($query);
            $student = $data->fetch_assoc();

            if($student){
                return $student;
            }else{
                throw new Exception("Error: Unable to fetch student");
            }

        } catch(Exception $e) {
            $errorMessage = "An error occurred while fetching student: " . $e->getMessage();
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

    public static function getSubjectProgress($connection,$subject)
    {

        $userId = $_SESSION['auth_user']['userId'];

        $query1 = "SELECT subjectId FROM subject WHERE subjectTitle='$subject'";
        $result1 = $connection->query($query1);
        $data1 = $result1->fetch_assoc();
        $subjectId = $data1['subjectId'];

        //Gets the number of covered topics of the relavant subject

        $query2 = "SELECT DISTINCT quiz_details.topicId
        FROM quiz_details
        INNER JOIN topic ON quiz_details.topicId=topic.topicId
        INNER JOIN lesson ON topic.lessonId=lesson.lessonId
        INNER JOIN subject ON lesson.subjectId=subject.subjectId WHERE subject.subjectId='$subjectId' && quiz_details.studentId='$userId'
        ;";
        $result2 = $connection->query($query2);

        //Gets the total no of topics of the relavant subject

        $query3 = "SELECT topic.topicId FROM topic 
        INNER JOIN lesson ON topic.lessonId=lesson.lessonId 
        INNER JOIN subject ON lesson.subjectId=subject.subjectId WHERE subject.subjectId='$subjectId'
        ";
        $result3 = $connection->query($query3);

        if (mysqli_num_rows($result3) > 0) {
            $total_no_of_topics = mysqli_num_rows($result3);

            if (mysqli_num_rows($result2) > 0) {
                $no_of_covered_topics = mysqli_num_rows($result2);
                $covered_percentage = round(($no_of_covered_topics/$total_no_of_topics)*100);
                return $covered_percentage;

            } else {
                echo "0";
                return;
            }
        } else {
            echo "0";
            return;
        }
    }

    public static function giveSubjectAccess($connection, $studentId, $subjectId){

        try {
            $currentDate = date('Y-m-d');
            $query = "INSERT INTO `student_subject` (`studentId`, `subjectId`, `startDate`) VALUES ($studentId, $subjectId, '$currentDate')";

            $data = $connection->query($query);

            if($data){
                return true;
            }else{
                throw new Exception("Error: Unable to give subject access");
            }

        } catch(Exception $e) {
            $errorMessage = "An error occurred while giving subject access: " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

    public static function clearCart($connection, $cartId){

        try {

            $query = "DELETE FROM `cart` WHERE cartId = '$cartId'";

            $data = $connection->query($query);

            if($data){
                return true;
            }else{
                throw new Exception("Error: Unable to clear cart");
            }

        } catch(Exception $e) {
            $errorMessage = "An error occurred while clearing student cart : " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }


    // get student email

    public  static function getStudentEmail($connection,$userId){

        $query = "SELECT email FROM user WHERE userId ='$userId'";

        $data = $connection->query($query);

        $email = $data->fetch_assoc();

        if ($email){
            return $email['email'];
        }else{
            return false;
        }
    }

    //Function to get recommendations for the student

    public static function getRecommendations($connection){

        $userId = $_SESSION['auth_user']['userId'];
        $msgs = array(); 
        
        //Checks if the student has started any lessons

        $query1 = "SELECT * FROM quiz_details WHERE studentId='$userId'";
        $result1 = $connection->query($query1);

        if(mysqli_num_rows($result1)>0){

            $query2 = "SELECT * FROM lesson ORDER BY lessonId ASC";
            $result2 = $connection->query($query2);

            foreach($result2 as $lessonAttribute){
                $lesson = $lessonAttribute['lessonName'];
                $lessonId = $lessonAttribute['lessonId'];

                //Checks if the student has started the selected lesson

                $hasStarted = Lesson::hasStarted($connection,$lesson);
                if($hasStarted){

                    $query3="SELECT * FROM topic WHERE lessonId = '$lessonId'";
                    $result3 = $connection->query($query3);

                    if(mysqli_num_rows($result3)>0){

                        foreach($result3 as $topicAttribute){
                            $topic = $topicAttribute['topicTitle'];
                            $topicId = $topicAttribute['topicId'];

                            //Checks whether the average marks of Model Paper quizzes are < 5 in the quiz

                            $query5 = "SELECT score FROM quiz_details WHERE studentId='$userId' AND topicId='$topicId' AND quizType='MODELPAPER'";
                            $result5 = $connection->query($query5);
                            if(mysqli_num_rows($result5)>0){
                                $model_count=0;
                                $model_sum=0;
                                foreach($result5 as $model_scores){
                                    $model_count++;
                                    $model_sum = $model_sum + $model_scores['score'];
                                }
                                $model_avg = $model_sum / $model_count;
                                if($model_avg<5){
                                    $msgs[] = "Do more model papers from <b>".$topic."</b> of <b>".$lesson."</b>.";
                                }
                            }
                            //Checks whether the average marks of Past Paper quizzes are < 5 in the quiz

                            $query6 = "SELECT score FROM quiz_details WHERE studentId='$userId' AND topicId='$topicId' AND quizType='PASTPAPER'";
                            $result6 = $connection->query($query6);
                            if(mysqli_num_rows($result6)>0){
                                $past_count=0;
                                $past_sum=0;
                                foreach($result6 as $past_scores){
                                    $past_count++;
                                    $past_sum = $past_sum + $past_scores['score'];
                                }
                                $past_avg = $past_sum / $past_count;
                                if($past_avg<5){
                                    $msgs[] = "Do more past papers from <b>".$topic."</b> of <b>".$lesson."</b>.";
                                }
                            }

                            //Checks whether there are marks < 5 in the quizzes of selected topic

                            $query4 = "SELECT score FROM quiz_details WHERE score<5 AND studentId='$userId' AND topicId='$topicId'";
                            $result4 = $connection->query($query4);

                            if(mysqli_num_rows($result4)>0){
                                $msgs[] = "Pay more attention to <b>".$topic."</b> of <b>".$lesson."</b>.";
                            }
                        }
                    }
                }else{
                    $msgs[] = "Start your quizzes of <b>".$lesson."</b>.";
                }
            }

        }else{
            $msgs[]="Go ahead and start your quizzes to expand your knowledge. ";
        }

        //Store the messages in a session array

        $_SESSION['rec-msgs'] = $msgs;
        return true;
        
    }

    // Function to get a student's daily time usage

    public static function getTimes($connection){

        $userId = $_SESSION['auth_user']['userId'];

        $last_week_dates = array();
        $current_date = new DateTime();
        for ($i = 1; $i <= 7; $i++) {
            $last_week_dates[] = $current_date->modify('-1 day')->format('Y-m-d');
        }
        $last_week_dates = array_reverse($last_week_dates);
        $daily_usages = array();

        for($i = 0; $i < 7; $i++){
            $day = $last_week_dates[$i];
            $query1 = "SELECT * FROM daily_usage_times WHERE userId = '$userId' && date='$day'";
            $result1 = $connection->query($query1);

            if($result1 && mysqli_num_rows($result1) > 0){
                $data1 = $result1->fetch_assoc();
                $time_seconds = $data1['total_usage_time'];
                $daily_usages[] = round($time_seconds/60);
            }else{
                $daily_usages[] = 0;
            }
        }
        $_SESSION['daily_usages']= $daily_usages;
        return true;
    }

}