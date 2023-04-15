<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../../public/css/studentDashboard.css?<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
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

include_once('../common/navBar-Student.php');
include_once('../common/header.php');
include_once('../../controller/studentController/dashboardController/lessonController.php');
include_once('../../controller/studentController/dashboardController/studentSubjectController.php');
include_once('../../controller/studentController/dashboardController/subjectProgressController.php');
include_once('../../controller/studentController/dashboardController/progressController.php');
include_once('../../controller/studentController/dashboardController/recommendationsController.php');
include_once('../../model/Student.php');
include_once('../../model/Lesson.php');
include_once('../../model/Topic.php');

$lessonController = new lessonController();
$studentSubjectController = new studentSubjectController();
$subjectProgressController = new subjectProgressController();
$progressController = new progressController();
$recommendationsController = new recommendationsController();

?>

<div id="student-dashboard-container">
    <div id="student-dashboard">

        <b><p id="title">Dashboard</p></b>

        <!-- My Subjects Section -->

        <div id="dashboard-section">
            
            <b><p class="sub-title">My Subjects&nbsp;&nbsp;&nbsp;</p></b>

            <div id="my-subjects-container">

                <div id='chemistry' class='subject-card'>
                        <b><p class='card-title'>Chemistry</p></b>

                        <!-- Displays the progress of Chemistry Subject -->

                        <div class="progress-container">
                            <label id="progress-value-text"><?=$subjectProgressController->getSubjectProgress('Chemistry');?>%</label>
                            <progress id="progress-bar" value="<?=$subjectProgressController->getSubjectProgress('Chemistry');?>" max="100">
                                <div class="progress-value">
                                    <span class="progress-perc"><?=$subjectProgressController->getSubjectProgress('Chemistry');?>%</span>
                                </div>
                            </progress>
                        </div>
                        
                        <!-- Gets the lessons of the Chemistry Subject from the database -->

                        <div class='lesson-container'>
                            <?=$lessonController->getLessons("Chemistry");?>
                            
                        </div>
                </div>


                <div id='physics' class='subject-card'>
                        <b><p class='card-title'>Physics</p></b>

                        <!-- Displays the progress of Physics Subject -->

                        <div class="progress-container">
                            <label id="progress-value-text"><?=$subjectProgressController->getSubjectProgress('Physics');?>%</label>
                            <progress id="progress-bar" value="<?=$subjectProgressController->getSubjectProgress('Physics');?>" max="100">
                                <div class="progress-value">
                                    <span class="progress-perc"><?=$subjectProgressController->getSubjectProgress('Physics');?>%</span>
                                </div>
                            </progress>
                        </div>

                        <!-- Gets the lessons of the Physics Subject from the database -->
                        
                        <div class='lesson-container'>
                            <?=$lessonController->getLessons("Physics")?>
                        </div>
                </div>

            </div>

            <br><br> 

            <!-- Completion Section -->

            <b><p class="sub-title">Completion&nbsp;&nbsp;&nbsp;</p></b> 

            <div id="completion-container">
                <div id="chem-sec" class="subject-progress-card">
                    <p class="progress-card-title">Chemistry</p><br>
                    <div id="inner-container">
                        <?=$lessonController->getLessonCompletion("Chemistry")?>
                        <div id="lesson-names">
                            <?php
                            $rows = array();
                            $rows = $_SESSION['lesson_rows'];
                            foreach ($rows as $row) {
                            
                                echo "<p class='lesson-name-item'>" . $row['lessonName'] . "</p>";
                            
                            }?>
                        </div>
                        <div id="progress-values">
                            <?php
                            $values = array();
                            $values = $_SESSION['lesson_progress_values'];
                            foreach ($values as $row2) {
                            
                                echo "<p class='progress-value'>" . $row2 . "%</p>";
                                echo "<progress class ='lesson-progress-bars' value='".$row2."' max='100'></progress><br><br>";
                            
                            }?>
                        </div>  
                    </div>
                </div>
                <br>
                <div id="phy-sec" class="subject-progress-card">
                    <p class="progress-card-title">Physics</p><br>
                    <div id="inner-container">
                        <?=$lessonController->getLessonCompletion("Physics")?>
                        <div id="lesson-names">
                            <?php
                            $rows = array();
                            $rows = $_SESSION['lesson_rows'];
                            foreach ($rows as $row) {
                            
                                echo "<p class='lesson-name-item'>" . $row['lessonName'] . "</p>";
                            
                            }?>
                        </div>
                        <div id="progress-values">
                            <?php
                            $values = array();
                            $values = $_SESSION['lesson_progress_values'];
                            foreach ($values as $row2) {
                            
                                echo "<p class='progress-value'>" . $row2 . "%</p>";
                                echo "<progress class ='lesson-progress-bars-phy' value='".$row2."' max='100'></progress><br><br>";
                            
                            }?>
                        </div>  
                    </div>
                </div>
            </div>

            <br><br> 

            <!-- Progress Section -->

            <b><p class="sub-title">Progress&nbsp;&nbsp;&nbsp;</p></b> 
            
            <div id="progress-container">

                <form action="" method="get" id="progress-checking-form">
                    <label for="lesson">Select the lesson : </label><br><br>
                    <select name="lesson" id="lesson-progress">
                        <option value="default" disabled selected hidden>Select a lesson</option>
                        <optgroup label="Chemistry">
                        <?php
                            $chem_lessons = $lessonController->getAllLessons("Chemistry");
                            foreach($chem_lessons as $lesson){
                                echo "<option value='".$lesson['lessonName']."'>".$lesson['lessonName']."</option>";
                            }
                        ?>
                        </optgroup>
                        <optgroup label="Physics">
                        <?php
                            $phy_lessons = $lessonController->getAllLessons("Physics");
                            foreach($phy_lessons as $lesson){
                                echo "<option value='".$lesson['lessonName']."'>".$lesson['lessonName']."</option>";
                            }
                        ?>
                        </optgroup>
                    </select>
                    <input type="submit" value="Check Progress" id="select-lesson-btn" name="get-progress-lesson">
                    
                </form>

                <!-- <script>
                    document.getElementById('progress-checking-form').addEventListener('submit', function() {
                    //    setTimeout(() => {
                    //     console.log('xxxxxxx');
                    //    }, 3000);
                       window.scrollTo(0, 850); 
                       event.preventDefault();

                        
                        
                    });
                    
                </script> -->
    
                <?php

                    if(isset($_GET['get-progress-lesson']) && isset($_GET['lesson'])){

                        echo "<script>
                          setTimeout(()=>{
                            window.scrollTo({
                                top: 850,
                                behavior: 'smooth',
                               }); 
                          },50)
                         </script>";
                        
                        $status = $progressController->hasStarted($_GET['lesson']);

                        if($status){
                        
                            $topics = $progressController->getTopicsOfLesson($_GET['lesson']);
                            echo "
                            <canvas id='progressChart'></canvas>
                            <script>
                                const xValues = [";

                                foreach($topics as $topic){
                                    echo "'".$topic['topicTitle']."',";
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

                                    $progressController->getLessonProgress($_GET['lesson'],'MODELPAPER');

                                    echo
                                    "],
                                    borderColor: 'green',
                                    fill: false
                                    },
                                    {label: 'Average Marks - Past Papers',
                                    data: [";

                                    $progressController->getLessonProgress($_GET['lesson'],'PASTPAPER');
    
                                    echo
                                    "],
                                    borderColor: 'red',
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
                                        text: 'Progress - ".$_GET['lesson']."',
                                        color: 'navy',
                                        position: 'top',
                                        align: 'center',
                                        font: {
                                            
                                            fontSize:100,
                                
                                        },
                                        padding: 30,
                                        fullSize: true,
                                    }
                                    
                                },
                                });
                            </script>
                            ";   
                                
                            
                        }else{
                            echo "<div id='no-lesson-selected'>
                                    <div id='no-lesson-section'>
                                        <img id='no-lesson-img' src='../../public/img/chart.png'><br>
                                        <p id='no-lesson-text'>You have not completed any quizzes from <span><b>'".$_GET['lesson']."'</b></span></p>
                                    </div>
                                </div>";
                        }
                    }else{
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

                ?>
            </div>

            <br><br>

            <!-- Badges Section -->

            <b><p class="sub-title">Badges&nbsp;&nbsp;&nbsp;</p></b>

            <div id="badge-container">

            </div>

            <br><br> 

            <!-- Recommendations Section -->

            <b><p class="sub-title">Recommendations&nbsp;&nbsp;&nbsp;</p></b>

            <div id="rec-container">
                <?php
                // $msgs = $recommendationsController->getRecommendations();
                
                ?>
                    <!-- <div class="rec-cards">
                        <div class="msg-container">

                        </div>
                        <img src="../../public/img/master.svg" class="master-img">
                    </div> -->
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
    
    if(!($studentSubjectController->hasBought("Chemistry"))){
        echo"
        <style>
        #chemistry, #chem-sec{
            display:none;
        }
        </style>
        ";
    }
    if(!($studentSubjectController->hasBought("Physics"))){
        echo"
        <style>
        #physics, #phy-sec{
            display:none;
        }
        </style>
        ";
    }
    if(!($studentSubjectController->hasBought("Physics")) && !($studentSubjectController->hasBought("Chemistry"))){
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
