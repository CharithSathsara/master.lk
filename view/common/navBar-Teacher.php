<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?= base_url('public/css/navBar.css') ?>>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <title>Teacher Navigation Bar</title>
</head>
<body>
    <div id="teacher-nav" class="nav">
        <div class="prof-detail">
            <img src=<?= base_url('public/img/default-profPic.png') ?> id="prof-pic"><br>
            <p id="user-name"><?= $_SESSION['auth_user']['fName']?> <?= $_SESSION['auth_user']['lName']?></p>
            <p id="role"><?= $_SESSION['auth_role']?></p>
        </div>
        <div class="nav-items">
            <ul>
                <li class="nav-item"  id="dashboard">
                    <a href="">
                        <div class="list-item" >
                            <img src=<?= base_url('public/icons/dashboard.svg') ?> class="list-icon">
                            <p class="list-text">Dashboard</p>
                        </div>
                    </a>
                </li>
                <li class="nav-item"  id="quizDetails">
                    <a href="">
                        <div class="list-item" >
                            <img src=<?= base_url('public/icons/quizDetails.svg') ?> class="list-icon">
                            <p class="list-text">Quiz Details</p>
                        </div>
                    </a>
                </li>
                <li class="nav-item"  id="studentDetails">
                    <a href="">
                        <div class="list-item" >
                            <img src=<?= base_url('public/icons/studentDetails.svg') ?> class="list-icon">
                            <p class="list-text">Student Details</p>
                        </div>
                    </a>
                </li>
                <li class="nav-item"  id="feedbacks">
                    <a href="">
                        <div class="list-item" >
                            <img src=<?= base_url('public/icons/feedbacks.svg') ?> class="list-icon">
                            <p class="list-text">Feedbacks</p>
                        </div>
                    </a>
                </li>
                <hr id="nav-hr">
                <li class="nav-item"  id="profile">
                    <a href="">
                        <div class="list-item">
                            <img src=<?= base_url('public/icons/profile.svg') ?> class="list-icon">
                            <p class="list-text">Profile</p>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- <script src="../../public/js/navBar.js"></script> -->

</body>
</html>