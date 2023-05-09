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
            <p id="title"><b>Student Feedbacks</b></p>
            <p class="subheading">Feedbacks &nbsp;&nbsp;&nbsp;</p>
        </div>

        <div class="search-container">
            <form action="" class="search-form" method="GET">
                <div class="search-field">
                    <select name="subject">
                        <option value="">-- Select a subject --</option>
                        <?php
                        $subjects = $viewFeedbackController->getAllSubjects();
                        foreach($subjects as $subject){
                            $selected = (isset($_GET['subject']) && $_GET['subject'] == $subject['subjectId']) ? 'selected' : '';
                            echo "<option value=\"{$subject['subjectId']}\" $selected>{$subject['subjectTitle']}</option>";
                        }
                        ?>
                    </select>
                    <select name="lesson">
                        <option value="">-- Select a lesson --</option>
                        <optgroup label="Physics">
                            <?php
                            $lessons = $viewFeedbackController->getAllLessons("Physics");
                            foreach($lessons as $lesson){
                                $selected = (isset($_GET['lesson']) && $_GET['lesson'] == $lesson['lessonId']) ? 'selected' : '';
                                echo "<option value=\"{$lesson['lessonId']}\" $selected>{$lesson['lessonName']}</option>";
                            }
                            ?>
                        </optgroup>
                        <optgroup label="Chemistry">
                            <?php
                            $lessons = $viewFeedbackController->getAllLessons("Chemistry");
                            foreach($lessons as $lesson){
                                $selected = (isset($_GET['lesson']) && $_GET['lesson'] == $lesson['lessonId']) ? 'selected' : '';
                                echo "<option value=\"{$lesson['lessonId']}\" $selected>{$lesson['lessonName']}</option>";
                            }
                            ?>
                        </optgroup>
                    </select>
                </div>
                <?php if ((isset($_GET['subject']) && !empty($_GET['subject'])) || (isset($_GET['lesson']) && !empty($_GET['lesson']))) : ?>
                    <input class="clear-button" type="reset" value="Clear Search"/>
                <?php endif; ?>
                <input class="search-button" type="submit" value="Search"/>
            </form>
        </div>


        <script src="../../../public/js/feedbacks.js"></script>

        <?php

            if (isset($_GET['subject']) || isset($_GET['lesson'])) {

                // Get the search query from the URL parameter
                $subjectId = $_GET['subject'];
                $lessonId = $_GET['lesson'];

                // Get feedbacks relevant to lesson and subject
                $feedbacks = $viewFeedbackController->getAllFeedbacks($lessonId, $subjectId);
            }else {
                $feedbacks = $viewFeedbackController->getAllFeedbacks();
            }

            // Check if there are any feedbacks
            if(mysqli_num_rows($feedbacks) > 0){

                echo "<table>
                      <tr>
                        <th>Student Name</th>
                        <th>Subject | Lesson</th>
                        <th>Student Feedback</th>
                      </tr>";


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

