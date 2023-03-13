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
            <div class="leaderboard-container">
                <div class="title-leaderboard"><b>Leaderboard</b></div>


                <div class="sub-elements">
                    <p class="sub-title"><b>Model Paper Quiz Leaderboard</b></p>
                    <hr class="hr-line">
                </div>
                <br>
                <div class="searchBox">

                    <input class="searchInput" id="searchInputModelLeaderboard" type="text" name=""
                        placeholder="Search Student..." oninput="search()">
                    <button class="searchButton" id="searchButtonModelLeaderboard" href="#">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </div>
                <br>

                <div class="leaderboard">
                    <table id="modelPaperTable">

                        <thead>
                            <tr>
                                <td class="leaderboard-heading">Rank</td>
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
                            $_SESSION['selectedTopicId'] = 2;
                            $i = 0;

                        $leaderboard1 = $leaderBoardController->modelQuizLeaderBoard( $_SESSION['selectedTopicId']);
                        if( mysqli_num_rows ($leaderboard1) > 0){
                        foreach($leaderboard1 as $row){
                        ?>
                            <tr>
                                <td id="winner">
                                    <?php echo ($i+1);
                                    $i++;?>
                                </td>
                                <td id="modelTableStudent">
                                    <p> <?=$row['firstName']?> <?=$row['lastName']?></p>
                                </td>
                                <td><?=$row['score']?></td>

                            </tr>
                            <?php   }
                            }
                            ?>


                        </tbody>
                    </table>
                    <!-- <div class="gif-container">
                        <img class="congratulations-gif" src="../../public/img/Congratulations.gif" alt="Animated GIF">
                    </div> -->

                </div>
                <br><br><br><br>

                <div class="sub-elements">
                    <p class="sub-title"><b>Past Paper Quiz Leaderboard</b></p>
                    <hr class="hr-line">
                </div>
                <br>
                <div class="searchBox">

                    <input class="searchInput" type="text" name="" placeholder="Search Student...">
                    <button class="searchButton" href="#">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <br>

                <div class="leaderboard">
                    <table id="modelPaperTable">

                        <thead>
                            <tr>
                                <td class="leaderboard-heading">Rank</td>
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
                            $_SESSION['selectedTopicId'] = 2;
                            $j = 0;

                        $leaderboard2 = $leaderBoardController->pastQuizLeaderBoard( $_SESSION['selectedTopicId']);
                        if( mysqli_num_rows ($leaderboard2) > 0){
                        foreach($leaderboard2 as $row){
                        ?>
                            <tr>
                                <td id="winner">
                                    <?php echo ($j+1);
                                    $j++;?>
                                </td>
                                <td>
                                    <p> <?=$row['firstName']?> <?=$row['lastName']?></p>
                                </td>
                                <td><?=$row['score']?></td>

                            </tr>
                            <?php   }
                            }
                            ?>


                        </tbody>
                    </table>
                    <!-- <div class="gif-container">
                        <img class="congratulations-gif" src="../../public/img/Congratulations.gif" alt="Animated GIF">
                    </div> -->

                </div>
            </div>
        </div>



    </div>
    </div>
    <script>
    function search() {
        var text = document.getElementById('search').value;
        const tr = document.getElementsById('modelTableStudent');
        for (let i = 1; i < tr.length; i++) {
            if (!tr[i].children[1].children[1].innerHTML.toLowerCase().includes(
                    text.toLowerCase()
                )) {
                tr[i].style.display = 'none';
            } else {
                tr[i].style.display = '';
            }
        }
    }
    </script>


</body>

</html>