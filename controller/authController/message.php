<?php

if(isset($_SESSION['login-error-message'])){
    echo "<h4>".$_SESSION['login-error-message']."</h4>";
    unset($_SESSION['login-error-message']);
}

if(isset($_SESSION['change-pw-error'])){
    echo "<p>".$_SESSION['change-pw-error']."</p>";
}

if(isset($_SESSION['change-photo-error'])){
    echo "<p>".$_SESSION['change-photo-error']."</p>";
}


if(isset($_SESSION['slip-upload-error'])){
    echo "<p>".$_SESSION['slip-upload-error']."</p>";
    unset($_SESSION['slip-upload-error']);
}

if(isset($_SESSION['verify-email-error'])){
    echo "<p>".$_SESSION['verify-email-error']."</p>";
}

if(isset($_SESSION['password-reset-error'])){
    echo "<p>".$_SESSION['password-reset-error']."</p>";
}

if(isset($_SESSION['change-info-error'])){
    echo "<p>".$_SESSION['change-info-error']."</p>";
}

