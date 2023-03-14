<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../../public/css/QandA_Forum.css?<?php echo time(); ?>">
    <title>Real-time Q&A Forum Teacher</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

<?php

include_once('../../../controller/authController/authentication/Authentication.php');
include_once('../../../controller/authController/authorization/Authorization.php');
include_once '../../../config/app.php';
include_once '../../common/header.php';

//User Authentication
Authentication::userAuthentication();
//User Authorization
Authorization::authorizingTeacher();

?>

<div class="content">

    <?php include_once '../../common/navBar-Teacher.php'; ?>

    <div class="main" id="main">

        <div id="dashboard-container">
            <p id="title"><b>Q&amp;A Forum</b></p>
        </div>

        <div id="container" class="container"></div>
        <script src="../../../public/js/q_and_a_forum_teacher.js"></script>

    </div>

</div>

</body>

</html>
