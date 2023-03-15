<?php

class SignupController {

    private $connection;

    public function __construct(){

        $db_connection = DatabaseConnection::getInstance();
        $this->connection = $db_connection->getConnection();

    }

    public function does_email_exist($email){

        try {
            $query = "SELECT email FROM user WHERE email = '$email' LIMIT 1";
            $data = $this->connection->query($query);

            if($data && $data->num_rows > 0){
                $_SESSION['signup-error-message']="This email already exists";
                return false;
            }else{
                return true;
            }

        } catch(Exception $e) {
            $errorMessage = "An error occurred while checking email : " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

    public function is_username_valid($username){

        try {
            //Checks whether the username is valid
            if(preg_match("/^[\w\-]+@[\w\-]+.[\w\-]+$/",$username)){
                $_SESSION['signup-error-message']="The username should not include '@' symbol";
                return false;
            }else {
                //Checks whether the username exists
                $query = "SELECT username FROM user WHERE username='$username' limit 1";
                $result = $this->connection->query($query);
                if($result && mysqli_num_rows($result) > 0){
                    $_SESSION['signup-error-message']="This username already exists";
                    return false;
                }else {
                    return true;
                }
            }

        } catch(Exception $e) {
            $errorMessage = "An error occurred while username : " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

    public function is_password_valid($password){
        
        //Checks the length of the password
        if(strlen($password)<8){
            $_SESSION['signup-error-message']="The password must be at least 8 characters long";
            return false;
        }else{
            return true;
        }

    }

    public function do_passwords_match($password,$password_retype){

        //Checks the validation of the password re-entry
        if($password == $password_retype){
            return true;
        }else{
            $_SESSION['signup-error-message']="The re-entered password does not match";
            return false;
        }

    }

}

?>
