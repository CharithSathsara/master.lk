
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

if (in_array($page_name, $_SESSION['adminNavItems-dashboard'])){
    echo "
    <style>
        #dashboard{
            background-color:#edecec;
        }
    </style>
    ";
}
else if (in_array($page_name, $_SESSION['adminNavItems-payments'])){
    echo "
    <style>
        #payments{
            background-color:#edecec;
        }
    </style>
    ";
}
else if (in_array($page_name, $_SESSION['adminNavItems-systemInfo'])){
    echo "
    <style>
        #systemInfo{
            background-color:#edecec;
        }
    </style>
    ";
}
else if (in_array($page_name, $_SESSION['adminNavItems-profile'])){
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
    <link rel="stylesheet" href="<?= base_url('public/css/navBar.css') ?>?<?php echo time(); ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <title></title>
</head>
<body>
<div id="admin-nav" class="nav">
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
                <a href=<?= base_url('view/admin/adminDashboard.php') ?>>
                    <div class="list-item" >
                        <img src="<?= base_url('public/icons/dashboard.svg') ?>" class="list-icon">
                        <p class="list-text">Dashboard</p>
                    </div>
                </a>
            </li>
            <li class="nav-item"  id="payments">
                <a href=<?= base_url('view/admin/payment/paymentVerification.php') ?>>
                    <div class="list-item" >
                        <img src="<?= base_url('public/icons/payments.svg') ?>" class="list-icon">
                        <p class="list-text">Payments</p>
                    </div>
                </a>
            </li>

            <li class="nav-item"  id="systemInfo">
                <a href=<?= base_url('view/admin/systemInfo/systemInformation.php') ?>>
                    <div class="list-item" >
                        <img src="<?= base_url('public/icons/info.svg') ?>" class="list-icon">
                        <p class="list-text">System Info</p>
                    </div>
                </a>
            </li>
            <hr id="nav-hr">
            <li class="nav-item"  id="profile">
                <a href=<?= base_url('view/common/profile.php') ?>>
                    <div class="list-item">
                        <img src="<?= base_url('public/icons/profile.svg') ?>" class="list-icon">
                        <p class="list-text">Profile</p>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>




</body>
</html>