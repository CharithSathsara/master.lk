<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="../../public/css/styles.css">

    <script>
        function redirect(page) {
            window.location.href = "question/" + page + ".php";
        }
    </script>

</head>

<style>

    .subheading{
        text-align: left;
        position: relative;
        color: blueviolet;
    }
    .subheading:before{
        content:'';
        display:block;
        height:2px;
        background:blue;
        position:absolute;
        left:80px;
        right:0;
        top:50%;
    }
    .container-01,.container-02{
        display: flex;
        justify-content: center;
    }
    .main-card{
        background:white;
        border-radius: 15px;
        width: 70vw;
        margin: 10px;
        padding: 10px;
        text-align: center;
        box-shadow: 1px 1px 4px 4px #DCDCDC;
    }
    .card-01{
        background:yellow;
        border-radius: 15px;
        padding: 20px;
        width: 30vw;
        margin: 10px;
    }
    .card-02{
        background:blueviolet;
        border-radius: 15px;
        padding: 20px;
        width: 30vw;
        margin: 10px;
    }
    .main-card:hover, .card-01:hover, .card-02:hover{
        cursor: pointer;
        transform: scale(1.009);
        transition: all 0.3s ease;
    }
    .add-question-btn {
        background-color: #008CBA;
        border: 2px solid #008CBA;
        padding: 10px;
        border-radius: 7px;
        font-weight: bold;
        color: white;
        cursor: pointer;
        transition-duration: 0.4s;
    }

    .add-question-btn:hover {
        background-color: white;
        color: #008CBA;
        font-weight: bold;
    }

</style>

<body>

<?php

include_once('../../config/app.php');
include_once('../../controller/authController/authentication/Authentication.php');
include_once('../../controller/authController/authorization/Authorization.php');

//User Authentication
Authentication::userAuthentication();
//User Authorization
Authorization::authorizingTeacher();

include_once('../common/header.php');
include_once('../common/navBar-Teacher.php');

?>

<header>
    <nav>
        <ul>
            <?php if(isset($_SESSION['authenticated'])) : ?>
                <li>
                    <form action="../../controller/authController/authentication/login/login.php" method="post">
                        <button type="submit" name="logout" style="margin:10px">Log Out <?= $_SESSION['auth_user']['userName']; ?> </button>
                    </form>
                </li>
            <?php else : ?>
                <li>
                    <button><a href="<?php base_url('view/authentication/index.php') ?>"> Login </a></button>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<h1>Dashboard</h1>

<?php

include('../../controller/authController/message.php');
include('../../controller/teacherController/dashboardController/DashboardController.php');
include('../../model/Question.php');

$dashboardController = new DashboardController();

?>

<p class="subheading">Questions</p>

<section class="container-01">

    <div class="main-card">
        <h2><?= $dashboardController->getCountOfAllQuestions() ; ?> Questions are in the system </h2>
        <br>
        <input class="add-question-btn" type="submit" onclick="redirect('addQuestion')" value="Add New Question">
    </div>

</section>

<section class="container-02">

    <div class="card-01">
        <h2>Physics</h2>
        <h3><?= $dashboardController->getNoOfQuestions("Physics") ; ?> Questions are in the system </h3>
        <input class="add-question-btn" type="submit" onclick="redirect('viewPhysicsModelQuestions')" value="Model Paper">
        <br>
        <br>
        <input class="add-question-btn" type="submit" onclick="redirect('viewPhysicsPastQuestions')" value="Past Paper">
    </div>

    <div class="card-02">
        <h2>Chemistry</h2>
        <h3><?= $dashboardController->getNoOfQuestions("Chemistry") ; ?> Questions are in the system </h3>
        <input class="add-question-btn" type="submit" onclick="redirect('viewChemistryModelQuestions')" value="Model Paper">
        <br>
        <br>
        <input class="add-question-btn" type="submit" onclick="redirect('viewChemistryPastQuestions')" value="Past Paper">
    </div>

</section>

</body>
</html>