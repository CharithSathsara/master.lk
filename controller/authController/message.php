<?php

if(isset($_SESSION['restrict-error-message'])){
    echo "<script>alert('Warning : ".$_SESSION['restrict-error-message']."')</script>";
    unset($_SESSION['restrict-error-message']);
}

if(isset($_SESSION['login-error-message'])){
    echo "<h4>".$_SESSION['login-error-message']."</h4>";
    unset($_SESSION['login-error-message']);
}

if(isset($_SESSION['change-pw-error'])){
    echo "<p>".$_SESSION['change-pw-error']."</p>";
    // unset($_SESSION['change-pw-error']);
}

if(isset($_SESSION['change-photo-error'])){
    echo "<p>".$_SESSION['change-photo-error']."</p>";
    // unset($_SESSION['change-photo-error']);
}

