<?php

include('../../config/app.php');
include_once('../../model/Student.php');

if(isset($_POST["slip-upload-submit"])){

    if(!empty($_FILES["image"]["name"])){

        $fileName = basename($_FILES["image"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

        $image = $_FILES['image']['tmp_name'];
        $slipContent = addslashes(file_get_contents($image));

        if (!empty($db_connection)) {

            $isUploadSuccess = Student::slipUpload($db_connection->getConnection(),$_POST["totalAmount"], $slipContent, $_SESSION['auth_user']['userId']);

            unset($_POST["slip-upload-submit"]);
            if($isUploadSuccess){
                $_SESSION['slip-upload-success']="Uploaded the bank slip successfully !";
            }else{
                $_SESSION['slip-upload-error']="File upload failed, please try again!";
            }
            redirect("", "view/student/bankDeposit.php");

        }

    }else{
        unset($_POST["slip-upload-submit"]);
        $_SESSION['slip-upload-error']="Please select an image file to upload!";
        redirect("", "view/student/bankDeposit.php");
    }

}

?>

