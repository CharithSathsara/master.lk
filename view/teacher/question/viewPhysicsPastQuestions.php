<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../public/css/styles.css?<?php echo time(); ?>">
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
            font-size: 1vw;
        }
        .buttons{
            display: flex;
            justify-content: right;
        }
        input[type=submit] {
            padding: 12px 20px;
            margin: 8px 0;
            border-radius: 5px;
            background: #219ebc;
            box-sizing: border-box;
            font-weight: bold;
            cursor: pointer;
            transition-duration: 0.4s;
            color: #DCDCDC;
        }
        #delete-btn{
            background: #f49f0a;
            margin-left: 10px;
        }
        #delete-btn:hover{
            background-color: white;
            color: #f49f0a;
            font-weight: bold;
        }

    </style>

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

        <p id="title"><a href="#">Physics > </a><a href="##">Past Paper</a></p>
        <p class="subheading">Questions &nbsp;&nbsp;&nbsp;</p>
        <br>

        <div style="margin-right: 100px;">

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
                                    Question : <?=$row['question'] ?>
                                    <br>
                                    <br>
                                    1) <?=$row['opt01'] ?>
                                    <br>
                                    2) <?=$row['opt02'] ?>
                                    <br>
                                    3) <?=$row['opt03'] ?>
                                    <br>
                                    4) <?=$row['opt04'] ?>
                                    <br>
                                    5) <?=$row['opt05'] ?>
                                    <br>
                                    <br>
                                    Correct Answer : <?=$row['correctAnswer'] ?>
                                    <br>
                                    <br>
                                    <br>
                                    <div class="buttons">
                                        <input type="submit" name="update-question" onclick="" value="Update">
                                        <a href="../../../controller/teacherController/questionController/deleteQuestionController.php?question_id=<?php echo $row['questionId'] ?>">
                                            <input type="submit" id="delete-btn" name="delete-question" onclick="" value="Delete">
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <?php
                        }

                    }else{
                        echo "<div style='color: orange;margin-left: 30vw'>{$_GET['topic']}<br>No Questions to View<br> <img style='width: 12vw;height: 25vh' src='../../../public/img/search.png' /></div>";
                    }
                }else{
                    echo "<div style='color: orange;margin-left: 30vw'>Please Select a Topic <br> <img style='width: 10vw;height: 25vh' src='../../../public/img/search.png' /></div>";
                }

                ?>

            </table>

        </div>

        </div>

    </div>


</div>

</body>
</html>
