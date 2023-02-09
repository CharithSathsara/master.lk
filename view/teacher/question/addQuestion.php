<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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

?>

<form action="../../../controller/teacherController/questionController/addQuestionController.php" method="post" >

    <div>

        <h1>Add Question</h1>
        <p>Please Fill in This Form to Add a Question</p>

        <?php include('../../../controller/authController/message.php') ?>

        <hr>

        <h2>You can add Questions to <?= $_SESSION['subject']; ?> Subject</h2>

        <label for="topicId">Select Topic :</label>
        <select name="topicId">

            <?php

            $topics = $viewQuestionController->getAllTopics($_SESSION['subject']);

            foreach($topics as $topic){
                echo "<option value=\"{$topic['topicId']}\">{$topic['topicTitle']}</option>";
            }

            ?>

        </select>

        <label for="type" style="margin-left: 21vw">Select Type :</label>
        <select name="type">
            <option value="PASTQUESTION">Past Question</option>
            <option value="MODELQUESTION">Model Question</option>
        </select>
        <br>
        <br>

        <textarea name="question" rows="5" cols="93" placeholder="Enter the Question Here" ></textarea>
        <br>
        <br>

        <input type="text" placeholder="Answer 1" name="answer1" >

        <label for="correctAnswer" style="margin-left: 25vw">Correct Answer :</label>
        <select name="correctAnswer">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <br>
        <br>

        <input type="text" placeholder="Answer 2" name="answer2" >
        <br>
        <br>

        <input type="text" placeholder="Answer 3" name="answer3" >
        <br>
        <br>

        <input type="text" placeholder="Answer 4" name="answer4" >
        <br>
        <br>

        <input type="text" placeholder="Answer 5" name="answer5" >
        <br>
        <br>

        <textarea name="description" rows="4" cols="75" placeholder="Answer Description"></textarea>
        <br>
        <br>

        <div>
            <button type="submit" class="" name="add-question">Save</button>
        </div>

    </div>

</form>

</body>
</html>
