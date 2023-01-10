<?php

if(isset($_SESSION['message'])){
    echo "<p style='color: #CA0123'>".$_SESSION['message']."</p>";
    unset($_SESSION['message']);
}

?>
