<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../../public/css/studentDashboard.css?<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="../../public/js/studentDashboard.js"></script>
</head>

<body>

    <?php

    include_once('../../config/app.php');
    include_once('../../controller/authController/authentication/Authentication.php');
    include_once('../../controller/authController/authorization/Authorization.php');

    //User Authentication
    Authentication::userAuthentication();
    //User Authorization
    Authorization::authorizingStudent();

    include_once('../common/header.php');
    include_once('../../controller/studentController/dashboardController/lessonController.php');
    include_once('../../controller/studentController/dashboardController/studentSubjectController.php');
    include_once('../../controller/studentController/dashboardController/subjectProgressController.php');

    include_once('../../controller/studentController/leaderBoardController/leaderBoardController.php');
    include_once('../../controller/studentController/dashboardController/badgesController.php');

    include_once('../../controller/studentController/dashboardController/progressController.php');
    include_once('../../controller/studentController/dashboardController/recommendationsController.php');
    include_once('../../controller/studentController/dashboardController/timeUsageController.php');

    include_once('../../model/Student.php');
    include_once('../../model/Badges.php');
    include_once('../../model/Subject.php');
    include_once('../../model/Lesson.php');

    include_once('../../model/Leaderboard.php');
    include_once('../../model/Topic.php');

    $_SESSION['studentNavItems-dashboard'] = array();
    array_push(
        $_SESSION['studentNavItems-dashboard'],
        'Leaderboard.php',
        'modelQuiz.php',
        'modelQuizEnd.php',
        'modelQuizStarted.php',
        'review.php',
        'reviewQuizzes.php',
        'studentDashboard.php',
        'theoryContents.php',
        'topicsAndFeedbacks.php'
    );

    $_SESSION['studentNavItems-newSubjects'] = array();
    array_push($_SESSION['studentNavItems-newSubjects'], 'newSubjects.php', 'bankDeposit.php', 'cart.php', 'checkout.php');

    $_SESSION['studentNavItems-qaForum'] = array();
    array_push($_SESSION['studentNavItems-qaForum'], 'forum_student.php');

    $_SESSION['studentNavItems-profile'] = array();
    array_push($_SESSION['studentNavItems-profile'], 'profile.php');

    include_once('../common/navBar-Student.php');

    $lessonController = new lessonController();
    $studentSubjectController = new studentSubjectController();
    $subjectProgressController = new subjectProgressController();

    $badgeController = new badgesController();

    $progressController = new progressController();
    $recommendationsController = new recommendationsController();
    $timeUsageController = new timeUsageController();

    ?>

    <div id="student-dashboard-container">
        <div id="student-dashboard">

            <b>
                <p id="title">Dashboard</p>
            </b>

            <!-- My Subjects Section -->

            <div id="dashboard-section">

                <b>
                    <p class="sub-title">My Subjects&nbsp;&nbsp;&nbsp;</p>
                </b>

                <div id="my-subjects-container">

                    <div id='chemistry' class='subject-card'>
                        <b>
                            <p class='card-title'>Chemistry</p>
                        </b>

                        <!-- Displays the progress of Chemistry Subject -->

                        <div class="progress-container">
                            <label id="progress-value-text"><?= $subjectProgressController->getSubjectProgress('Chemistry'); ?>%</label>
                            <progress id="progress-bar" value="<?= $subjectProgressController->getSubjectProgress('Chemistry'); ?>" max="100">
                                <div class="progress-value">
                                    <span class="progress-perc"><?= $subjectProgressController->getSubjectProgress('Chemistry'); ?>%</span>
                                </div>
                            </progress>
                        </div>

                        <!-- Gets the lessons of the Chemistry Subject from the database -->

                        <div class='lesson-container'>
                            <?= $lessonController->getLessons("Chemistry"); ?>

                        </div>
                    </div>


                    <div id='physics' class='subject-card'>
                        <b>
                            <p class='card-title'>Physics</p>
                        </b>

                        <!-- Displays the progress of Physics Subject -->

                        <div class="progress-container">
                            <label id="progress-value-text"><?= $subjectProgressController->getSubjectProgress('Physics'); ?>%</label>
                            <progress id="progress-bar" value="<?= $subjectProgressController->getSubjectProgress('Physics'); ?>" max="100">
                                <div class="progress-value">
                                    <span class="progress-perc"><?= $subjectProgressController->getSubjectProgress('Physics'); ?>%</span>
                                </div>
                            </progress>
                        </div>

                        <!-- Gets the lessons of the Physics Subject from the database -->

                        <div class='lesson-container'>
                            <?= $lessonController->getLessons("Physics") ?>
                        </div>
                    </div>

                </div>

                <br><br>

                <!-- Completion Section -->

                <b>
                    <p class="sub-title">Completion&nbsp;&nbsp;&nbsp;</p>
                </b>

                <div id="completion-container">
                    <div id="chem-sec" class="subject-progress-card">
                        <p class="progress-card-title">Chemistry</p><br>
                        <div id="inner-container">
                            <?= $lessonController->getLessonCompletion("Chemistry") ?>
                            <div id="lesson-names">
                                <?php
                                $rows = array();
                                $rows = $_SESSION['lesson_rows'];
                                foreach ($rows as $row) {

                                    echo "<p class='lesson-name-item'>" . $row['lessonName'] . "</p>";
                                } ?>
                            </div>
                            <div id="progress-values">
                                <?php
                                $values = array();
                                $values = $_SESSION['lesson_progress_values'];
                                foreach ($values as $row2) {

                                    echo "<p class='progress-value'>" . $row2 . "%</p>";
                                    echo "<progress class ='lesson-progress-bars' value='" . $row2 . "' max='100'></progress><br><br>";
                                } ?>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div id="phy-sec" class="subject-progress-card">
                        <p class="progress-card-title">Physics</p><br>
                        <div id="inner-container">
                            <?= $lessonController->getLessonCompletion("Physics") ?>
                            <div id="lesson-names">
                                <?php
                                $rows = array();
                                $rows = $_SESSION['lesson_rows'];
                                foreach ($rows as $row) {

                                    echo "<p class='lesson-name-item'>" . $row['lessonName'] . "</p>";
                                } ?>
                            </div>
                            <div id="progress-values">
                                <?php
                                $values = array();
                                $values = $_SESSION['lesson_progress_values'];
                                foreach ($values as $row2) {

                                    echo "<p class='progress-value'>" . $row2 . "%</p>";
                                    echo "<progress class ='lesson-progress-bars-phy' value='" . $row2 . "' max='100'></progress><br><br>";
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <br><br>

                <!-- Progress Section -->

                <b>
                    <p class="sub-title">Progress&nbsp;&nbsp;&nbsp;</p>
                </b>

                <div id="progress-container">

                    <form action="" method="get" id="progress-checking-form">
                        <label for="lesson">Select a lesson : </label><br><br>
                        <div class="select">
                            <select name="lesson" id="lesson-progress">
                                <option value="default" disabled selected hidden>Select a lesson</option>
                                <optgroup label="Chemistry">
                                    <?php
                                    $chem_lessons = $lessonController->getAllLessons("Chemistry");
                                    foreach ($chem_lessons as $lesson) {
                                        echo "<option value='" . $lesson['lessonName'] . "'>" . $lesson['lessonName'] . "</option>";
                                    }
                                    ?>
                                </optgroup>
                                <optgroup label="Physics">
                                    <?php
                                    $phy_lessons = $lessonController->getAllLessons("Physics");
                                    foreach ($phy_lessons as $lesson) {
                                        echo "<option value='" . $lesson['lessonName'] . "'>" . $lesson['lessonName'] . "</option>";
                                    }
                                    ?>
                                </optgroup>
                            </select>
                        </div>
                        <input type="submit" value="Check Progress" id="select-lesson-btn" name="get-progress-lesson">

                    </form>

                    <?php

                    if (isset($_GET['get-progress-lesson'])) {

                        if (isset($_GET['lesson'])) {

                            echo "<script>
                            setTimeout(()=>{
                                window.scrollTo({
                                    top: 850,
                                    behavior: 'smooth',
                                }); 
                            },50)
                            </script>";

                            $status = $progressController->hasStarted($_GET['lesson']);

                            if ($status) {

                                $topics = $progressController->getTopicsOfLesson($_GET['lesson']);
                                echo "
                                <canvas id='progressChart'></canvas>
                                <script>
                                    const xValues = [";

                                foreach ($topics as $topic) {
                                    echo "'" . $topic['topicTitle'] . "',";
                                }
                                echo "
                                ];
                                new Chart('progressChart', {
                                    type: 'line',
                                    data: {
                                        labels: xValues,
                                        datasets: [{
                                        label: 'Average Marks - Model Papers',
                                        data: [";

                                $progressController->getLessonProgress($_GET['lesson'], 'MODELPAPER');

                                echo
                                "],
                                        borderColor: 'MediumVioletRed',
                                        fill: false
                                        },
                                        {label: 'Average Marks - Past Papers',
                                        data: [";

                                $progressController->getLessonProgress($_GET['lesson'], 'PASTPAPER');

                                echo
                                "],
                                        borderColor: 'LightSeaGreen',
                                        fill: false
                                        }]
                                    },
                                    options: {
                                        
                                        legend: {
                                            display: true,
                                            position: 'bottom',
                                        },
                                        title: {
                                            display: true,
                                            text: 'Progress - " . $_GET['lesson'] . "',
                                            color: 'navy',
                                            position: 'top',
                                            align: 'center',
                                            font: {
                                                
                                                fontSize:100,
                                    
                                            },
                                            padding: 30,
                                            fullSize: true,
                                        },
                                        scales: {
                                            yAxes: [{
                                              scaleLabel: {
                                                display: true,
                                                labelString: 'Average Marks'
                                              }
                                            }]
                                          }
                                        
                                    },
                                    });
                                </script>
                                ";
                            } else {
                                echo "<div id='no-lesson-selected'>
                                        <div id='no-lesson-section'>
                                            <img id='no-lesson-img' src='../../public/img/chart.png'><br>
                                            <p id='no-lesson-text'>You have not completed any quizzes from <span><b>'" . $_GET['lesson'] . "'</b></span></p>
                                        </div>
                                    </div>";
                            }
                        } else {
                            echo "<script>
                            setTimeout(()=>{
                                window.scrollTo({
                                    top: 850,
                                    behavior: 'smooth',
                                }); 
                            },50)
                            </script>";
                            echo "<div id='no-lesson-selected'>
                                <div id='no-lesson-section'>
                                    <img id='no-lesson-img' src='../../public/img/chart.png'><br>
                                    <p id='no-lesson-text'>Select a lesson and check your progress</p>
                                </div>
                            </div>";
                        }
                    } else {
                        echo "<div id='no-lesson-selected'>
                                <div id='no-lesson-section'>
                                    <img id='no-lesson-img' src='../../public/img/chart.png'><br>
                                    <p id='no-lesson-text'>Select a lesson and check your progress</p>
                                </div>
                            </div>";
                    }
                    ?>
                </div>

                <br><br>

<!-- Badges Section -->

<b><p class="sub-title">Badges&nbsp;&nbsp;&nbsp;</p></b>

<div id="badge-container">
    <div class="show-badges">
        <div class="show-normalBadges">
            <?php
            $userId =  $_SESSION['auth_user']['userId'];
            $details = $badgeController->getAllTopicId();

            $_SESSION['topicId'] = array();
            $physicsTopicOne = array();
            $ChemistryTopicOne = array();
            $loopCount = 0;

            foreach ($details as $detail){
                $_SESSION['topicId'][]= $detail['topicId'];
            }

            $arrayLength = count($_SESSION['topicId']);

            for ($i=0 ; $i < $arrayLength;$i++){

                $StudentsId = $badgeController->getThreeStudents($_SESSION['topicId'][$i]);

                $lengthOfStudent = mysqli_num_rows($StudentsId);

                if($lengthOfStudent == 1){

                    $studentId = mysqli_fetch_assoc($StudentsId);

                    if($studentId['studentId'] == $userId){

                        $subjectId = $badgeController->getSubjectId($_SESSION['topicId'][$i]);

                        if($subjectId == 1){

                            $physicsTopicOne[] = $_SESSION['topicId'][$i];
                            echo "<div class='BadgePicture'>";
                            echo  $badgeController->getBadge(1,$subjectId);
                            ?>
                            <p class="topic-nameBadge"> <?php echo $badgeController->getTopic($_SESSION['topicId'][$i]); ?> </p>
                            <?php
                            echo "</div>";

                        }else if($subjectId == 2){

                            $ChemistryTopicOne[] = $_SESSION['topicId'][$i];
                            echo "<div class='BadgePicture'>";
                            echo $badgeController->getBadge(1,$subjectId);
                            ?>
                            <p class="topic-nameBadge"> <?php echo $badgeController->getTopic($_SESSION['topicId'][$i]); ?></p>
                            <?php
                            echo "</div>";

                        }
                    }

                }else if($lengthOfStudent == 2){

                    for($j=0 ; $j < $lengthOfStudent; $j++){

                        $studentId = mysqli_fetch_assoc($StudentsId);

                        if($studentId['studentId'] == $userId){

                            $subjectId = $badgeController->getSubjectId($_SESSION['topicId'][$i]);

                            if($subjectId == 1){

                                if($i == 0){
                                    $physicsTopicOne[] = $_SESSION['topicId'][$i];
                                }

                                echo "<div class='BadgePicture'>";
                                echo  $badgeController->getBadge($j+1,$subjectId);
                                ?>
                                <p class="topic-nameBadge"> <?php echo $badgeController->getTopic($_SESSION['topicId'][$i]); ?></p>
                                <?php
                                echo "</div>";

                            }else if($subjectId == 2){

                                if($i == 0){

                                    $ChemistryTopicOne[] = $_SESSION['topicId'][$i];
                                }

                                echo "<div class='BadgePicture'>";
                                echo $badgeController->getBadge($j+1,$subjectId);
                                ?>
                                <p class="topic-nameBadge"> <?php echo $badgeController->getTopic($_SESSION['topicId'][$i]); ?></p>
                                <?php
                                echo "</div>";

                            }
                        }
                    }
                }else if($lengthOfStudent == 3){

                    for($j=0 ; $j < $lengthOfStudent; $j++){

                        $studentId = mysqli_fetch_assoc($StudentsId);

                        if($studentId['studentId'] == $userId){

                            $subjectId = $badgeController->getSubjectId($_SESSION['topicId'][$i]);

                            if($subjectId == 1){

                                if($i == 0){

                                    $physicsTopicOne[] = $_SESSION['topicId'][$i];
                                }

                                echo "<div class='BadgePicture'>";
                                echo  $badgeController->getBadge($j+1,$subjectId);
                                ?>
                                <p class="topic-nameBadge"> <?php echo $badgeController->getTopic($_SESSION['topicId'][$i]); ?></p>
                                <?php
                                echo "</div>";

                            }else if($subjectId == 2){

                                if($i == 0){

                                    $ChemistryTopicOne[] = $_SESSION['topicId'][$i];
                                }

                                echo "<div class='BadgePicture'>";
                                echo $badgeController->getBadge($j+1,$subjectId);
                                ?>
                                <p class="topic-nameBadge"> <?php echo $badgeController->getTopic($_SESSION['topicId'][$i]); ?></p>
                                <?php
                                echo "</div>";

                            }
                        }
                    }
                }
            }

            ?>

        </div>

        <!-- show special badges -->
        <?php

        $physicsArrayCount = count($physicsTopicOne);
        $chemistryArrayCount = count($ChemistryTopicOne);

        if(count($physicsTopicOne) >= 3 && count($ChemistryTopicOne) >= 3){
            ?>

            <div class="special-badge">
                <div class="specialBadge-header">
                    <b><p class="subTitle-Badge">Special Badges&nbsp;&nbsp;&nbsp;</p></b>
                </div>
                <div>

                    <?php

                    echo "<div class='BadgePicture'>";
                    ?>

                    <button onclick="openDescriptionOne()"><?php $badgeController->specialOne(); ?></button>

                    <?php
                    echo "</div>";

                    ?>

                </div>
            </div>
        <?php } ?>
    </div>
</div>




<!--  show badge details-->

<div class="main-detailOneDiv" id="main-detailOneDiv">
    <div class="first-badgeDetails">

        <div class="header-firstBadge">
            <b><p>The badge for winning first place of 3 or more topics from each subject</p></b>
            <button id="detailOneDiv-close" onclick="hideTitleDescription()"><img src="../../public/img/close.png"></button>
        </div>

        <?php

        if($physicsArrayCount >=3 && $chemistryArrayCount >=3){
            ?>

            <div class="first-physicsTopic">
                <P style="font-weight: bold; margin-top: 10px">Physics Topic</P>
                <ul>
                    <?php
                    for ($k=0 ; $k < $physicsArrayCount; $k++){
                        echo "<li>";
                        echo $badgeController->getTopic($physicsTopicOne[$k]);
                        echo "</li>";
                    }
                    ?>
                </ul>
            </div>

            <div class="first-chemistryTopic">
                <P style="font-weight: bold ; margin-top: 10px">Chemistry Topic</P>
                <ul>
                    <?php
                    for ($k=0 ; $k < $chemistryArrayCount; $k++){
                        echo "<li>";
                        echo $badgeController->getTopic($ChemistryTopicOne[$k]);
                        echo "</li>";
                    }
                    ?>
                </ul>

            </div>
            <?php
        }
        ?>
    </div>
</div>



<script>
    function openDescriptionOne(){
        // console.log(2);
        document.getElementById('main-detailOneDiv').style.display='block';


    }

    function hideTitleDescription(){
        document.getElementById('main-detailOneDiv').style.display='none';
    }
</script>
<?php unset($_SESSION['topicId']); ?>
<br><br>

                <!-- Activity Time Chart Section -->

                <b>
                    <p class="sub-title">Activity Time Log&nbsp;&nbsp;&nbsp;</p>
                </b>

                <div id="activity-time-log-container">
                    <?php
                    $last_week_dates = array();
                    $current_date = new DateTime();
                    for ($i = 1; $i <= 7; $i++) {
                        $last_week_dates[] = $current_date->modify('-1 day')->format('Y-m-d');
                    }
                    $last_week_dates = array_reverse($last_week_dates);

                    echo "
                    <canvas id='timeUsageChart'></canvas>
                    <script>
                    
                        var xValues2 = [";
                    for ($i = 0; $i < 7; $i++) {
                        echo "'" . $last_week_dates[$i] . "',";
                    }
                    echo "];
                        var yValues2 = [";
                    $status = $timeUsageController->getTimes();
                    if ($status) {
                        for ($i = 0; $i < 7; $i++) {
                            echo $_SESSION['daily_usages'][$i] . ",";
                        }
                    } else {
                        echo "0,0,0,0,0,0,0";
                    }
                    echo "];
                        var barColors = ['#bfe6ff', '#86c7f3','#4d9fe6','#2177b4','#1d5a90','#153c5f','#0f1f30'];
                    
                        new Chart('timeUsageChart', {
                            type: 'bar',
                            data: {
                                labels: xValues2,
                                datasets: [{
                                    label: 'Daily Time Usage',
                                    backgroundColor: barColors,
                                    data: yValues2
                                }]
                            },
                            options: {
                                
                                legend: {
                                    display: false,
                                },
                                title: {
                                    display: true,
                                    text: 'Daily Activity Time',
                                    color: 'navy',
                                    position: 'top',
                                    align: 'center',
                                    font: {
                                        
                                        fontSize:100,
                            
                                    },
                                    padding: 30,
                                    fullSize: true,
                                },
                                scales: {
                                    yAxes: [{
                                      scaleLabel: {
                                        display: true,
                                        labelString: 'Time in Minutes'
                                      }
                                    }],
                                    xAxes: [{
                                        scaleLabel: {
                                          display: true,
                                          labelString: 'Past 7 Days'
                                        }
                                      }]
                                } 
                                
                            },
                        });

                    </script>
                    ";
                    ?>
                </div>

                <br><br>

                <!-- Recommendations Section -->

                <b>
                    <p class="sub-title">Recommendations&nbsp;&nbsp;&nbsp;</p>
                </b>

                <div id="rec-container">
                    <div id="rec-card">
                        <div class="rec-msg-slides">
                            <button class="rec-nav-btns nav-btns-next">
                                <img src="../../public/icons/arrow-back.svg" class="arrow-icon" name="arrow-back">
                            </button>
                            <button class="rec-nav-btns nav-btns-prev">
                                <img src="../../public/icons/arrow-forward.svg" class="arrow-icon" name="arrow-forward">
                            </button>

                            <?php
                            $msgs = $recommendationsController->getRecommendations();
                            $rec_msgs = array();
                            $rec_msgs = $_SESSION['rec-msgs'];

                            if ($msgs && (!empty($rec_msgs))) {
                                echo "<ul class='slides-list'>";
                                $firstMsg = $rec_msgs[0];
                                echo "
                                        <li class='slide active-slide'>
                                            <figure class='slide-figure'>
                                                <blockquote class='slide-figure-text'>" . $firstMsg . "</blockquote>
                                            </figure>
                                        </li>
                                    ";
                                $rec_msg_count = 1;
                                for ($i = 1; $i < count($rec_msgs); $i++) {
                                    $rec_msg_count++;
                                    if ($rec_msg_count < 11) {
                                        echo "
                                            <li class='slide'>
                                                <figure class='slide-figure'>
                                                    <blockquote class='slide-figure-text'>" . $rec_msgs[$i] . "</blockquote>
                                                </figure>
                                            </li>
                                            ";
                                    } else {
                                        break;
                                    }
                                }
                                echo "
                                        </ul>
                                        <div class='btn-dots flex'>
                                            <button class='btn-dot active-dot'></button>";
                                $dot_count = 1;
                                for ($i = 1; $i < count($rec_msgs); $i++) {
                                    $dot_count++;
                                    if ($dot_count < 11) {
                                        echo "
                                                <button class='btn-dot'></button>
                                                ";
                                    } else {
                                        break;
                                    }
                                }

                                echo "   
                                        </div>
                                    ";
                            } else {
                                echo "
                                    <div class='slides-list'>
                                        <p id='no-rec-text'>No recommendations yet!</p>
                                            
                                    </div>
                                    ";
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="no-subjects-bought">
            <img src="../../public/img/cart-bg.svg" id="no-subjects-img">
            <p id="no-subjects-text">Buy subjects and join our community to view your dashboard.</p>
            <a href="./newSubjects.php" class="header-btns" id="buy-btn">Buy Now</a>

        </div>
    </div>

    <?php

    if (!($studentSubjectController->hasBought("Chemistry"))) {
        echo "
        <style>
        #chemistry, #chem-sec{
            display:none;
        }
        </style>
        ";
    }
    if (!($studentSubjectController->hasBought("Physics"))) {
        echo "
        <style>
        #physics, #phy-sec{
            display:none;
        }
        </style>
        ";
    }
    if (!($studentSubjectController->hasBought("Physics")) && !($studentSubjectController->hasBought("Chemistry"))) {
        echo "
        <style>
        #dashboard-section{
            display:none;
        }
        #no-subjects-bought{
            display:block;
        }
        </style>
        ";
    }

    ?>




</body>

</html>