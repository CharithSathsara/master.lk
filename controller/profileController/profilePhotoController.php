<?php

include('../../config/app.php');
include_once('../../model/User.php');

if(isset($_POST["submit"])){

    if(!empty($_FILES["image"]["name"])){
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

        $image = $_FILES['image']['tmp_name']; 
        $imgContent = addslashes(file_get_contents($image));

        $isInsertSuccess = User::setprofilePhoto($db_connection->getConnection(),$imgContent);

        if($isInsertSuccess){ 
            unset($_POST["submit"]);
            redirect("Uploaded the file Successfully !", "view/common/profile.php");
        }else{
            unset($_POST["submit"]);
            $_SESSION['change-photo-error']="File upload failed, please try again!";
            redirect("", "view/common/profile.php");
            
        }  
    }else{
        unset($_POST["submit"]);
        $_SESSION['change-photo-error']="Please select an image file to upload!";
        redirect("", "view/common/profile.php");
    }
        
}



?>
