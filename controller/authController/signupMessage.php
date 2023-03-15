<?php

if(isset($_SESSION['signup-error-message'])){
    echo "<h4>".$_SESSION['signup-error-message']."</h4>";
}

?>