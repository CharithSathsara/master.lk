<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="../../../public/css/quizDetails.css?<?php echo time(); ?>">
</head>
<body>

<?php

include_once('../../../config/app.php');
include_once('../../../controller/authController/authentication/Authentication.php');
include_once('../../../controller/authController/authorization/Authorization.php');

//User Authentication
Authentication::userAuthentication();
//User Authorization
Authorization::authorizingTeacher();

include_once '../../common/header.php';

?>

<div class="content">

    <?php include_once '../../common/navBar-Teacher.php'; ?>

    <div class="main">

        <div id="dashboard-container">

            <p id="title"><b>Quiz Details</b></p>

            <?php

            include('../../../controller/teacherController/quizDetailsController/QuizDetailsController.php');
            $quizDetailsController = new QuizDetailsController();

            ?>

            <p class="subheading">Quizzes &nbsp;&nbsp;&nbsp;</p>

            <br>

            <section class="container-01">

                <div class="main-card">
                    <h3 id="quiz-participation-count"><?= $quizDetailsController->getNoOfAttendees() ; ?> students have engaged in the quizzes </h3>
                </div>

            </section>

            <section class="container-02">

                <div class="card-01">
                    <p class="card-topics">Physics</p><br>
                    <div class="card-content">
                        <p class="quiz-attention"><?= $quizDetailsController->getNoOfQuizAttendees("Physics") ; ?> attended quizzes</p><br>
                    </div>
                </div>

                <div class="card-02">
                    <p class="card-topics">Chemistry</p><br>
                    <div class="card-content">
                        <p class="quiz-attention"><?= $quizDetailsController->getNoOfQuizAttendees("Chemistry") ; ?> attended quizzes</p><br>
                    </div>
                </div>

            </section>

            <section class="container-03">


                <form action="" method="get">

                    <br><hr><br>
                    <p id="view-details-text">You can view quiz details about <?= $_SESSION['subject']; ?>:</p><br><br>

                    <label for="topic">Select Topic :</label>
                    <select name="topic">

                        <?php

                        $topics = $quizDetailsController->getAllTopics($_SESSION['subject']);

                        foreach($topics as $topic){
                            echo "<option value=\"{$topic['topicTitle']}\">{$topic['topicTitle']}</option>";
                        }

                        ?>

                    </select>

                    <label for="type">Select Type :</label>
                    <select name="type">
                        <option value="PASTPAPER">Past Paper</option>
                        <option value="MODELPAPER">Model Paper</option>
                    </select>

                    <input id ="view-quiz-details-btn" type="submit" name="view-quiz-details" value="Get Details">
                    <br><br><hr>

                </form>


            </section>

            <br>
            <table id="table">

                <?php

                if(isset($_GET['view-quiz-details'])){

                    $quizDetails = $quizDetailsController->getAllQuizDetails($_GET['topic'], $_GET['type']);

                    if(mysqli_num_rows($quizDetails) > 0){

                        echo "<th>Name</th><th>Topic</th><th>Quiz Type</th><th>Score</th>";

                        foreach($quizDetails as $row){
                            ?>

                            <tr>
                                <td>
                                    <?= $quizDetailsController->getStudentName($row['studentId']) ?>
                                </td>
                                <td>
                                    <?= $_GET['topic'] ?>
                                </td>
                                <td>
                                    <?= $_GET['type'] ?>
                                </td>
                                <td>
                                    <?= $row['score'] ?>
                                </td>
                            </tr>

                            <?php
                        }

                    }else{
                        echo "<div id='no-topics'>
                              <img id='no-topics-img' src='../../../public/img/search.png' /><br>
                              <p id='no-topics-text'>{$_GET['topic']}: No Quiz Details to View</p><br> 
                              </div>";
                    }
                }else{
                    echo "<div id='no-topics'>
                            <img id='no-topics-img' src='../../../public/img/search.png' /><br>
                            <p id='no-topics-text'>Please Select a Topic and a Paper Type</p>
                           </div>";
                }

                ?>

            </table>
        </div>
    </div>
</div>
</body>
</html>
