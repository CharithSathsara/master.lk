<?php

class LoginController {

    private $connection;

    public function __construct(){

        $db_connection = DatabaseConnection::getInstance();
        $this->connection = $db_connection->getConnection();

    }

    public function login($username_email, $password){

        // Reads data from the database
        if(!empty($username_email) && !empty($password)){
        
            //Checks whether the entered text is an email
            if(preg_match("/^[\w\-]+@[\w\-]+.[\w\-]+$/",$username_email)){
                $query1 = "SELECT * from user where email = '$username_email' limit 1 ";
                $result = $this->connection->query($query1);
            }
            //If the entered text is not an email
            else{
                $query2 = "SELECT * from user where userName = '$username_email' limit 1 ";
                $result = $this->connection->query($query2);
            }
    
            if($result && mysqli_num_rows($result)>0){
                $user_data = mysqli_fetch_assoc($result);
                if(password_verify($password, $user_data['password'])){
    
                    //Sets the session with user ID
                    $this->userAuthentication($user_data);
                    return true;

                }
                return false;
            }else{
                return false;
            }
    
        }

    }

    private function userAuthentication($user_data){

        $_SESSION['authenticated'] = true;
        $_SESSION['auth_role'] = $user_data['userType'];
        $_SESSION['auth_user'] = [
            'userId' => $user_data['userId'],
            'userEmail' => $user_data['email'],
            'userName' => $user_data['userName'],
            'userFirstName' => $user_data['firstName'],
            'userLastName' => $user_data['lastName']
        ];
        $_SESSION["cart-subjects"]=array();

    }


    public static function isLoggedIn(){

        //redirect to relevant dashboards
        if(isset($_SESSION['authenticated']) === TRUE){

            if($_SESSION['auth_role'] === "ADMIN"){
                redirect("admin", "view/admin/adminDashboard.php");
            }else if($_SESSION['auth_role'] === "TEACHER"){
                redirect("teacher", "view/teacher/teacherDashboard.php");
            }else if($_SESSION['auth_role'] === "CONTENTCREATOR"){
                redirect("contentcreator", "view/contentcreator/contentCreatorDashboard.php");
            }else{
                redirect("student", "view/student/studentDashboard.php");
            }

        }else{
            return false;
        }

    }

}

?>
