<?php

class LoginController{

    private $connection;

    public function __construct(){

        $db_connection = new DatabaseConnection();
        $this->connection = $db_connection->getConnection();

    }

    public function login($username, $password){

        $query = "SELECT * FROM user WHERE username='$username'";
        $response = $this->connection->query($query);

        if($response->num_rows > 0){

            $data = $response->fetch_assoc();

            if(password_verify($password, $data['password'])){
                $this->userAuthentication($data);
                return true;
            }else {
                redirect("Password is Incorrect", "view/authentication/login.php");
            }

        }else{
            redirect("User Name is Incorrect", "view/authentication/login.php");
        }

    }

    private function userAuthentication($data){

        $_SESSION['authenticated'] = true;
        $_SESSION['auth_role'] = $data['userType'];
        $_SESSION['auth_user'] = [
            'userId' => $data['userId'],
            'userEmail' => $data['email'],
            'userName' => $data['userName'],
            'fName' => $data['firstName'],
            'lName' => $data['lastName'],
        ];


    }

    //In here we unset session values
    public function logout(){

        if(isset($_SESSION['authenticated']) === TRUE){

            if($_SESSION['auth_role'] == "TEACHER"){
                unset($_SESSION['subject']);
            }

            unset($_SESSION['authenticated']);
            unset($_SESSION['auth_user']);
            unset($_SESSION['auth_role']);
            return true;
        }else{
            return false;
        }

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
