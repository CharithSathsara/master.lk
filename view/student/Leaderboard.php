<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Leaderboard</title>
    <hr class="hr-line">
    <link rel="stylesheet" href="../../public/css/leaderboard.css">
    <script src="../../public/js/modelPaperLeaderboard.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

</head>

<body>
    <?php


include_once('../../controller/authController/authentication/Authentication.php');
include_once('../../controller/authController/authorization/Authorization.php');
include('../../controller/studentController/leaderBoardController/leaderBoardController.php');


//check user authenticated or not
//$authentication = new Authentication();
//$authentication->authorizingAdmin();

//User Authentication
Authentication::userAuthentication();
//User Authorization
Authorization::authorizingStudent();

$leaderBoardController = new LeaderBoardController();

include_once '../common/header.php';
@include '../common/navBar-Student.php';

?>
    <div class="content">
        <div class="container">
            <?php
        $_SESSION['selectedTopicId'] = 2;
        $i = 0;

        $leaderboard1 = $leaderBoardController->modelQuizLeaderBoard( $_SESSION['selectedTopicId']);
        mysqli_data_seek($leaderboard1, 1); // move the pointer to the third row (0-based index)
        $row = mysqli_fetch_assoc($leaderboard1);
       

    
        ?>
            <div class="title-leaderboard"><b>Leaderboard</b></div>

            <div class="sub-elements">
                <p class="sub-title"><b>Model Paper Quiz Leaderboard</b></p>
                <hr class="hr-line">
            </div>
            <br>
            <div class="leaderboardPlace-container">
                <div class="lbox-container">
                    <div class="lbox left">
                        <div class="circle-imgbox">
                            <?php
                             if($row['image']!=null){

                                $to_echo = "<img id='profile-pic' src='data:image/jpg;charset=utf8;base64,";
                                $to_echo .= base64_encode($row['image']);
                                $to_echo .= "'/>";
                                echo $to_echo;
                    
                            }else{
                                echo "<img id='profile-pic' src='../../public/img/default-profPic.png'/>";
                            }
                            ?>
                        </div>

                        <div class="lcontent-left">
                            <div class="left-header-container">
                                <img src="../../public/img/second_place.png" class="second-icon">
                                <h2 class="lcontent-left-h2">1<sup>st</sup> Runner Up</h2>
                            </div>

                            <p>

                                <b>
                                    <?=$row['firstName']?> <?=$row['lastName']?><br>

                                    <?=$row['score']?>% Marks </b>
                            </p>
                        </div>
                    </div>
                    <?php
                
                   
                    mysqli_data_seek($leaderboard1, 0); // move the pointer to the third row (0-based index)
                    $row = mysqli_fetch_assoc($leaderboard1);
        

                    ?>

                    <div class="lbox bigger">
                        <div class="circle-imgbox-middle">
                            <?php
                             if($row['image']!=null){

                                $to_echo = "<img id='profile-pic' src='data:image/jpg;charset=utf8;base64,";
                                $to_echo .= base64_encode($row['image']);
                                $to_echo .= "'/>";
                                echo $to_echo;
                    
                            }else{
                                echo "<img id='profile-pic' src='../../public/img/default-profPic.png'/>";
                            }
                            ?>
                        </div>
                        <div class="lcontent-middle">
                            <div class="middle-header-container">
                                <img src="../../public/img/first_place.png" class="winner-icon">
                                <h2 class="lcontent-middle-h2">Winner</h2>
                            </div>
                            <p>

                                <b>
                                    <?=$row['firstName']?> <?=$row['lastName']?><br>

                                    <?=$row['score']?>% Marks </b></b>

                            </p>
                        </div>
                    </div>
                    <?php
                    mysqli_data_seek($leaderboard1, 2);
                    $row = mysqli_fetch_assoc($leaderboard1);// move the pointer to the third row (0-based index)
                
                    ?>
                    <div class="lbox right">
                        <div class="circle-imgbox">
                            <?php
                             if($row['image']!=null){

                                $to_echo = "<img id='profile-pic' src='data:image/jpg;charset=utf8;base64,";
                                $to_echo .= base64_encode($row['image']);
                                $to_echo .= "'/>";
                                echo $to_echo;
                    
                            }else{
                                echo "<img id='profile-pic' src='../../public/img/default-profPic.png'/>";
                            }
                            ?>
                        </div>
                        <div class="lcontent-right">
                            <div class="right-header-container">
                                <img src="../../public/img/third_place.png" class="third-icon">
                                <h2 class="lcontent-right-h2">2<sup>nd</sup> Runner Up</h2>
                            </div>

                            <p>

                                <?=$row['firstName']?> <?=$row['lastName']?><br>

                                <b> <?=$row['score']?>% Marks </b>

                            </p>
                        </div>
                    </div>



                </div>
                <?php
                    // foreach($leaderboard1 as $row){
                        ?>

                <?php 
                // echo ($i+1);
                    // i++;
                    ?>

                <p> </p>
                <br>




            </div>
        </div>

</body>

</html>