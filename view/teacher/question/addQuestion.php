<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../public/css/addQuestion.css?<?php echo time(); ?>">
    <title>Add Question Page</title>
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
        <div id="container">
            <b><p id="title"><a href="../../../view/teacher/teacherDashboard.php"><span id="dashboard-shortcut">Dashboard</span></a>&nbsp;&nbsp;>&nbsp;&nbsp;Add New Question</p></b>
            <p class="subheading">Question&nbsp;&nbsp;</p>

            <div class="form-container">

                <form id="add-question-form" action="../../../controller/teacherController/questionController/addQuestionController.php" method="post" >

                    <p id="add_question-heading">You can add questions to <?= $_SESSION['subject']; ?> subject</p>

                    <div class="form-inline">

                        <label for="topicId" class="topic-selection">Select Topic :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <select name="topicId" style="margin-right: 14.5vw" class="type-selection" required>

                            <option value="" selected>-- Select a topic --</option>
                            <?php

                            $topics = $viewQuestionController->getAllTopics($_SESSION['subject']);

                            foreach($topics as $topic){
                                echo "<option value=\"{$topic['topicId']}\">{$topic['topicTitle']}</option>";
                            }

                            ?>

                        </select>

                        <label for="type"  class="topic-selection">Select Type : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <select name="type" class="type-selection" required>
                            <option value="" selected>-- Select a type --</option>
                            <option value="PASTQUESTION">Past Question</option>
                            <option value="MODELQUESTION">Model Question</option>
                        </select>

                    </div>

                    <textarea name="question" rows="6" cols="93" placeholder="Enter the Question Here" required></textarea>

                    <div class="form-inline">

                        <input type="text" placeholder="Answer 1" name="answer1" required>

                        <label for="correctAnswer" style="margin-left: 10vw" class="topic-selection">Correct Answer :&nbsp;&nbsp;&nbsp;</label>
                        <select name="correctAnswer" required>
                            <option value="" selected>-- Select a answer --</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>

                    </div>

                    <div class="answer-group" style="display: flex;flex-direction: row;">

                        <input type="text" placeholder="Answer 2" name="answer2" required>

                        <input type="text" placeholder="Answer 3" name="answer3" style="margin-left: 10.5vw" required>


                    </div>

                    <div class="answer-group" style="display: flex;flex-direction: row;">

                        <input type="text" placeholder="Answer 4" name="answer4" required>

                        <input type="text" placeholder="Answer 5" name="answer5" style="margin-left: 10.5vw" required>

                    </div>

                    <textarea name="description" rows="4" cols="75" placeholder="Answer Description" required></textarea>

                    <div style="display:grid; justify-content: right">
                        <input type="submit" name="add-question" value="Save" id="add-question">
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<div class="page-mask" id="page-mask-upload-question-success">

    <div id="upload-success-popup">
        <img id="success-icon" src="../../../public/icons/success-yellow.svg">
        <b><p id="upload-title">Inserted Successfully!</p></b>
        <button onclick="closeUploadSuccessPopup()" class="close-button">
            <img src="../../../public/icons/close.svg" class="close-icon">
        </button>
        <p id="upload-success-text">Question has been successfully uploaded.</p>
        <button id="ok-btn" onclick="closeUploadSuccessPopup()">OK</button>
    </div>

</div>

<div class="page-mask" id="page-mask-upload-question-fail">

    <div id="upload-success-popup">
        <img id="success-icon" src="../../../public/icons/delete-alert.png">
        <b><p id="upload-title">Question upload failed!</p></b>
        <button onclick="closeUploadFailPopup()" class="close-button">
            <img src="../../../public/icons/close.svg" class="close-icon">
        </button>
        <div id="question-upload-error">
            <p><?= $_SESSION['question-upload-fail']; ?></p>
        </div>
        <button id="ok-btn" onclick="closeUploadFailPopup()">OK</button>
    </div>

</div>

<script src="../../../public/js/addQuestion.js"></script>

<?php

if(isset($_SESSION['question-upload-success'])){
    echo"
                <style>
                        #page-mask-upload-question-success {
                            display:block;
                        }
                </style>
            ";
    unset($_SESSION['question-upload-success']);
}

if(isset($_SESSION['question-upload-fail'])){
    echo"
                <style>
                        #page-mask-upload-question-fail {
                            display:block;
                        }
                </style>
            ";
    unset($_SESSION['question-upload-fail']);
}

?>

</body>
</html>
