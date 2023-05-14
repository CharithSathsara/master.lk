<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../public/css/addTheoryQuestion.css ?>">
    <title>Add Question Page</title>
</head>

<body>

    <?php

    include_once('../../controller/authController/authentication/Authentication.php');
    include_once('../../controller/authController/authorization/Authorization.php');
    include('../../controller/contentCreatorController/theoryContentController/viewTheoryContentController.php');

    //User Authentication
    Authentication::userAuthentication();
    //User Authorization
    Authorization::authorizingContentCreator();
    $viewTheoryContentController = new ViewTheoryContentController();


    include_once '../common/header.php';

    ?>

    <div class="content">

        <?php include_once '../common/navBar-Teacher.php'; ?>

        <div class="main">

            <div id="dashboard-container">

                <p id="title"><b>Add New Theory Question</b></p>

                <p class="subheading">Question&nbsp;&nbsp;</p>

                <div style="margin-right: 100px;">

                    <form id="add-question-form"
                        action="../../controller/contentCreatorController/theoryContentController/addTheoryQuestionController.php"
                        method="post">

                        <p id="add_question-heading">You can add questions to <?= $_SESSION['subject']; ?> subject:</p>
                        <br>

                        <div class="form-inline">
                            <label for="topicId" class="topic-selection">Select Topic :</label>
                            <select name="topicId" style="margin-right: 8vw" class="type-selection">

                                <?php

                                $topics = $viewTheoryContentController->getAllTopics($_SESSION['subject']);

                                foreach ($topics as $topic) {
                                    echo "<option value=\"{$topic['topicId']}\">{$topic['topicTitle']}</option>";
                                }

                                ?>

                            </select>

                            <label for="type" class="topic-selection">Select Type :</label>
                            <select name="type" class="type-selection">
                                <option value="flip_cards">Flip Cards</option>

                            </select>
                            <br>
                            <br>
                        </div>

                        <textarea name="question" rows="5" cols="93" placeholder="Enter the Question Here"
                            required></textarea>
                        <br>
                        <br>

                        <div class="form-inline">
                            <input type="text" placeholder="Answer 1" name="answer1" required>
                            <label for="correctAnswer" style="margin-left: 7vw" class="topic-selection">Correct Answer
                                :</label>
                            <select name="correctAnswer">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <br>
                            <br>
                        </div>

                        <input type="text" placeholder="Answer 2" name="answer2" required>
                        <br>
                        <br>

                        <input type="text" placeholder="Answer 3" name="answer3" required>
                        <br>
                        <br>

                        <input type="text" placeholder="Answer 4" name="answer4" required>
                        <br>
                        <br>

                        <input type="text" placeholder="Answer 5" name="answer5" required>
                        <br>
                        <br>


                        <br>
                        <br>

                        <div style="display:grid; justify-content: right">
                            <input style="width: 10vw" type="submit" name="add-question" value="Save">
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</body>

</html>