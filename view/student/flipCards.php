<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="../../public/css/flipCards.css?<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
</head>
<body>

<?php

include_once('../../config/app.php');


?>

<div id="main-container">
    <div class="question-card">
        <?php
            echo "
            <p class='question-num'><b>(".$q_count.")</b></p>&nbsp;
            <p class='question-text'>".$question."</p>
            " ;
        ?>
    </div>
    <div class="cards-container">
        <?php 
        for($i=1;$i<=5;$i++) {
            $optName = 'opt' . str_pad($i, 2, '0', STR_PAD_LEFT);
            $optValue = $$optName;
            
            echo "
            <div class='card'>
                <div class='card-inner'>
                    <div class='card-face card-face-front'>
                        <p class='opt-num'><b>".$i.")&nbsp;&nbsp;</b>
                        ".$optValue."</p>
                    </div>";
                    if($i==$correctAnswer){
                        echo "
                        <div class='card-face card-face-back'>
                            <img src='../../public/icons/correct.svg' class='correct-img'>
                        </div>
                        ";
                    }else{
                        echo "
                        <div class='card-face card-face-back'>
                            <img src='../../public/icons/incorrect.png' class='incorrect-img'>
                        </div>
                        ";
                    }
                    
            echo "
                </div>
            </div>
            
            ";
        }
        ?>
    </div>
    <div class="button-container">
        <button class='show-answer-btn'>Show Answer</button>
        <button class='show-description-btn'>Show Description</button>
    </div>
    
</div>

<script src="../../public/js/flipCards.js"></script>
</body>
</html>
