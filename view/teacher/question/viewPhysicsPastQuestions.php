<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../public/css/styles.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="../../../public/css/viewQuestions.css?<?php echo time(); ?>">
    <title>Physics Past Questions</title>
</head>
<body>

<?php

include_once('../../../controller/authController/authentication/Authentication.php');
include_once('../../../controller/authController/authorization/Authorization.php');
include('../../../controller/teacherController/questionController/ViewQuestionsController.php');

//User Authentication
Authentication::userAuthentication();
//User Authorization
Authorization::authorizingTeacher();

$viewQuestionController = new ViewQuestionsController();

include_once '../../common/header.php';

?>

<div class="content">

    <?php include_once '../../common/navBar-Teacher.php'; ?>

    <div class="main">

        <div id="dashboard-container">

            <b><p id="title-navigate"><span id="subject-shortcut"><a href="../teacherDashboard.php">Physics</a></span>&nbsp;&nbsp;>&nbsp;&nbsp;Past Paper</p></b>
            <p class="subheading">Questions &nbsp;&nbsp;&nbsp;</p>
            <br>

            <div style="margin-right: 100px;">

            <form action="" method="get">

                <label for="topic" id="label-topic">Select Topic :</label>
                <select name="topic" id="topic-selection">

                    <?php

                    $topics = $viewQuestionController->getAllTopics("Physics");

                    foreach($topics as $topic){
                        echo "<option value=\"{$topic['topicTitle']}\">{$topic['topicTitle']}</option>";
                    }

                    ?>

                </select>

                <input type="submit" id="view-questions" name="view-questions" onclick="" value="Get Questions">

            </form>
            <br>

            <table id="table">

                <?php

                if(isset($_GET['view-questions'])){

                    $questions = $viewQuestionController->viewQuestions("Physics", $_GET['topic'], "PASTQUESTION");

                    if(mysqli_num_rows($questions) > 0){

                        echo "<th>Physics : {$_GET['topic']} : Past Questions</th>";

                        foreach($questions as $row){
                            ?>

                            <tr>
                                <td>
                                    <input type="hidden" name="questionId" value="<?=$row['questionId'] ?>">
                                    <p class="question"><?=$row['question'] ?></p>
                                    <ol class="options">
                                        <li class="option1"><?=$row['opt01'] ?></li>
                                        <li class="option2"><?=$row['opt02'] ?></li>
                                        <li class="option3"><?=$row['opt03'] ?></li>
                                        <li class="option4"><?=$row['opt04'] ?></li>
                                        <li class="option5"><?=$row['opt05'] ?></li>
                                    </ol>
                                    <div class="correct-answer">Correct Answer: <?=$row['correctAnswer'] ?></div>
                                    <div class="description">Description: <?=$row['answerDescription'] ?></div>
                                    <div class="buttons">
                                        <input type="submit" class="update-button" name="update-question-btn" id="update-question-btn" value="Update">
                                        <a href="../../../controller/teacherController/questionController/deleteQuestionController.php?question_id=<?php echo $row['questionId'] ?>">
                                            <input type="submit" id="delete-btn" name="delete-question" onclick="" value="Delete">
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <?php
                        }

                    }else{
                        echo "<div id='no-topics'>
                              <img id='no-topics-img' src='../../../public/img/search.png' /><br>
                              <p id='no-topics-text'>{$_GET['topic']}: No Questions to View</p><br> 
                              </div>";
                    }
                }else{
                    echo "<div id='no-topics'>
                            <img id='no-topics-img' src='../../../public/img/search.png' /><br>
                            <p id='no-topics-text'>Please Select a Topic</p>
                           </div>";
                }

                ?>

            </table>

            <!--Update Question Form-->
            <?php include_once '../../teacher/question/updateQuestionForm.php'; ?>

            <script src="../../../public/js/updateQuestionForm.js"></script>

        </div>
        </div>
    </div>
</div>

</body>
</html>
