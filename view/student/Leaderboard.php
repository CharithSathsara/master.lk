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
    <?php echo time(); ?>">
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

include_once '../common/header.php';
@include '../common/navBar-Student.php';

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
                            <tr>
                                <td id="winner">1</td>
                                <td><img src="../../public/img/User1.jpg">
                                    <p> Jose Brag</p>
                                </td>
                                <td>98</td>

                            </tr>

                            <tr>
                                <td id="runner-up">2</td>
                                <td><img src="../../public/img/User2.jpg">
                                    <p> Lily Simons</p>
                                </td>
                                <td>96</td>

                            </tr>

                            <tr>
                                <td id="second-runner-up">3</td>
                                <td><img src="../../public/img/User3.jpg">
                                    <p> Tom Higgle</p>
                                </td>
                                <td>91</td>

                            </tr>

                            <tr>
                                <td>4</td>
                                <td><img src="../../public/img/User4.jpg">
                                    <p> Alex Roger</p>
                                </td>
                                <td>85</td>

                            </tr>

                            <tr>
                                <td>5</td>
                                <td><img src="../../public/img/User5.jpg">
                                    <p> Mavie Ruth</p>
                                </td>
                                <td>82</td>

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