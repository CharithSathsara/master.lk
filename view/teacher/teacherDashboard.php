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

</body>
</html>
