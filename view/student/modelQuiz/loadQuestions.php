<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Model Quiz</title>
    <link rel="stylesheet" href="../../../public/css/modelQuiz.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <!-- <script src="../../../public/js/modelQuizQuestion.js"></script>
    <script src="../../../public/js/modelQuiz.js"></script> -->

</head>

<body>
    <?php
include('../../../config/app.php');
// include('../../../controller/studentController/quizController/modelQuizController.php');
include_once('../../../controller/authController/authentication/Authentication.php');
include_once('../../../controller/authController/authorization/Authorization.php');



//check user authenticated or not
//$authentication = new Authentication();
//$authentication->authorizingAdmin();

//User Authentication
Authentication::userAuthentication();
//User Authorization
Authorization::authorizingStudent();

$question_no = "";
$question = "";
$opt1 = "";
$opt2 = "";
$opt3 = "";
$opt4 = "";
$opt5 = "";
$correctAnswer = "";
$count=0;

$questionNo = $_GET["questionNo"];

if(isset($_SESSION["answer"][$questionNo])){
$correctAnswer = $_SESSION["answer"][$questionNo];
}

$_SESSION['topicId'] = 2;
$topicId = 2;
$sql = "SELECT * FROM question WHERE topicId = '$topicId' AND questionType = 'MODELQUESTION' ORDER BY RAND() LIMIT 10";
$questions = mysqli_query($db_connection->getConnection(), $sql);

if($count ==0){
echo"over";
}else{
while($row = mysqli_fetch_array($questions)){
    $question_no = $row['questionId'];
    $question = $row['question'];
    $opt1 = $row['opt01'];
    $opt2 = $row['opt02'];
    $opt3 = $row['opt03'];
    $opt4 = $row['opt04'];
    $opt5 = $row['opt05'];
}
?>
    <br>
    <?php echo "(".$question_no .")". $question;?>
    <br>
    <input type="radio" id="option" name="option" value="<?php echo $opt1;?>">
    <?php if($correctAnswer == $opt1){
    echo "checked";
    }
}
    ?>


</body>

</html>