<?php

// Get the absolute path of the current directory
$currentDir = __DIR__;

// Include the files using the dynamic path
include_once $currentDir . '/../../config/app.php';
include_once $currentDir . '/../../controller/profileController/profilePhotoViewController.php';
include_once $currentDir . '/../../model/User.php';


$profilePhotoViewController = new profilePhotoViewController();

//Navigation Bar Highlighting

$current_url = $_SERVER['REQUEST_URI'];
$page_name = basename(parse_url($current_url, PHP_URL_PATH));

if (in_array($page_name, $_SESSION['teacherNavItems-dashboard'])){
    echo "
    <style>
        #dashboard{
            background-color:#edecec;
        }
    </style>
    ";
}
else if (in_array($page_name, $_SESSION['teacherNavItems-quizDetails'])){
    echo "
    <style>
        #quizDetails{
            background-color:#edecec;
        }
    </style>
    ";
}
else if (in_array($page_name, $_SESSION['teacherNavItems-studentDetails'])){
    echo "
    <style>
        #studentDetails{
            background-color:#edecec;
        }
    </style>
    ";
}
else if (in_array($page_name, $_SESSION['teacherNavItems-qaForum'])){
    echo "
    <style>
        #qaForum{
            background-color:#edecec;
        }
    </style>
    ";
}
else if (in_array($page_name, $_SESSION['teacherNavItems-feedbacks'])){
    echo "
    <style>
        #feedbacks{
            background-color:#edecec;
        }
    </style>
    ";
}
else if (in_array($page_name, $_SESSION['teacherNavItems-profile'])){
    echo "
    <style>
        #profile{
            background-color:#edecec;
        }
    </style>
    ";
}

?>

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

    <title></title>
</head>

<body>
    <div id="teacher-nav" class="nav">
        <div class="prof-detail">
            <div class="circle">
                <img id='profile-pic' src='<?=$profilePhotoViewController->getProfilePhoto();?>'/>;
            </div>
            <p id="user-name"><?= $_SESSION['auth_user']['userFirstName'] ?>&nbsp;<?= $_SESSION['auth_user']['userLastName'] ?></p>
            <p id="role"><?= $_SESSION['auth_role']?></p>
        </div>
        <div class="nav-items">
            <ul>
                <li class="nav-item"  id="dashboard">
                    <a href=<?= base_url('view/teacher/teacherDashboard.php') ?>>
                        <div class="list-item" >
                            <img src=<?= base_url('public/icons/dashboard.svg') ?> class="list-icon">
                            <p class="list-text">Dashboard</p>
                        </div>
                    </a>
                </li>
                <li class="nav-item"  id="quizDetails">
                    <a href=<?= base_url('view/teacher/quizDetails/viewQuizDetails.php') ?>>
                        <div class="list-item" >
                            <img src=<?= base_url('public/icons/quizDetails.svg') ?> class="list-icon">
                            <p class="list-text">Quiz Details</p>
                        </div>
                    </a>
                </li>
                <li class="nav-item"  id="studentDetails">
                    <a href=<?= base_url('view/teacher/studentDetails/viewStudentDetails.php') ?>>
                        <div class="list-item" >
                            <img src=<?= base_url('public/icons/studentDetails.svg') ?> class="list-icon">
                            <p class="list-text">Student Details</p>
                        </div>
                    </a>
                </li>
                <li class="nav-item"  id="qaForum">
                    <a href=<?= base_url('view/teacher/q_and_a_forum/forum_teacher.php') ?>>
                        <div class="list-item" >
                            <img src=<?= base_url('public/icons/q&a.svg') ?> class="list-icon">
                            <p class="list-text">Q and A Forum</p>
                        </div>
                    </a>
                </li>
                <li class="nav-item"  id="feedbacks">
                    <a href=<?= base_url('view/teacher/feedbacks/viewFeedbacks.php') ?>>
                        <div class="list-item" >
                            <img src=<?= base_url('public/icons/feedbacks.svg') ?> class="list-icon">
                            <p class="list-text">Feedbacks</p>
                        </div>
                    </a>
                </li>
                <hr id="nav-hr">
                <li class="nav-item"  id="profile">
                    <a href="../common/profile.php">
                    <a href=<?= base_url('view/common/profile.php') ?>>
                        <div class="list-item">
                            <img src=<?= base_url('public/icons/profile.svg') ?> class="list-icon">
                            <p class="list-text">Profile</p>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</body>
</html>