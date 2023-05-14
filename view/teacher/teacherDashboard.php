<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="../../public/css/styles.css?<?php echo time(); ?>">

    <script>
        function redirect(page) {
            window.location.href = "question/" + page + ".php";
        }
    </script>

</head>
<body>

<?php

include_once('../../config/app.php');
include_once('../../controller/authController/authentication/Authentication.php');
include_once('../../controller/authController/authorization/Authorization.php');

//User Authentication
Authentication::userAuthentication();
//User Authorization
Authorization::authorizingTeacher();

include_once '../common/header.php';

$_SESSION['teacherNavItems-dashboard'] = array();
array_push($_SESSION['teacherNavItems-dashboard'], 'teacherDashboard.php', 'addQuestion.php', 'viewPhysicsModelQuestions.php','viewPhysicsPastQuestions.php',
'viewChemistryModelQuestions.php','viewChemistryPastQuestions.php');

$_SESSION['teacherNavItems-quizDetails'] = array();
array_push($_SESSION['teacherNavItems-quizDetails'], 'viewQuizDetails.php');

$_SESSION['teacherNavItems-studentDetails'] = array();
array_push($_SESSION['teacherNavItems-studentDetails'], 'viewStudentDetails.php');

$_SESSION['teacherNavItems-qaForum'] = array();
array_push($_SESSION['teacherNavItems-qaForum'], 'forum_teacher.php');

$_SESSION['teacherNavItems-feedbacks'] = array();
array_push($_SESSION['teacherNavItems-feedbacks'], 'viewFeedbacks.php');

$_SESSION['teacherNavItems-profile'] = array();
array_push($_SESSION['teacherNavItems-profile'], 'profile.php');

?>

<div class="content">

    <?php include_once '../common/navBar-Teacher.php'; ?>

    <div class="main">

        <div id="dashboard-container">

            <p id="title"><b>Dashboard</b></p>

        <?php

        include('../../controller/teacherController/dashboardController/DashboardController.php');
        include('../../model/Question.php');

        $dashboardController = new DashboardController();

        ?>

        <p class="subheading">Questions &nbsp;&nbsp;&nbsp;</p><br>

        <section class="container-01">

            <div class="main-card">
                <?php include('../../controller/authController/message.php') ?>
                <h3><span class="no-of-qs"><?= $dashboardController->getCountOfAllQuestions() ; ?></span> &nbsp;Questions Are in the System </h3>
                <input class="add-question-btn" id="add-question-btn" type="submit" onclick="redirect('addQuestion')" value="Add New Question">
            </div>

        </section>

        <section class="container-02">

            <div class="card-01">
                <b><p class="card-topic" id="card-topic-phy">Physics</p></b>
                <div class="card-content">
                    <p id="no-of-questions-phy" class="no-of-questions"><span class="no-of-qs"><?= $dashboardController->getNoOfQuestions("Physics") ; ?></span> Questions</p>
                    <input class="view-question-btn" id="view-question-btn" type="submit" onclick="redirect('viewPhysicsModelQuestions')" value="Model Paper">
                    <input class="view-question-btn" id="view-question-btn" type="submit" onclick="redirect('viewPhysicsPastQuestions')" value="Past Paper">
                </div>
            </div>

            <div class="card-02">
                <b><p class="card-topic">Chemistry</p></b>
                <div class="card-content">
                    <p id="no-of-questions-chem" class="no-of-questions"><span class="no-of-qs"><?= $dashboardController->getNoOfQuestions("Chemistry") ; ?></span> Questions</p>
                    <input class="view-question-btn" id="view-question-btn" type="submit" onclick="redirect('viewChemistryModelQuestions')" value="Model Paper">
                    <input class="view-question-btn" id="view-question-btn" type="submit" onclick="redirect('viewChemistryPastQuestions')" value="Past Paper">
                </div>
            </div>

        </section>

        </div>
    </div>
</div>


<div class="page-mask" id="page-mask-upload-question-success">

    <div id="upload-success-popup">
        <img id="success-icon" src="../../public/icons/success-yellow.svg">
        <b><p id="upload-title">Updated Successfully!</p></b>
        <button onclick="closeUpdatePopup()" class="close-button">
            <img src="../../public/icons/close.svg" class="close-icon">
        </button>
        <p id="upload-success-text">Question has been updated successfully.</p>
        <button id="ok-btn" onclick="closeUpdatePopup()">OK</button>
    </div>

</div>

<div class="page-mask" id="page-mask-upload-question-fail">

    <div id="upload-success-popup">
        <img id="success-icon" src="../../public/icons/delete-alert.png">
        <b><p id="upload-title">Question update failed!</p></b>
        <button onclick="closeUploadFailPopup()" class="close-button">
            <img src="../../public/icons/close.svg" class="close-icon">
        </button>
        <div id="question-upload-error">
            <p><?= $_SESSION['question-update-fail']; ?></p>
        </div>
        <button id="ok-btn" onclick="closeUploadFailPopup()">OK</button>
    </div>

</div>

<div class="page-mask" id="page-mask-delete-question-success">

    <div id="upload-success-popup">
        <img id="success-icon" src="../../public/icons/success-yellow.svg">
        <b><p id="upload-title">Deleted Successfully!</p></b>
        <button onclick="closeDeletePopup()" class="close-button">
            <img src="../../public/icons/close.svg" class="close-icon">
        </button>
        <p id="upload-success-text">Question has been deleted successfully.</p>
        <button id="ok-btn" onclick="closeDeletePopup()">OK</button>
    </div>

</div>

<div class="page-mask" id="page-mask-delete-question-fail">

    <div id="upload-success-popup">
        <img id="success-icon" src="../../public/icons/delete-alert.png">
        <b><p id="upload-title">Question update failed!</p></b>
        <button onclick="closeDeletePopup()" class="close-button">
            <img src="../../public/icons/close.svg" class="close-icon">
        </button>
        <div id="question-upload-error">
            <p>Question was not deleted</p>
        </div>
        <button id="ok-btn" onclick="closeDeletePopup()">OK</button>
    </div>

</div>

<script src="../../public/js/updateQuestion.js"></script>

<?php

if(isset($_SESSION['question-update-success'])){
    echo"
                <style>
                        #page-mask-upload-question-success {
                            display:block;
                        }
                </style>
            ";
    unset($_SESSION['question-update-success']);
}

if(isset($_SESSION['question-update-fail'])){
    echo"
                <style>
                        #page-mask-upload-question-fail {
                            display:block;
                        }
                </style>
            ";
    unset($_SESSION['question-update-fail']);
}

if(isset($_SESSION['question-delete-success'])){
    echo"
                <style>
                        #page-mask-delete-question-success {
                            display:block;
                        }
                </style>
            ";
    unset($_SESSION['question-delete-success']);
}

if(isset($_SESSION['question-delete-fail'])){
    echo"
                <style>
                        #page-mask-delete-question-fail {
                            display:block;
                        }
                </style>
            ";
    unset($_SESSION['question-delete-fail']);
}

?>

</body>
</html>
