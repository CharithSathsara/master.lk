<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../public/css/studentDetails.css?<?php echo time(); ?>">
    <title>View Student Details From Charith Branch</title>
</head>
<body>

<?php

include_once('../../../controller/authController/authentication/Authentication.php');
include_once('../../../controller/authController/authorization/Authorization.php');
include('../../../controller/teacherController/studentDetailsController/ViewStudentDetailsController.php');
include_once '../../common/header.php';

//User Authentication
Authentication::userAuthentication();
//User Authorization
Authorization::authorizingTeacher();

$viewStudentDetailsController = new ViewStudentDetailsController();

?>

<div class="content">

    <?php include_once '../../common/navBar-Teacher.php'; ?>

    <div class="main">

        <div id="dashboard-container">
            <p id="title"><b>Student Details</b></p>
            <p class="subheading">Students &nbsp;&nbsp;&nbsp;</p>
        </div>

        <?php

            // Get all students from the controller
            $students = $viewStudentDetailsController->getAllStudents();

            // Check if there are any students
            if (mysqli_num_rows($students) > 0) {

                echo "<table>
                    <tr>
                        <th>Name</th>
                        <th>Email Address</th>
                        <th>Enrolled Subjects</th>
                        <th>Telephone No</th>
                    </tr>";
                // Loop through each student
                foreach ($students as $row) {

                    // Create a table row for each student
                    echo "<tr>
                    <td>{$row['firstName']} {$row['lastName']}</td>
                    <td>{$row['email']}</td>";

                    // Get the subjects of each student
                    $subjectsIDs = $viewStudentDetailsController->getStudentSubjects($row['userId']);

                    // Check if the student has any subjects
                    if (mysqli_num_rows($subjectsIDs) > 0) {

                        // If the student has subjects, list them
                        echo "<td>";

                        try {
                            foreach ($subjectsIDs as $subjectId) {
                                echo "|".$viewStudentDetailsController->getSubjectTitle($subjectId['subjectId'])."|";
                            }
                        } catch (Exception $e) {
                            // Log the error message
                            error_log($e->getMessage());
                            // Display a error message
                            echo "An error occurred while retrieving subject titles. Please try again later.";
                        }

                        echo "</td>";

                    } else {
                        // If the student doesn't have subjects, display a message
                        echo "<td>No Enrolled Subjects</td>";
                    }

                    // Add the student's telephone number to the table
                    echo "<td>{$row['mobile']}</td>";
                    echo "</tr>";
                }

                // Close the table
                echo "</table>";

            } else {
                // If there are no students, display a message
                echo "<div style='color: orange;margin-left: 30vw'><br>No Students<br><img style='width: 12vw;height: 25vh' src='../../../public/img/search.png' /></div>";
            }
        ?>

    </div>
</div>
</body>
</html>
