<?php

if(isset($_SESSION['add_Teacher'])){
    echo "<p>".$_SESSION['add_Teacher']."</p>";
}

if(isset($_SESSION['add_Creator'])){
    echo "<p>".$_SESSION['add_Creator']."</p>";
}

if(isset($_SESSION['update_Teacher'])){
    echo "<p>".$_SESSION['update_Teacher']."</p>";
}

if(isset($_SESSION['upp_Creator'])){
    echo "<p>".$_SESSION['upp_Creator']."</p>";
}

?>