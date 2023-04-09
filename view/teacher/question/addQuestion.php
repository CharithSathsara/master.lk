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

            <p id="title"><b>Add New Question</b></p>

            <p class="subheading">Question&nbsp;&nbsp;</p>

            <div class="form-container">

                <form id="add-question-form" action="../../../controller/teacherController/questionController/addQuestionController.php" method="post" >

                    <p id="add_question-heading">You can add questions to <?= $_SESSION['subject']; ?> subject:</p>

                    <div class="form-inline">

                        <label for="topicId" class="topic-selection">Select Topic :</label>
                        <select name="topicId" style="margin-right: 8vw" class="type-selection">

                            <option value="" selected>-- Select a topic --</option>
                            <?php

                            $topics = $viewQuestionController->getAllTopics($_SESSION['subject']);

                            foreach($topics as $topic){
                                echo "<option value=\"{$topic['topicId']}\">{$topic['topicTitle']}</option>";
                            }

                            ?>

                        </select>

                        <label for="type"  class="topic-selection">Select Type :</label>
                        <select name="type" class="type-selection" >
                            <option value="" selected>-- Select a type --</option>
                            <option value="PASTQUESTION">Past Question</option>
                            <option value="MODELQUESTION">Model Question</option>
                        </select>

                    </div>

                    <textarea name="question" rows="5" cols="93" placeholder="Enter the Question Here" required></textarea>

                    <div class="form-inline">

                        <input type="text" placeholder="Answer 1" name="answer1" required>

                        <label for="correctAnswer" style="margin-left: 8vw" class="topic-selection">Correct Answer :</label>
                        <select name="correctAnswer" required>
                            <option value="" selected>-- Select a answer --</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>

                    </div>

                    <div class="answer-group" style="display: flex;flex-direction: column;">

                        <input type="text" placeholder="Answer 2" name="answer2" required>

                        <input type="text" placeholder="Answer 3" name="answer3" required>

                        <input type="text" placeholder="Answer 4" name="answer4" required>

                        <input type="text" placeholder="Answer 5" name="answer5" required>

                    </div>

                    <textarea name="description" rows="4" cols="75" placeholder="Answer Description" required></textarea>

                    <div style="display:grid; justify-content: right">
                        <input type="submit" name="add-question" value="Save">
                    </div>

                </form>

            </div>
        </div>
    </div>

</div>

</body>
</html>
