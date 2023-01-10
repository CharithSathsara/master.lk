<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?= base_url('public/css/header.css') ?>>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <style>
        #logout{
            float:right;
            margin-right:40px;
        }

        #header-container button{
            background: none;
            color: inherit;
            border: none;
            padding: 0;
            font: inherit;
            cursor: pointer;
            outline: inherit;
        }

        #logout-text{
            display: inline-block;
            color: #ffffff;
            vertical-align: middle;
        }

        #logout-icon{
            display: inline-block;
            height:25px;
            vertical-align: middle;
            margin-left: 10px;
        }
    </style>

    <title></title>
</head>
<body>

<div id="header-container">
    <div id="white-line"></div><br>
    <div id="blue-line">
        <form method="post" action=<?= base_url('controller/authController/authentication/login/login.php') ?>>
            <button id="logout" name="logout">

                <p id="logout-text">Log Out</p>
                <img src=<?= base_url('public/icons/logout.svg') ?> id="logout-icon">

            </button>
        </form>
    </div>
    <img src=<?= base_url('public/img/logo-header.png') ?> alt="logo" id="header-logo">
</div>

</body>
</html>
