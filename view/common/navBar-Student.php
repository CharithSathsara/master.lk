<?php

include_once('../../config/app.php');
include('../../controller/profileController/profilePhotoViewController.php');
include('../../model/User.php');
$profilePhotoViewController = new profilePhotoViewController();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/navBar.css?<?php echo time(); ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <title></title>
</head>
<body>
    <div id="student-nav" class="nav">
        <div class="prof-detail">
            <div class="circle">
                <?=$profilePhotoViewController->getProfilePhoto();?>
            </div>

            <p id="user-name"><?= $_SESSION['auth_user']['userFirstName'] ?>&nbsp;<?= $_SESSION['auth_user']['userLastName'] ?></p>
            <p id="role"><?= $_SESSION['auth_role']?></p>
        </div>
        <div class="nav-items">
            <ul>
                <li class="nav-item"  id="dashboard">
                    <a href="../student/studentDashboard.php" onclick="changeToDashboard()">
                        <div class="list-item" >
                            <img src="../../public/icons/dashboard.svg" class="list-icon">
                            <p class="list-text">Dashboard</p>
                        </div>
                    </a>
                </li>
                <li class="nav-item"  id="newSubjects">
                    <a href="../student/newSubjects.php" onclick="changeToNewSubjects()">
                        <div class="list-item" >
                            <img src="../../public/icons/newSubjects.svg" class="list-icon">
                            <p class="list-text">New Subjects</p>
                        </div>
                    </a>
                </li>
                <hr id="nav-hr">
                <li class="nav-item"  id="profile">
                    <a href="../common/profile.php" onclick="changeToProfile()">
                        <div class="list-item">
                            <img src="../../public/icons/profile.svg" class="list-icon">
                            <p class="list-text">Profile</p>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <script src="../../public/js/navBar.js"></script>

</body>
</html>