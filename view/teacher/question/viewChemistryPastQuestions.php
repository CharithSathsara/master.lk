<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chemistry Past Questions</title>

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

    <script>
        function showTable(){
            document.getElementById('table').style.visibility = "visible";
        }
    </script>

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

<h3>Questions</h3>

<form action="" method="get">

    <label for="topic">Select Topic :</label>
    <select name="topic">

        <?php

        $topics = $viewQuestionController->getAllTopics("Chemistry");

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

        $questions = $viewQuestionController->viewQuestions("Chemistry", $_GET['topic'], "PASTQUESTION");
        echo "<th>Chemistry : {$_GET['topic']} : Past Questions</th>";

        if($questions){

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
            echo "<th>Chemsitry : {$_GET['topic']} : Past Questions<br>No Questions to View</th>";
        }
    }else{
        echo "Please Select a Topic";
    }

    ?>

</table>

</body>
</html>
