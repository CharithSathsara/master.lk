<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../public/css/feedback.css?<?php echo time(); ?>">
    <title>View Student Feedbacks</title>
</head>
<body>

<?php

include_once('../../../controller/authController/authentication/Authentication.php');
include_once('../../../controller/authController/authorization/Authorization.php');
include('../../../controller/teacherController/feedbackController/ViewFeedbackController.php');
include_once '../../common/header.php';

//User Authentication
Authentication::userAuthentication();
//User Authorization
Authorization::authorizingTeacher();

$viewFeedbackController = new ViewFeedbackController();

?>

<div class="content">

    <?php include_once '../../common/navBar-Teacher.php'; ?>

    <div class="main">

        <div id="dashboard-container">
            <p id="title"><b>Feedbacks</b></p>
            <p class="subheading"></p>
        </div>

        <?php

        // Get all student feedbacks
        $feedbacks = $viewFeedbackController->getAllFeedbacks();

        // Check if there are any feedbacks
        if(mysqli_num_rows($feedbacks) > 0){

            echo "<table>";

            // Loop through each feedback
            foreach($feedbacks as $row){

                // Create a table row for each feedback
                echo "<tr><td id='std-name'>"
                    .$viewFeedbackController->getStudentName($row['studentId'])
                    ."<br>".$viewFeedbackController->getDateTimeDifference($row['timestamp'])
                    ."</td>";

                // Get lesson details
                $lesson = $viewFeedbackController->getLesson($row['lessonId']);

                echo "<td id='lesson'>"
                    .$viewFeedbackController->getSubjectTitle($lesson['subjectId'])
                    ." &nbsp;|&nbsp; ".$lesson['lessonName']
                    ."</td>";
                echo "<td id='feedback'>{$row['feedback']}</td>";

                echo "</tr>";

            }

            echo "</table>";

        }else{
            echo "<div style='color: orange;margin-left: 30vw'><br>No Feedbacks to View<br> <img style='width: 12vw;height: 25vh' src='../../../public/img/search.png' /></div>";
        }

        ?>

    </div>
</div>
</body>
</html>

