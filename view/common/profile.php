<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="../../public/css/profile.css?<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
</head>
<body>

<?php

include_once('../../config/app.php');
// include_once('../../controller/authController/authentication/Authentication.php');
// include_once('../../controller/authController/authorization/Authorization.php');
include_once('../common/header.php');

if($_SESSION['auth_role']=='STUDENT'){
    include_once('./navBar-Student.php'); 
}else if($_SESSION['auth_role']=='ADMIN'){
    include_once('./navBar-Admin.php');
}else if($_SESSION['auth_role']=='TEACHER'){
    include_once('./navBar-Teacher.php');
}else{
    include_once('./navBar-ContentCreator.php');
}

include_once('../../controller/profileController/profileInfoController.php');
include_once('../../model/User.php');
include_once('../../model/Student.php');


//User Authentication
// Authentication::userAuthentication();
// //User Authorization
// Authorization::authorizingStudent();

$profileInfoController = new profileInfoController();


?>

<div id="profile-container">
    <div id="profile-contents">
        <b><p id="title">Profile Information</p></b>

        <div id="photo-password-container">

            <div class="photo-password-card" id="profilePhoto-card">
                <b><p class="card-title">Profile Photo</p></b>
                <button onclick="getPhotoUpdatePopup()" class="edit-button">
                    <img src="../../public/icons/edit.svg" class="edit-icon">
                </button>
                <!-- <object data="../../public/img/default-profPic.png" type="image/png" id="profile-photo"> -->
                <img id="profile-photo" src="data:image/jpg;charset=utf8;base64,
                <?php 
                include_once "../../controller/profileController/profilePhotoViewController.php" ?> 
                onerror="this.onerror=null; this.src='../../public/img/default-profPic.png'" />
                <!-- </object> -->
            </div>

            <div class="photo-password-card" id="password-card">
                <b><p class="card-title" id="pw-card-title">Change Password</p></b>
                <button onclick="getPwUpdatePopup()" class="edit-button">
                    <img src="../../public/icons/edit-black.svg" class="edit-icon" id="pw-edit-icon">
                </button>
            </div>

        </div>

        <div id="profile-info-container">
            <b><p class="card-title">Personal Details</p></b><br>
            <button onclick="getProfileInfoPopup()" class="edit-button">
                <img src="../../public/icons/edit.svg" class="edit-icon">
            </button>
            <div id="info-sec">
                <div id="first-info-sec">
                    <p class="profile-info-tag">First Name</p>
                    <p class="profile-info-data"><?= $profileInfoController->getProfileData("firstName") ; ?></p>
                    <p class="profile-info-tag">Date of Birth</p>
                    <p class="profile-info-data"><?= $profileInfoController->getProfileDataStudent() ; ?></p>
                    <p class="profile-info-tag">Address Line 01</p>
                    <p class="profile-info-data"><?= $profileInfoController->getProfileData("addLine01") ; ?></p>
                    <p class="profile-info-tag">Email</p>
                    <p class="profile-info-data"><?= $profileInfoController->getProfileData("email") ; ?></p>
                    <p class="profile-info-tag">Username</p>
                    <p class="profile-info-data"><?= $profileInfoController->getProfileData("userName") ; ?></p>
                </div>

                <div id="second-info-sec">
                    <p class="profile-info-tag">Last Name</p>
                    <p class="profile-info-data"><?= $profileInfoController->getProfileData("lastName") ; ?></p>
                    <p class="profile-info-tag">Telephone</p>
                    <p class="profile-info-data"><?= $profileInfoController->getProfileData("mobile") ; ?></p>
                    <p class="profile-info-tag">Address Line 02</p>
                    <p class="profile-info-data"><?= $profileInfoController->getProfileData("addLine02") ; ?></p>

                </div>
            </div>
            <div id="img-sec">
                <img src="../../public/img/profile.svg" id="profile-image">
            </div>
        </div>
        <br>
    </div>

</div>

<div class="page-mask" id="page-mask-photo">
    <div id="photo-upload-popup">
        <b><p id="update-photo-password-title">Update your profile photo</p></b>
        <button onclick="closePhotoUpdatePopup()" class="close-button">
            <img src="../../public/icons/close.svg" class="close-icon">
        </button>
        <form action="../../controller/profileController/profilePhotoController.php" method="post" enctype="multipart/form-data" id="photo-upload-form">
            <label for="images" class="drop-container">
            <span class="drop-title">Drop files here</span>
            or
            <input type="file" name="image" id="upload-photo-space" oninput="inputChange()">
            </label>
            <div id="change-photo-error">
                <?php include "../../controller/authController/message.php"?>
            </div>
            <input type="submit" name="submit" value="Upload" id="photo-upload-submit">
        </form>
    </div>
</div>

<div class="page-mask" id="page-mask-password">
    <div id="change-password-popup">
        <b><p id="update-photo-password-title">Change Password</p></b>
        <button onclick="closePwUpdatePopup()" class="close-button">
            <img src="../../public/icons/close.svg" class="close-icon">
        </button><br><br>
        <form action="../../controller/profileController/profilePasswordController.php" method="post" id="change-password-form" name="change-password-form" >
            <input type="password" id="current-password" name="current-password" placeholder="Current Password" oninput="inputChange()"required><br>
            <input type="password" id="new-password" name="new-password" placeholder="New Password" oninput="inputChange()" required><br>
            <input type="password" id="retype-new-password" name="retype-new-password" placeholder="Retype New Password" oninput="inputChange()"required><br>

            <div id="change-pw-error">
                <?php include "../../controller/authController/message.php"?>
            </div>

            <input type="submit" name="submit" value="Save" id="photo-upload-submit">
        </form>
    </div>
</div>

<div class="page-mask" id="page-mask-profileInfo">
    <div id="change-profile-info-popup">
        <b><p id="update-photo-password-title">Update Personal Information</p></b>
        <button onclick="closeProfileInfoPopup()" class="close-button">
            <img src="../../public/icons/close.svg" class="close-icon">
        </button><br><br>
        <form action="../../controller/profileController/profileInfoController.php" method="post" id="change-profile-info-form" name="change-profile-info-form" >
            <div id="change-info-sec-first">
                <input type="text" id="first-name" name="first-name" placeholder="First Name: <?= $profileInfoController->getProfileData('firstName') ; ?>" oninput="inputChange()"><br>
                <input type="text" id="last-name" name="last-name" placeholder="Last Name: <?= $profileInfoController->getProfileData("lastName") ; ?>" oninput="inputChange()"><br>
                <input type="text" placeholder="DOB: <?= $profileInfoController->getProfileDataStudent() ; ?>" name="dob" onfocus="(this.type='date')" onblur="(this.type='text')" oninput="inputChange()">
                <input type="text" id="address-first" name="address-first" placeholder="Address Line 01: <?= $profileInfoController->getProfileData("addLine01") ; ?>" oninput="inputChange()"><br>
                <input type="text" id="address-second" name="address-second" placeholder="Address Line 02: <?= $profileInfoController->getProfileData("addLine02") ; ?>" oninput="inputChange()">
            </div>
            <div id="change-info-sec-second">
                <input type="text" id="telephone" name="telephone" placeholder="Telephone: <?= $profileInfoController->getProfileData("mobile") ; ?>" oninput="inputChange()"><br>
                <input type="email" id="email" name="email" placeholder="Email: <?= $profileInfoController->getProfileData("email") ; ?>" oninput="inputChange()"><br>
                <input type="text" id="username" name="username" placeholder="Username: <?= $profileInfoController->getProfileData("userName") ; ?>" oninput="inputChange()"><br>
                <button id="profile-info-update-button" type="submit" >Save</button>
            </div>

        </form>
    </div>
</div>

<script src="../../public/js/profile.js"></script>

<?php
        if(isset($_SESSION['change-photo-error'])){
            echo"
                <style>
                        #page-mask-photo{
                            display:block;
                        }
                </style>
            ";
            unset($_SESSION['change-photo-error']);
        }
        if(isset($_SESSION['change-pw-error'])){
            echo"
                <style>
                        #page-mask-password{
                            display:block;
                        }
                </style>
            ";
            unset($_SESSION['change-pw-error']);
        }

?>


</body>
</html>
