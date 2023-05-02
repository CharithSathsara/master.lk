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

if(isset($_SESSION['add-institute'])){
    echo "<p>".$_SESSION['add-institute']."</p>";
}

if(isset($_SESSION['Update-institute'])){
    echo "<p>".$_SESSION['Update-institute']."</p>";
}

if(isset($_SESSION['add-bank'])){
    echo "<p>".$_SESSION['add-bank']."</p>";
}

if(isset($_SESSION['update-bank'])){
    echo "<p>".$_SESSION['update-bank']."</p>";
}

if(isset($_SESSION['add-physicsDescription'])){
    echo "<p>".$_SESSION['add-physicsDescription']."</p>";
}

if(isset($_SESSION['add-ChemistryDescription'])){
    echo "<p>".$_SESSION['add-ChemistryDescription']."</p>";
}

if(isset($_SESSION['update-ChemistryDescription'])){
    echo "<p>".$_SESSION['update-ChemistryDescription']."</p>";
}

if(isset($_SESSION['update-physicsDescription'])){
    echo "<p>".$_SESSION['update-physicsDescription']."</p>";
}

?>