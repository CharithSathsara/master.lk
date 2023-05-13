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
    $_SESSION['current-topic'] = $_GET['topic'];

    include_once '../common/header.php';
    @include '../common/navBar-Student.php';

    ?>
    <div class="content">
        <div class="container" id="container">
            <b>
                <p id="title">
                    <span id="subject-shortcut"><a
                            href="studentDashboard.php"><?= $_SESSION['current-subject'] ?></a></span>&nbsp;&nbsp;>&nbsp;&nbsp;
                    <span id="lesson-shortcut"><a
                            href="topicsAndFeedbacks.php?subject=<?= $_SESSION['current-subject'] ?>&lesson=<?= $_SESSION['current-lesson'] ?>"><?= $_SESSION['current-lesson'] ?></a></span>&nbsp;&nbsp;>&nbsp;&nbsp;
                    <span id="topic-shortcut"><a
                            href="theoryContents.php?subject=<?= $_SESSION['current-subject'] ?>&lesson=<?= $_SESSION['current-lesson'] ?>&topic=<?= $_SESSION['current-topic'] ?>"><?= $_SESSION['current-topic'] ?></a></span>&nbsp;&nbsp;>&nbsp;&nbsp;
                    Leaderboard
                </p>
            </b>
            <div class="title-leaderboard"><b>Leaderboard</b></div>

            <div class="sub-elements">
                <a href="Leaderboard.php?topic=<?= $_SESSION['current-topic'] ?>"><button class="sub-title"
                        id="sub-title" type=" button"><b>Model Paper Quiz
                            Leaderboard</b></button></a>
                <a href="ppLeaderboard.php?topic=<?= $_SESSION['current-topic'] ?>"><button class="sub-title"
                        id="sub-title" type="button"><b>Past Paper Quiz
                            Leaderboard</b></button></a>
            </div>

            <!-- </div>
            <hr class="hr-line">
        </div> -->


            <!-- Past Paper Leaderboard -->

            <?php

            $i = 0;

            $leaderboard2 = $leaderBoardController->pastQuizLeaderBoard($_SESSION['current-topic']);
            mysqli_data_seek($leaderboard2, 1); // move the pointer to the third row (0-based index)
            $row = mysqli_fetch_assoc($leaderboard2);

            // if ($result) {
            //     mysqli_data_seek($result, 1);
            //     // continue processing the result set
            // } else {
            //     // handle the error
            //     echo "Error executing query: " . mysqli_error($connection);
            // }



            ?>


            <br>

            <div class="lbox-container" id="lbox-pp-container">
                <div class="lbox left">
                    <div class="circle-imgbox">
                        <?php
                        if ($row['image'] != null) {

                            $to_echo = "<img id='profile-pic' src='data:image/jpg;charset=utf8;base64,";
                            $to_echo .= base64_encode($row['image']);
                            $to_echo .= "'/>";
                            echo $to_echo;
                        } else {
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
                                <?= $row['firstName'] ?> <?= $row['lastName'] ?><br>

                                <?= $row['score'] ?>% Marks </b>
                        </p>
                    </div>
                </div>
                <?php


                mysqli_data_seek($leaderboard2, 0); // move the pointer to the third row (0-based index)
                $row = mysqli_fetch_assoc($leaderboard2);


                ?>

                <div class="lbox bigger">
                    <div class="circle-imgbox-middle">
                        <?php
                        if ($row['image'] != null) {

                            $to_echo = "<img id='profile-pic' src='data:image/jpg;charset=utf8;base64,";
                            $to_echo .= base64_encode($row['image']);
                            $to_echo .= "'/>";
                            echo $to_echo;
                        } else {
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
                                <?= $row['firstName'] ?> <?= $row['lastName'] ?><br>

                                <?= $row['score'] ?>% Marks </b></b>

                        </p>
                    </div>
                </div>
                <?php
                mysqli_data_seek($leaderboard2, 2);
                $row = mysqli_fetch_assoc($leaderboard2); // move the pointer to the third row (0-based index)

                ?>
                <div class="lbox right">
                    <div class="circle-imgbox">
                        <?php
                        if ($row['image'] != null) {

                            $to_echo = "<img id='profile-pic' src='data:image/jpg;charset=utf8;base64,";
                            $to_echo .= base64_encode($row['image']);
                            $to_echo .= "'/>";
                            echo $to_echo;
                        } else {
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

                            <?= $row['firstName'] ?> <?= $row['lastName'] ?><br>

                            <b> <?= $row['score'] ?>% Marks </b>

                        </p>
                    </div>
                </div>
            </div>

            <br>

            <br>

            <div class="leaderboard">
                <table id="modelPaperTable">



                    <tbody>
                        <?php
                        for ($i = 3; $i < mysqli_num_rows($leaderboard2); $i++) {


                            mysqli_data_seek($leaderboard2, $i);
                            $row = mysqli_fetch_assoc($leaderboard2); // move the pointer to the third row (0-based index)


                        ?>
                        <tr>
                            <td id="winner">
                                <?php echo $i;
                                    ?>
                            </td>
                            <td id="modelTableStudent">
                                <p> <?= $row['firstName'] ?> <?= $row['lastName'] ?></p>
                            </td>
                            <td><?= $row['score'] ?></td>

                        </tr>



                    </tbody>
                    <?php
                        } ?>
                </table>



            </div>







        </div>
    </div>

</body>

</html>