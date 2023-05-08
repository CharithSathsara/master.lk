<?php

class PasswordResetController {

    private $connection;

    public function __construct(){

        $db_connection = DatabaseConnection::getInstance();
        $this->connection = $db_connection->getConnection();

    }

    public function verify_email($email) {

        try {
            $query = "SELECT email FROM user WHERE email = '$email' LIMIT 1";
            $data = $this->connection->query($query);

            if($data && $data->num_rows > 0){
                return true;
            }else{
                //add exception
                return false;
            }

        } catch(Exception $e) {
            $errorMessage = "An error occurred while verifying email : " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

    public function verify_token_and_time($email, $token) {

        try {

            $query = "SELECT * FROM password_reset WHERE email = '$email' AND token = '$token' AND expires > NOW()";

            $result = $this->connection->query($query);

            if($result && $result->num_rows > 0) {
                return true;
            } else {
                //add exception
                return false;
            }

        } catch(Exception $e) {
            $errorMessage = "An error occurred while verifying token validity : " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

}