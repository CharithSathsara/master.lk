<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Page Title -->
    <title>Content Creator Dashboard</title>
    <link rel="shortcut icon" type="image" id="#header-image" href="../../public/img/master.svg">
    <style>
    #header-image {
        max-width: 20px;
        /* set the maximum width to 200 pixels */
        max-height: 10px;
        /* set the maximum height to 100 pixels */
        width: auto;
        /* set the width to auto to maintain aspect ratio */
    }
    </style>


    <!-- Include Page CSS Files -->
    <link rel="stylesheet" href="../../public/css/theoryQuestions.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <!-- Include jQuery and Javascript Files -->
    <script src="../../public/js/addTheoryContent.js"></script>
    <script src="../../public/js/updateTheory.js"></script>
    <script src="../../public/js/addTopic.js"></script>
    <script src="../../public/js/deleteTheory.js"></script>



</head>

<body>

    <?php

    // Include Controller Files
    include_once('../../model/GamifiedQuestion.php');
    include_once('../../controller/authController/authentication/Authentication.php');
    include_once('../../controller/authController/authorization/Authorization.php');
    include('../../controller/contentCreatorController/theoryContentController/viewTheoryContentController.php');
    include('../../controller/studentController/contentController/gamifiedQuestionsController.php');

    //check user authenticated or not
    //$authentication = new Authentication();
    //$authentication->authorizingAdmin();

    //User Authentication
    Authentication::userAuthentication();
    //User Authorization
    Authorization::authorizingContentCreator();

    // Create an instance of the ViewTheoryContentController() Class
    $viewTheoryContentController = new ViewTheoryContentController();
    $viewGamifiedQuestionsController = new gamifiedQuestionsController();

    $_SESSION['ccNavItems-dashboard'] = array();
    array_push($_SESSION['ccNavItems-dashboard'], 'contentCreatorDashboard.php', 'addTheory.php', 'updateTheory.php');

    $_SESSION['ccNavItems-theoryQuestions'] = array();
    array_push($_SESSION['ccNavItems-theoryQuestions'], 'theoryQuestions.php');

    $_SESSION['ccNavItems-profile'] = array();
    array_push($_SESSION['ccNavItems-profile'], 'profile.php');

    // Include Header and Navigation Bar Files
    include_once '../common/header.php';
    @include '../common/navBar-ContentCreator.php';

    ?>

    <div class="container">
        <div class="contentecreator-container">
            <!-- Title and SubTitle Section -->
            <div class="title"><b>Theory Questions</b></div>
            <div class="sub-elements">
                <p class="sub-title"><b>Questions&nbsp;&nbsp;&nbsp;</b></p>
                <hr class="hr-line">
            </div>



            <div class="select">
                <!-- View Theory Content Form -->
                <form action="" class="view-form" method="get">
                    <div class="selectSubject">
                        <p id="add_theory-heading">You Can View Theory Questions of the <?= $_SESSION['subject']; ?>
                            subject:</p>
                    </div>

                    <!-- Select Topic from Dropdown Menu -->
                    <div class="selectTopic">
                        <div class="selecttopic">
                            <label class="topicLabel">Select Topic:</label>
                            <select id="selecttopic" name="selectTopic" style="margin-right: 8vw" required>
                                <?php
                                // Load Topics to Dropdown Menu
                                $topics = $viewTheoryContentController->getAllTopics($_SESSION['subject']);

                                foreach ($topics as $topic) {
                                    echo "<option value=\"{$topic['topicTitle']}\">{$topic['topicTitle']}</option>";
                                }

                                ?>
                            </select>


                            <input type="submit" name="view-btn" value="View" id="view-btn" class="view-btn">
                        </div>

                        <br>
                    </div>



                </form>



                <!-- Right Side Button panel -->
                <div class="add-btns">
                    <ul class="btn-list">
                        <li><a href="addTheoryQuestion.php" class="add-btn-topic" id="add-btn-topic">Add
                                Questions</a></li>

                    </ul>
                </div>

                <!-- Dashboard Fixed Background Image -->
                <img src="../../public/img/fixed-img1.svg" id="fixed-image1">


                <!-- Table to view Loaded Theory Contents -->
                <table class="content-table">
                    <?php
                    $lesson = 2;

                    if (isset($_GET['view-btn'])) {
                        $questions = $viewGamifiedQuestionsController->getNewGamifiedQuestions($_GET['selectTopic']);
                        echo "<th>{$_GET['selectTopic']} : Gamified Questions</th>";

                        if (mysqli_num_rows($questions) > 0) {

                            foreach ($questions as $row) {
                    ?>

                    <tr>
                        <td>
                            <input class="questionId" type="hidden" name="questionId"
                                value=<?= $row['questionId'] ?>><br>
                            <p class="question">Question :<?= $row['question'] ?></p>
                            <br>
                            <br>
                            <p class="option1">1)<?= $row['opt01'] ?></p>
                            <br>
                            <p class="option2">2)<?= $row['opt02'] ?></p>
                            <br>
                            <p class="option3">3)<?= $row['opt03'] ?></p>
                            <br>
                            <p class="option4">4)<?= $row['opt04'] ?></p>
                            <br>
                            <p class="option5">5)<?= $row['opt05'] ?></p>
                            <br>
                            <br>
                            <p class="correct-answer">Correct Answer :<?= $row['correctAnswer'] ?></p>
                            <br>

                            <br>
                            <div class="buttons">
                                <input type="submit" class="update-button" name="update-question-btn"
                                    id="update-question-btn" value="Update">
                                <a
                                    href="../../../controller/contentCreatorController/theoryQuestionController/deleteTheoryQuestionController.php?question_id=<?php echo $row['questionId'] ?>">
                                    <input type="submit" id="delete-btn" name="delete-question" onclick=""
                                        value="Delete">
                                </a>
                            </div>
                        </td>
                    </tr>

                    <!--Update Question Form-->
                    <?php include_once '../contentcreator/updateTheoryQuestionForm.php'; ?>

                    <script src="../../public/js/updateTheoryQuestion.js"></script>


                    <br><br><br><br><br><br>
                    </form>

                    <?php   }
                        } else {
                            echo "<div id='no-contents'>
                              <p id='no-contents-text'><b></b>No Theory Questions Found! </b></p><br> 
                              </div>";
                        }
                    }
                    ?>

                </table>
                <br><br><br><br>
            </div>
        </div>
    </div>






    </div>
    </div>








</body>

</html>