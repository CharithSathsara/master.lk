<?php

class User {

    public static function setprofilePhoto($connection,$imgContent){

        $userId = $_SESSION['auth_user']['userId'];

        $query = "UPDATE user SET image = '$imgContent' WHERE userId='$userId'";

        $result = $connection->query($query);

        if($result){
            return true;
        }else{
            return false;
        }

    }

    public static function removeProfilePhoto($connection){

        $userId = $_SESSION['auth_user']['userId'];

        $query = "UPDATE user SET image = null WHERE userId='$userId'";

        $result = $connection->query($query);

        if($result){
            return true;
        }else{
            return false;
        }

    }

    public static function getprofilePhoto($connection){

        $userId = $_SESSION['auth_user']['userId'];

        $query = "SELECT image FROM user WHERE userId='$userId'";

        $result = $connection->query($query);
        $row = $result->fetch_assoc();

        if($row['image']!=null){

            $to_echo = "<img id='profile-pic' src='data:image/jpg;charset=utf8;base64,";
            $to_echo .= base64_encode($row['image']);
            $to_echo .= "'/>";
            echo $to_echo;

            return true;
        }else{
            echo "<img id='profile-pic' src='../../public/img/default-profPic.png'/>";
            return false;
        }


    }

    public static function changePassword($connection,$current_password,$new_password,$retype_new_password){

        $userId = $_SESSION['auth_user']['userId'];

        $query = "SELECT password FROM user WHERE userId='$userId'";

        $result = $connection->query($query);

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $password = $row['password'];

            //Checks whether the current password is correct
            if($current_password==$password){
                
                //Checks whether the new password is equal to the old password
                if(!($new_password==$password)){

                    //Checks the length of the new password
                    if(!(strlen($new_password)<8)){

                        //Checks the validation of the password re-entry
                        if($new_password == $retype_new_password){

                            $query = "UPDATE user SET password = '$new_password' WHERE userId='$userId'";
                            $result = $connection->query($query);

                            if($result){
                                return true;
                            }else{
                                $_SESSION['change-pw-error']="Could not change the password!";
                                return false;
                            }
                        }else{
                            $_SESSION['change-pw-error']="The re-enterd password does not match!";
                            return false;
                        }

                    }else{
                        $_SESSION['change-pw-error']="The new password must be at least 8 characters long!";
                        return false;
                    }
                }else{
                    $_SESSION['change-pw-error']="The new password must be different from the old password!";
                    return false;
                }

            }else{
                $_SESSION['change-pw-error']="The current password is incorrect!";
                return false;
            }
        }

    }

    public static function getProfileData($connection,$req_data){

        $userId = $_SESSION['auth_user']['userId'];

        $query = "SELECT $req_data FROM user WHERE userId='$userId'";

        $result = $connection->query($query);
        $data = $result->fetch_assoc();

        if($result && mysqli_num_rows($result) > 0){
            return $data[$req_data];
        }else{
            return false;
        }

    }

    public static function getProfileDataStudent($connection){

        $userId = $_SESSION['auth_user']['userId'];

        $query = "SELECT dob FROM student WHERE studentId='$userId'";

        $result = $connection->query($query);
        $data = $result->fetch_assoc();

        if($result && mysqli_num_rows($result) > 0){
            return $data['dob'];
        }else{
            return false;
        }

    }

    public static function getUserName($connection, $userId){

        try {
            $query = "SELECT firstName, lastName FROM user WHERE userId = $userId";
            $data = $connection->query($query);
            $user = $data->fetch_assoc();

            if($user){
                return $user['firstName'].' '.$user['lastName'];
            }else{
                throw new Exception("Error: Unable to fetch user name");
            }
        } catch(Exception $e) {
            $errorMessage = "An error occurred while fetching user name: " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

    public static function changeUserInfo($connection,$first_name, $last_name, $dob, $address_first, $address_second, $telephone, $email, $username){


        $userId = $_SESSION['auth_user']['userId'];

        $query = "UPDATE user 
        SET firstName = '$first_name', 
            lastName = '$last_name',
            addLine01 = '$address_first',
            addLine02 = '$address_second',
            mobile = '$telephone',
            email = '$email',
            userName = '$username'
        WHERE userId = '$userId' ;";

        $result = $connection->query($query);

        $query2 = "UPDATE student 
        SET dob = '$dob', 
        WHERE userId = '$userId' ;";

        $result2 = $connection->query($query2);

        if($result && $result2){
            return true;
        }else{
            return false;
            
        }

    }


}

?>