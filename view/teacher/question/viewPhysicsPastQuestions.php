<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<<<<<<< HEAD
    <link rel="stylesheet" href="../../../public/css/styles.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="../../../public/css/viewQuestions.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="../../../public/css/updateQuestionForm.css?<?php echo time(); ?>">
    <title>Physics Past Questions</title>
=======
    <title>Physics Past Questions</title>

    <style>

        table{
            width: 75vw;
            padding: 5px;
        }
        td,th{
            border: 3px solid gray;
            border-radius: 7px;
            padding: 15px;
        }

    </style>

>>>>>>> origin/master
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

<<<<<<< HEAD
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

                <input type="submit" class="" name="view-questions" onclick="" value="Get Questions">

            </form>
            <br>
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
                                    <input type="hidden" name="questionId" value=<?=$row['questionId'] ?>><br>
                                    Question : <p class="question"><?=$row['question'] ?></p>
                                    <br>
                                    <br>
                                    1) <p class="option1"><?=$row['opt01'] ?></p>
                                    <br>
                                    2) <p class="option2"><?=$row['opt02'] ?></p>
                                    <br>
                                    3) <p class="option3"><?=$row['opt03'] ?></p>
                                    <br>
                                    4) <p class="option4"><?=$row['opt04'] ?></p>
                                    <br>
                                    5) <p class="option5"><?=$row['opt05'] ?></p>
                                    <br>
                                    <br>
                                    Correct Answer : <p class="correct-answer"><?=$row['correctAnswer'] ?></p>
                                    <br>
                                    <br>
                                    Description : <p class="description"><?=$row['answerDescription'] ?></p>
                                    <br>
                                    <br>
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
=======
?>

<h3>Questions</h3>

<form action="" method="get">

    <label for="topic">Select Topic :</label>
    <select name="topic">

        <?php

            $topics = $viewQuestionController->getAllTopics("Physics");

            foreach($topics as $topic){
                echo "<option value=\"{$topic['topicTitle']}\">{$topic['topicTitle']}</option>";
            }

        ?>

    </select>

    <button type="submit" class="" name="view-questions" onclick="" value="view">Get Questions</button>

</form>
<br>
<br>

<table id="table">

        <?php

            if(isset($_GET['view-questions'])){

                $questions = $viewQuestionController->viewQuestions("Physics", $_GET['topic'], "PASTQUESTION");


                if($questions){

                    echo "<th>Physics : {$_GET['topic']} : Past Questions</th>";

                    foreach($questions as $row){
                        ?>

                        <tr>
                            <td>
                                Question : <?=$row['question'] ?>
                                <br>
                                <br>
                                Answer 01: <?=$row['opt01'] ?>
                                <br>
                                Answer 02: <?=$row['opt02'] ?>
                                <br>
                                Answer 03: <?=$row['opt03'] ?>
                                <br>
                                Answer 04: <?=$row['opt04'] ?>
                                <br>
                                Answer 05: <?=$row['opt05'] ?>
                                <br>
                                <br>
                                <br>
                                <button>Edit</button>
                                <button>Delete</button>
                            </td>
                        </tr>

                        <?php
                    }

                }else{
                    echo "<th>Physics : {$_GET['topic']} : Past Questions<br>No Questions to View</th>";
                }
            }else{
                echo "Please Select a Topic";
            }

        ?>

</table>
>>>>>>> origin/master

</body>
</html>
