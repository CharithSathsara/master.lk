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
                            <img
                                src="https://images.pexels.com/photos/1815257/pexels-photo-1815257.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                        </div>
                    </div>


                    <div class="lbox bigger">
                        <div class="circle-imgbox-middle">
                            <img
                                src="https://images.pexels.com/photos/1815257/pexels-photo-1815257.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                        </div>
                    </div>


                    <div class="lbox right">
                        <div class="circle-imgbox">
                            <img
                                src="https://images.pexels.com/photos/1815257/pexels-photo-1815257.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                        </div>
                    </div>


                </div>
            </div>
        </div>

</body>

</html>