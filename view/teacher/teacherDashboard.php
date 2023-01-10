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

        <p id="title">Dashboard</p>

        <?php

        include('../../controller/teacherController/dashboardController/DashboardController.php');
        include('../../model/Question.php');

        $dashboardController = new DashboardController();

        ?>

        <p class="subheading">Questions &nbsp;&nbsp;&nbsp;</p>

        <br>

        <section class="container-01">

            <div class="main-card">
                <?php include('../../controller/authController/message.php') ?>
                <br>
                <h3><?= $dashboardController->getCountOfAllQuestions() ; ?> Questions are in the system </h3>
                <br>
                <input class="add-question-btn" type="submit" onclick="redirect('addQuestion')" value="Add New Question">
            </div>

        </section>

        <section class="container-02">

            <div class="card-01">
                <p>Physics</p><br>
                <div class="card-content">
                    <p><?= $dashboardController->getNoOfQuestions("Physics") ; ?> Questions</p><br>
                    <input class="add-question-btn" type="submit" onclick="redirect('viewPhysicsModelQuestions')" value="Model Paper">
                    <br>
                    <input class="add-question-btn" type="submit" onclick="redirect('viewPhysicsPastQuestions')" value="Past Paper">
                </div>
            </div>

            <div class="card-02">
                <p>Chemistry</p><br>
                <div class="card-content">
                    <p><?= $dashboardController->getNoOfQuestions("Chemistry") ; ?> Questions</p><br>
                    <input class="add-question-btn" type="submit" onclick="redirect('viewChemistryModelQuestions')" value="Model Paper">
                    <br>
                    <input class="add-question-btn" type="submit" onclick="redirect('viewChemistryPastQuestions')" value="Past Paper">
                </div>
            </div>

        </section>

        </div>

    </div>

</div>

</body>
</html>
