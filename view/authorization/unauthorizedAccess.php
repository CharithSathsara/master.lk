<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Unauthorized Access Error</title>

    <style>
        body{
            font-family: "Comic Sans MS";
            background: #00CED1;
        }
        #error-page{
            position: absolute;
            top: 5%;
            left: 5%;
            right: 5%;
            bottom: 5%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #008CBA;
            border-radius: 7px;
            box-shadow: 0px 5px 10px rgba(0,0,0,0.1);
        }
        .content h1.header{
            font-size: 5vw;
            color: #CA0123;
        }

    </style>

</head>
<body>

<?php

include_once('../../config/app.php');

?>

<div id="error-page">

    <div class="content">
        <h1 class="header">401 Unauthorized</h1>
        <h2><?php include('../../controller/authController/message.php') ?></h2>
        <img src="../../public/img/master_with_title.png" style="width: 35vw">
    </div>

</div>

</body>
</html>
