<?php


class SignupController{

    private $connection;

    public function __construct(){

        $db_connection = new DatabaseConnection();
        $this->connection = $db_connection->getConnection();

    }

    public function does_email_exist($email){

        $query = "SELECT email FROM user WHERE email = '$email' LIMIT 1";
        $data = $this->connection->query($query);

        if($data && $data->num_rows > 0){
            $_SESSION['signup-error-message']="This email already exists";
            return false;
        }else{
            return true;
        }

    }

    public function is_username_valid($username){

        //Checks whether the username is valid

        if(preg_match("/^[\w\-]+@[\w\-]+.[\w\-]+$/",$username)){
            $_SESSION['signup-error-message']="The username should not include '@' symbol";
            // $error="The username should not include '@' symbol";
            // $isValid = false;
            return false;
        }

        //Checks whether the username exists

        $query = "SELECT username FROM user WHERE username='$username' limit 1";
        $result = $this->connection->query($query);
        if($result && mysqli_num_rows($result) > 0){
            $_SESSION['signup-error-message']="This username already exists";
            // $isValid = false;
            return false;
        }

        return true;

    }

    public function is_password_valid($password){
        
        //Checks the length of the password
        if(strlen($password)<8){
            $_SESSION['signup-error-message']="The password must be at least 8 characters long";
            // $isValid = false;
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
            $_SESSION['signup-error-message']="The re-enterd password does not match";
            return false;
        }

    }

    public function register($first_name, $last_name, $dob, $address_first, $address_second, $telephone, $email, $username, $password){

        //$query = "INSERT INTO user (email, password) VALUES ('$email', '$password')";
        // $query = "INSERT INTO `user` (`userId`, `userName`, `password`, `firstName`, `lastName`, `email`, `mobile`, `addLine01`, `addLine02`, `image`, `userType`) 
        //           VALUES (NULL, '$username', '$password', '$firstname', '$lastname', '$email', '$mobile', '$add01', '$add02', NULL, 'STUDENT')";
        // $data = $this->connection->query($query);

        // return $data;

        // Inserts data into the database - 'User Table'
        if(!empty($first_name) && !empty($last_name) && !empty($dob) && !empty($address_first) && !empty($address_second) && 
        !empty($telephone) && !empty($email) && !empty($username) && !empty($password)){
            $query1 = "INSERT into user (
                    userName,
                    password,
                    firstName,
                    lastName,
                    email,
                    mobile,
                    addLine01,
                    addLine02,
                    userType 
            ) VALUES ('$username',
                        '$password',
                        '$first_name',
                        '$last_name',
                        '$email',
                        '$telephone',
                        '$address_first',
                        '$address_second',
                        'STUDENT'
                        )";
            $this->connection->query($query1);

            // Inserts data into the database - 'Student Table'

            $query2 = "SELECT userId from user where userName = '$username'";
            $result = $this->connection->query($query2);

            if($result && mysqli_num_rows($result) > 0){
                $user_data = mysqli_fetch_assoc($result);
                $user_id = $user_data["userId"];
            }

            $query3 = "INSERT into student (
                        studentId,
                        dob
            ) VALUES( '$user_id',
                        '$dob'
            )";
            $result = $this->connection->query($query3);
            
            return $result;
        }else{
            return false;
        }
    }
}

?>
