<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Leaderboard</title>
    <hr class="hr-line">
    <!-- <link rel="stylesheet" href="../../public/css/leaderboard.css"> -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

</head>

<body>
    <?php

include_once('../../config/app.php');
include_once('../../controller/authController/authentication/Authentication.php');
include_once('../../controller/authController/authorization/Authorization.php');

//check user authenticated or not
//$authentication = new Authentication();
//$authentication->authorizingAdmin();

//User Authentication
Authentication::userAuthentication();
//User Authorization
Authorization::authorizingStudent();

$leaderBoardController = new LeaderBoardController();

// include_once '../common/header.php';
// @include '../common/navBar-Student.php';

?>
    <div class="content">
        <div class="container">
            <div class="leaderboard-container">
                <div class="title-leaderboard"><b>Leaderboard</b></div>

                <div class="leaderboard">
                    <table>

                        <thead>
                            <tr>
                                <td></td>
                                <td class="leaderboard-heading">
                                    Name
                                </td>
                                <td class="leaderboard-heading">
                                    Score
                                </td>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $_SESSION['selectedTopic'] = "Force and Motion";
                            $i = 0;

                        $leaderboard = $leaderBoardController->modelQuizLeaderBoard( $_SESSION['selectedTopic']);
                        if(mysqli_num_rows($leaderboard) > 0){
                        foreach($leaderboard as $row){
                        ?>
                            <tr>
                                <td id="winner">
                                    <?echo (i+1);?>
                                </td>
                                <td>
                                    <p> <?=$row['firstName']?> <?=$row['lastName']?></p>
                                </td>
                                <td>98</td>

                            </tr>


                        </tbody>
                    </table>
                    <div class="gif-container">
                        <img class="congratulations-gif" src="../../public/img/Congratulations.gif" alt="Animated GIF">
                    </div>

                </div>
            </div>



        </div>
    </div>



</body>

</html>