<?php

class RegisterController{

    private $connection;

    public function __construct(){

        $db_connection = new DatabaseConnection();
        $this->connection = $db_connection->getConnection();

    }

    public function register($firstname, $lastname, $dob, $add01, $add02, $mobile, $email, $username, $password){

        $queryToUser = "INSERT INTO `user` (`userId`, `userName`, `password`, `firstName`, `lastName`, `email`, `mobile`, `addLine01`, `addLine02`, `image`, `userType`) 
                  VALUES (NULL, '$username', '$password', '$firstname', '$lastname', '$email', '$mobile', '$add01', '$add02', NULL, 'STUDENT');";

        $response = $this->connection->query($queryToUser);

        if($response){
            $queryToStudent = "INSERT INTO `student` (`studentId`, `dob`) VALUES ((SELECT userId FROM user WHERE email = '$email') , '$dob');";
            $data = $this->connection->query($queryToStudent);
            return $data;
        }else{
            return false;
        }

    }

    public function confirmPassword($password, $c_password){

        if($password === $c_password){
            return true;
        }else{
            return false;
        }

    }

    public function checkPasswordStrength($password){

        $number = preg_match('@[0-9]@', $password);
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if(strlen($password) < 8){
            redirect("Password must be at least 8 characters in length", "view/authentication/register.php");
        }else if(!$number){
            redirect("Password must contain at least one number", "view/authentication/register.php");
        }else if(!$uppercase){
            redirect("Password one upper case letter", "view/authentication/register.php");
        }else if(!$lowercase){
            redirect("Password one lower case letter", "view/authentication/register.php");
        }else if(!$specialChars){
            redirect("Password one special character", "view/authentication/register.php");
        }else{
            return true;
        }

    }

    public function isUserNameExists($userName){

        $query = "SELECT userName FROM user WHERE userName = '$userName' LIMIT 1";
        $data = $this->connection->query($query);

        if($data->num_rows > 0){
            return true;
        }else{
            return false;
        }

    }

    public function isEmailExists($email){

        $query = "SELECT email FROM user WHERE email = '$email' LIMIT 1";

        $data = $this->connection->query($query);

        if($data->num_rows > 0){
            return true;
        }else{
            return false;
        }

    }

}

?>
