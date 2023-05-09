<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../../public/css/demo.css" />
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
    <div class="card">
        <div class="imgbox">
            <img
                src="https://images.pexels.com/photos/1815257/pexels-photo-1815257.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
        </div>

        <div class="content">
            <h2>keep Smiling</h2>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat
                doloribus vitae fugit enim repudiandae
            </p>
        </div>
    </div>
    <div class="card">
        <div class="imgbox">
            <img
                src="https://images.pexels.com/photos/1815257/pexels-photo-1815257.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
        </div>

        <div class="content">
            <h2>keep Smiling</h2>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat
                doloribus vitae fugit enim repudiandae
            </p>
        </div>
    </div>
    <div class="card">
        <div class="imgbox">
            <img
                src="https://images.pexels.com/photos/1815257/pexels-photo-1815257.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
        </div>

        <div class="content">
            <h2>keep Smiling</h2>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat
                doloribus vitae fugit enim repudiandae
            </p>
        </div>
    </div>
</body>

</html>