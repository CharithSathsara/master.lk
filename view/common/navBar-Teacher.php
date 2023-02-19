<<<<<<< HEAD
=======
<?php

include_once('../../config/app.php');
// include_once('../../controller/authController/authentication/Authentication.php');
// include_once('../../controller/authController/authorization/Authorization.php');

// //User Authentication
// Authentication::userAuthentication();
// //User Authorization
// Authorization::authorizingStudent();

?>

>>>>>>> origin/master
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <link rel="stylesheet" href=<?= base_url('public/css/navBar.css') ?>>
=======
    <link rel="stylesheet" href="../../public/css/navBar.css?<?php echo time(); ?>">
>>>>>>> origin/master

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

<<<<<<< HEAD
    <title>Teacher Navigation Bar</title>
</head>

<body>
    <div id="teacher-nav" class="nav">
        <div class="prof-detail">
            <img src=<?= base_url('public/img/default-profPic.png') ?> id="prof-pic"><br>
=======
    <title></title>
</head>
<body>
    <div id="teacher-nav" class="nav">
        <div class="prof-detail">
            <img src="../../public/img/default-profPic.png" id="prof-pic"><br>
>>>>>>> origin/master
            <p id="user-name"><?= $_SESSION['auth_user']['userFirstName'] ?>&nbsp;<?= $_SESSION['auth_user']['userLastName'] ?></p>
            <p id="role"><?= $_SESSION['auth_role']?></p>
        </div>
        <div class="nav-items">
            <ul>
                <li class="nav-item"  id="dashboard">
<<<<<<< HEAD
                    <a href=<?= base_url('view/teacher/teacherDashboard.php') ?>>
                        <div class="list-item" >
                            <img src=<?= base_url('public/icons/dashboard.svg') ?> class="list-icon">
=======
                    <a href="">
                        <div class="list-item" >
                            <img src="../../public/icons/dashboard.svg" class="list-icon">
>>>>>>> origin/master
                            <p class="list-text">Dashboard</p>
                        </div>
                    </a>
                </li>
                <li class="nav-item"  id="quizDetails">
<<<<<<< HEAD
                    <a href=<?= base_url('view/teacher/quizDetails/viewQuizDetails.php') ?>>
                        <div class="list-item" >
                            <img src=<?= base_url('public/icons/quizDetails.svg') ?> class="list-icon">
=======
                    <a href="">
                        <div class="list-item" >
                            <img src="../../public/icons/quizDetails.svg" class="list-icon">
>>>>>>> origin/master
                            <p class="list-text">Quiz Details</p>
                        </div>
                    </a>
                </li>
                <li class="nav-item"  id="studentDetails">
<<<<<<< HEAD
                    <a href=<?= base_url('view/teacher/studentDetails/viewStudentDetails.php') ?>>
                        <div class="list-item" >
                            <img src=<?= base_url('public/icons/studentDetails.svg') ?> class="list-icon">
=======
                    <a href="">
                        <div class="list-item" >
                            <img src="../../public/icons/studentDetails.svg" class="list-icon">
>>>>>>> origin/master
                            <p class="list-text">Student Details</p>
                        </div>
                    </a>
                </li>
                <li class="nav-item"  id="feedbacks">
<<<<<<< HEAD
                    <a href=<?= base_url('view/teacher/feedbacks/viewFeedbacks.php') ?>>
                        <div class="list-item" >
                            <img src=<?= base_url('public/icons/feedbacks.svg') ?> class="list-icon">
=======
                    <a href="">
                        <div class="list-item" >
                            <img src="../../public/icons/feedbacks.svg" class="list-icon">
>>>>>>> origin/master
                            <p class="list-text">Feedbacks</p>
                        </div>
                    </a>
                </li>
                <hr id="nav-hr">
                <li class="nav-item"  id="profile">
                    <a href="../common/profile.php">
<<<<<<< HEAD
                    <a href=<?= base_url('view/common/profile.php') ?>>
                        <div class="list-item">
                            <img src=<?= base_url('public/icons/profile.svg') ?> class="list-icon">
=======
                        <div class="list-item">
                            <img src="../../public/icons/profile.svg" class="list-icon">
>>>>>>> origin/master
                            <p class="list-text">Profile</p>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
<<<<<<< HEAD
=======

    <!-- <script src="../../public/js/navBar.js"></script> -->

>>>>>>> origin/master
</body>
</html>