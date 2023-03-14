<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../../public/css/QandA_Forum.css?<?php echo time(); ?>">
    <title>Real-time Q&A Forum Student</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>

<?php

include_once('../../../controller/authController/authentication/Authentication.php');
include_once('../../../controller/authController/authorization/Authorization.php');
include('../../../controller/q_and_a_controller/StudentForumController.php');
include_once '../../common/header.php';

//User Authentication
Authentication::userAuthentication();
//User Authorization
Authorization::authorizingStudent();

$studentForumController = new StudentForumController();

?>

<div class="content">

    <?php include_once '../../common/navBar-Teacher.php'; ?>

    <div class="main" id="main">

        <div id="dashboard-container">
            <p id="title"><b>Real-time Q&amp;A Forum(Student Side)</b></p>
        </div>

        <div id="container" class="container"></div>
        <div class="form-container">
            <form id="new-question-form">

                <select id="dropdown" name="dropdown">

                    <option value="">-- Select a topic --</option>
                    <optgroup label="Physics">

                        <?php

                        $phyTopics = $studentForumController->getAllTopics("Physics");

                        foreach($phyTopics as $topic){
                            echo "<option value=\"{$topic['topicId']}\">{$topic['topicTitle']}</option>";
                        }

                        ?>

                    </optgroup>

                    <optgroup label="Chemistry">

                        <?php

                        $chemTopics = $studentForumController->getAllTopics("Chemistry");

                        foreach($chemTopics as $topic){
                            echo "<option value=\"{$topic['topicId']}\">{$topic['topicTitle']}</option>";
                        }

                        ?>

                    </optgroup>
                </select>
                <input type="text" id="new-question" name="new-question" placeholder="Ask Your Question?">
                <button type="submit">Ask</button>
            </form>
        </div>
        <script src="../../../public/js/q_and_a_forum_student.js"></script>

    </div>

</div>

</body>

</html>