<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../public/css/adminDashboard.css">

    <title>Admin Dashboard</title>
</head>
<body>
    <div class="popup-deleteContent" id="Delete-contentPop">
        <div class="delete-contentPop">
            <div class="delete-headerContentPop">
                <img src="../../public/img/important.png" id="closeDelete-popBox">
                <h3>Delete Confirmation</h3>
                <div class="close-deleteCreator">
                    <button onclick="closeDeleteCreatorPop()"><img src="<?= base_url('public/img/close.png') ?>"> </button>
                </div>
            </div>
            <div class="deletePop-contentBody">
                <p>Are you sure you want to delete this Content Creator?</p>
            </div>

            <div class="deletePop-contentButton">
                <form action="<?= base_url('controller/adminController/dashboardController/deleteContentCreatorController.php'); ?>" method="post">
                    <input type="hidden" name="userId" id="creatorUserId">
                    <input type="submit" class="deleteYes-button" id="deleteYes-btn" value="Yes" name="DeleteCreator-btn">
                </form>
                <button class="deleteContentNo-button" id="deleteContentNo-btn" onclick="close()">No</button>
            </div>
        </div>
    </div>

<script src="../../../public/js/deleteContentCreator.js"></script>
</body>
