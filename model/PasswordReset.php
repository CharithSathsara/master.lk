<?php

class PasswordReset {

    /**
     * Author:
     * @author Charith Sathsara
     */
    public static function insertToken($connection, $email, $token, $expires){

        try {

            $query = "INSERT INTO `password_reset` (`userId`, `email`, `token`, `expires`) VALUES ((SELECT userId From user WHERE email = '$email'), '$email', '$token', '$expires')";

            $data = $connection->query($query);

            if($data){
                return $data;
            }else{
                throw new Exception("Error: Unable to add password reset Token");
            }
        } catch(Exception $e) {
            $errorMessage = "An error occurred while adding password reset Token: " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

    public static function updatePassword($connection, $email, $password){

        try {

            $query = "UPDATE user SET password = '$password' WHERE email = '$email'";
            $data = $connection->query($query);

            if($data){

                $clear_query = "DELETE FROM password_reset WHERE email = '$email'";
                $clear_result = $connection->query($clear_query);

                if($clear_result) {
                    return true;
                } else {
                    throw new Exception("Error: Unable to clear tokens");
                }

            }else{
                throw new Exception("Error: Unable to update password");
            }
        } catch(Exception $e) {
            $errorMessage = "An error occurred while updating password : " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }


}