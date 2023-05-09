<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../public/css/systemInformation.css">
    <title>System Information</title>
</head>
<body>

    <?php

        include_once('../../../config/app.php');
        include_once('../../../controller/authController/authentication/Authentication.php');
        include_once('../../../controller/authController/authorization/Authorization.php');

        //User Authentication
        Authentication::userAuthentication();
        //User Authorization
        Authorization::authorizingAdmin();
    ?>
    <?php
        include_once ('../../../config/app.php');
        include_once('../../common/header.php');
        include_once('../../common/navBar-Admin.php');
//        include_once ('../../../model/instituteDetails.php');
//        include_once ('../../../model/BankDetails.php');
        include_once ('../../../controller/adminController/systemInformationController/systemInformationController.php');

//    $institute = new systemInformationController();
    ?>

    <div class="main">
        <div class="main-second">
            <div class="header-section">
                <p id="Update-System-Information">Update System Information</p>
            </div>

            <div class="first-updateSection">
                <?php
                   $systemDetails = new systemInformationController();
                $instituteDetails = $systemDetails->getAllDetailsInstitute();

                if(mysqli_num_rows($instituteDetails)>0){
                    if($instituteDetails){
                        ?>
<!--   View Institute Details-->
                        <div class="institute-details">
                            <?php
                            foreach ($instituteDetails as $instituteDetail){
                                ?>
                                <div class="instituteDetails-update">
                                    <p>Institute Details</p>
<!--    Institute details update button-->
                                    <?php
                                        $_SESSION['institute']['name'] = $instituteDetail['instituteName'];
                                        $_SESSION['institute']['email'] = $instituteDetail['email'];
                                        $_SESSION['institute']['Number'] = $instituteDetail['number'];
                                        $_SESSION['institute']['fax'] = $instituteDetail['fax'];
                                        $_SESSION['institute']['address01'] = $instituteDetail['address01'];
                                        $_SESSION['institute']['address02'] = $instituteDetail['address02'];
                                    ?>

                                    <div class="instituteUpdate-button">
                                        <button onclick="showUpdatePopBox()"><img id="instituteDetails-update" src="../../../public/img/update.svg"></button>
                                    </div>
                                </div>
                                <div class="details-view">
                                    <p>Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  :&nbsp;&nbsp; <?= $instituteDetail['instituteName'] ?></p>
                                    <p>Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; :&nbsp;&nbsp; <?= $instituteDetail['email'] ?></p>
                                    <p>Number&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  :&nbsp;&nbsp; <?= $instituteDetail['number'] ?></p>
                                    <p>Fax &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;<?= $instituteDetail['fax'] ?></p>
                                    <p>Address01&nbsp;&nbsp; :&nbsp;&nbsp; <?= $instituteDetail['address01'] ?></p>
                                    <p>Address02&nbsp;&nbsp; :&nbsp;&nbsp; <?= $instituteDetail['address02'] ?></p>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                    }
                }else{
                        ?>
<!--     If doesn't exist institute details add Details                   -->
                        <div class="AddInstitute-details">
                            <div class="instituteDetails-update">
                                <p>Institute Details</p>
                                <div class="instituteUpdate-button">
                                    <button"><img id="instituteDetails-update" src="../../../public/img/update.svg"></button>
                                </div>
                            </div>
<!--    Add Institute details script -->
                            <script>

                                document.getElementById('instituteDetails-update').style.display = 'none';
                                function closeAddInstitute(){
                                    document.getElementById('main-AddSection').style.display = 'none';
                                }
                                function displayAddInstituteBox(){
                                    document.getElementById('error-message-add-institute').style.display = 'none';
                                    document.getElementById('main-AddSection').style.display = 'block';

                                    document.getElementById('close-addInstitute-Pop').addEventListener('click',function (){
                                        document.getElementById('main-AddSection').style.display = 'none';
                                    })
                                }
                            </script>
<!--                           <button><img src="../../../public/img/add.svg" </button>-->
                            <div class="addInstitute">
                                <p>Please, Add an Institute</p>
                                <button id="AddInstitute-button" onclick="displayAddInstituteBox()">Add Institute</button>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

<!--    Add institute php page    -->
                <?php include_once('addInstitute.php') ?>
<!--    Update institute php page-->
                <?php include_once ('updateInstitute.php');?>
<!--    Update institute Js function page        -->
                <script src="../../../public/js/instituteDetailsUpdate.js"></script>

<!--    bank details-->
                <?php
//                $bank = new systemInformationController();
                $bankDetails = $systemDetails->getAllDetailsBank();

                if(mysqli_num_rows($bankDetails)>0){
                    if($bankDetails){
                        ?>
                        <div class="bank-details">
                            <?php
                            foreach ($bankDetails as $bankDetail){
                                $_SESSION['Bank']['AccountNumber'] = $bankDetail['AccountNumber'];
                                $_SESSION['Bank']['HolderName'] = $bankDetail['HolderName'];
                                $_SESSION['Bank']['BankName'] = $bankDetail['BankName'];
                                $_SESSION['Bank']['BranchName'] = $bankDetail['BranchName'];
//View bank details
                                ?>
                                <div class="bankDetails-update">
                                    <p>Bank Details</p>
                                    <div class="bankUpdate-button">
                                        <button onclick="updateBankAccountPop()"><img id="bankDetails-update" src="../../../public/img/update.svg"></button>
                                    </div>
                                </div>
                                <div class="details-view">
                                    <p>Holder Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp; <?= $_SESSION['Bank']['AccountNumber'] ?></p>
                                    <p>Bank Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp; <?= $_SESSION['Bank']['HolderName'] ?></p>
                                    <p>Account Number&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  :&nbsp;&nbsp; <?= $_SESSION['Bank']['BankName'] ?></p>
                                    <p>Branch Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;<?= $_SESSION['Bank']['BranchName'] ?></p>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                }else{
                        ?>
                        <div class="bank-details">
                            <div class="bankDetails-update">
                                <p>Bank Details</p>
                                <div class="bankUpdate-button">
                                    <button><img id="bankDetails-update" src="../../../public/img/update.svg"></button>
                                </div>
                                <script>
                                    document.getElementById('bankDetails-update').style.display = 'none';
                                </script>
                            </div>
                            <div class="second-addBank">
                                <div class="add-bankDetails">
                                    <p>Please, Add a Bank Account</p>
                                </div>
                                <div class="addBankDetails-button">
                                    <button id="add-bankAccountPop" onclick="showAddBankDetailsPop()">Add Bank Account</button>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
            </div>

<!--            Add bank account php page-->
            <?php include_once('addBankAccountDetails.php');?>

<!--            Add and Update function include js file -->
            <script src="../../../public/js/AddUpdateBankDetails.js"></script>

<!--            Update Bank Account details-->
            <?php include_once('updateBankAccountDetails.php');?>


            <div class="second-updateSection">
<!--                --><?php
//                    $allDescription = new systemInformationController();
//                ?>
                <div class="secondSection-header">
                    <p>About Subjects</p>
                </div>
                <div class="subject-description">
                    <div class="chemistry-description">
                        <div class="header-chemistry">
                            <p>Chemistry</p>
<!--    Update chemistry subject                        -->
                            <div class="chemistry-update">
                                <button id="chemistryUpdate-button" onclick="viewUpdateChemistryDescription()"><img src="../../../public/img/update.svg" id="chemistryUpdate-buttonImage"></button>
                            </div>
                        </div>
                        <?php
                            $chemistryDescription = $systemDetails->getSubjectDetails(2);
                            $chemistryPrice = $systemDetails->getSubjectPrice('Chemistry');

                        $_SESSION['chemistry']['Description'] = $chemistryDescription;
                        $_SESSION['chemistry']['Price'] = $chemistryPrice;
//view chemisrty subject description
                            if($chemistryDescription){
                        ?>
                        <div class="details-chemistry">
                            <p class="p-description">Description : </p>
                            <?php
                                echo $chemistryDescription;
                            ?>
                            <p class="p-price">Price :</p>
                            <?php
                                echo "LKR. ". $chemistryPrice;
                            ?>
                        </div>
                        <?php
                            }else{
                                ?>
                                 <script>
                                     document.getElementById('chemistryUpdate-button').style.display = "none";
                                 </script>
<!--    Add chemistry subject                            -->
                                <div class="AddDetails-chemistry">
                                    <p>Please, add a Chemistry Description and Price</p>
                                    <button id="AddDescription-chemistry" onclick="showAddChemistryPop()">Add Description</button>
                                </div>
                        <?php
                            }
                        ?>
                    </div>

                    <div class="physics-description">
                        <div class="header-physics">
                            <p>Physics</p>
<!--   Update physics subject                         -->
                            <div class="physics-update">
                                <button id="physicsUpdate-button" onclick="showUpdatePhysicsPop()"><img src="../../../public/img/update.svg" id="physicsUpdate-buttonImage"></button>
                            </div>
                        </div>
                        <?php
                        $physicsDescription = $systemDetails->getSubjectDetails(1);
                        $physicsPrice = $systemDetails->getSubjectPrice('Physics');

                        $_SESSION['physics']['Description'] = $physicsDescription;
                        $_SESSION['physics']['Price'] = $physicsPrice;

//                        echo $_SESSION['physics']['Description'];
//View physics subject
                        if($physicsDescription){
                        ?>
                        <div class="details-physics">
                            <p class="p-description">Description : </p>
                            <?php
                                echo $physicsDescription;
                            ?>
                            <p class="p-price">Price :</p>
                            <?php
                                echo "LKR. ". $physicsPrice;
                            ?>
                        </div>
                        <?php
                            }else{
                                ?>
                                <script>
                                    document.getElementById('physicsUpdate-button').style.display = "none";
                                </script>
<!-- Add physics subject description                           -->
                                <div class="AddDetails-physics">
                                    <p>Please, add a physics Description and Price</p>
                                    <button id="AddDescription-physics" onclick="addPhysicsDescriptionPop()">Add Description</button>
                                </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--    Add subject description page-->
    <?php include_once('addSubjectDescription.php') ;?>

<!--    Add Subject description js file -->
    <script src="../../../public/js/addSubjectDescription.js"></script>

<!--    update subject description-->
    <?php include_once('updateChemistryDescription.php');?>

    <!--    update subject description-->
    <?php include_once('updatePhysicsDescription.php');?>

<!--    Update description js file-->
    <script src="../../../public/js/updateDescription.js"></script>



    <?php
        if(isset($_SESSION['add-institute'])){
            echo "<style>
                    .main-AddSection{
                        display: block;
                    }
                </style>";
            unset($_SESSION['add-institute']);
        }

    if(isset($_SESSION['Update-institute'])){
        echo "<style>
                    .updateInstitute-main{
                        display: block;
                    }
                </style>";
        unset($_SESSION['Update-institute']);
    }

    if(isset($_SESSION['add-bank'])){
        echo "<style>
                    .mainDiv-addBank{
                        display: block;
                    }
                </style>";
        unset($_SESSION['add-bank']);
    }

    if(isset($_SESSION['update-bank'])){
        echo "<style>
                    .Update-BankDetails{
                        display: block;
                    }
                </style>";
        unset($_SESSION['update-bank']);
    }
    if(isset($_SESSION['add-physicsDescription'])){
        echo "<style>
                    .mainDiv-addSubject{
                        display: block;
                    }
                    #container-addPhysics{
                        display: block;
                    }
                </style>";
        unset($_SESSION['add-physicsDescription']);
    }

    if(isset($_SESSION['add-ChemistryDescription'])){
        echo "<style>
                    .mainDiv-addSubject{
                        display: block;
                    }
                    #container-addChemistry{
                        display: block;
                    }
                </style>";
        unset($_SESSION['add-ChemistryDescription']);
    }

    if(isset($_SESSION['update-ChemistryDescription'])){
        echo "<style>
                    .mainDiv-updateChemistrySubject{
                        display: block;
                    }
                </style>";
        unset($_SESSION['update-ChemistryDescription']);
    }

    if(isset($_SESSION['update-physicsDescription'])){
        echo "<style>
                    .mainDiv-updatePhysicsSubject{
                        display: block;
                    }
                </style>";
        unset($_SESSION['update-physicsDescription']);
    }

    ?>



</body>
</html>
