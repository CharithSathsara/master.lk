<?php

use PHPUnit\Framework\TestCase;

require_once 'config/DatabaseConnection.php';
require_once 'model/Student.php';

class StudentTest extends TestCase {

    private static $connection;

    /**
     * Set up the database connection before running the tests
     *
     * @beforeClass
     */
    public static function initializeDatabase(){
        self::$connection = DatabaseConnection::getInstance()->getConnection();
    }

    public function testRegisterStudent() {

        // Start transaction
        self::$connection->begin_transaction();

        // Test data
        $first_name = "Sathsara";
        $last_name = "Pathirana";
        $dob = "1999-06-01";
        $address_first = "123 Main St";
        $address_second = "Matara";
        $telephone = "0753428877";
        $email = "chasath1234@gmail.com";
        $username = "chasath1234";
        $password = password_hash("password1234", PASSWORD_DEFAULT);

        $result = Student::register(self::$connection, $first_name, $last_name, $dob, $address_first, $address_second, $telephone, $email, $username, $password);

        // Check that result is not false
        $this->assertNotFalse($result, "Failed to register student.");

        // Check that the registered student exists in the database
        $query = "SELECT * FROM user JOIN student ON user.userId = student.studentId WHERE userName = '$username'";
        $data = self::$connection->query($query);
        $this->assertNotFalse($data, "Failed to retrieve student data from database.");

        // Check that the correct data was inserted into the database
        $row = $data->fetch_assoc();
        $this->assertEquals("chasath1234", $row['userName'], "Incorrect username retrieved from database.");
        $this->assertEquals("Sathsara", $row['firstName'], "Incorrect first name retrieved from database.");
        $this->assertEquals("Pathirana", $row['lastName'], "Incorrect last name retrieved from database.");
        $this->assertEquals("1999-06-01", $row['dob'], "Incorrect date of birth retrieved from database.");
        $this->assertEquals("123 Main St", $row['addLine01'], "Incorrect address line 1 retrieved from database.");
        $this->assertEquals("Matara", $row['addLine02'], "Incorrect address line 2 retrieved from database.");
        $this->assertEquals("0753428877", $row['mobile'], "Incorrect mobile number retrieved from database.");
        $this->assertEquals("chasath1234@gmail.com", $row['email'], "Incorrect email retrieved from database.");
        $this->assertEquals("STUDENT", $row['userType'], "Incorrect user type retrieved from database.");

        // Check that the student has a valid student ID
        $this->assertNotNull($row['studentId'], "Student ID is null.");
        // Check that the student's date of birth is a valid date
        $this->assertNotFalse(strtotime($row['dob']), "Invalid date of birth.");
        // Check that the student's password is hashed
        $this->assertTrue(password_verify("password1234", $row['password']), "Password is not hashed.");

        // End transaction
        self::$connection->rollback();

    }

    public function testRegisterStudentWithEmptyUsername() {

        // Start transaction
        self::$connection->begin_transaction();

        $result = Student::register(self::$connection, "Sathsara", "Pathirana", "1999-06-01", "123 Main St", "Matara", "0753428877", "chasath1234@gmail.com", "", password_hash("password1234", PASSWORD_DEFAULT));

        // Check that result is false
        $this->assertFalse($result, "Registered student with empty username.");

        // End transaction
        self::$connection->rollback();

    }

    public function testRegisterStudentWithEmptyPassword() {

        // Start transaction
        self::$connection->begin_transaction();

        $result = Student::register(self::$connection, "Sathsara", "Pathirana", "1999-06-01", "123 Main St", "Matara", "0753428877", "chasath1234@gmail.com", "chasath1234", "");

        // Check that result is false
        $this->assertFalse($result, "Registered student with empty password.");

        // End transaction
        self::$connection->rollback();
    }

    public function testRegisterStudentWithEmptyEmail() {

        // Start transaction
        self::$connection->begin_transaction();

        $result = Student::register(self::$connection, "Sathsara", "Pathirana", "1999-06-01", "123 Main St", "Matara", "0753428877", "", "chasath1234", password_hash("password1234", PASSWORD_DEFAULT));

        // Check that result is false
        $this->assertFalse($result, "Registered student with empty email.");

        // End transaction
        self::$connection->rollback();

    }

    public function testGetStudentName() {

        // Start transaction
        self::$connection->begin_transaction();

        // Test data
        $first_name = "Sathsara";
        $last_name = "Pathirana";
        $dob = "1999-06-01";
        $address_first = "123 Main St";
        $address_second = "Matara";
        $telephone = "0753428877";
        $email = "chasath3453@gmail.com";
        $username = "chasath1234";
        $password = "password1234";

        // Register a new student
        $result = Student::register(self::$connection, $first_name, $last_name, $dob, $address_first, $address_second, $telephone, $email, $username, $password);
        // Get the student id
        $student_id = self::$connection->insert_id;

        // Check if registration was successful
        $this->assertNotFalse($result, "Failed to register student.");

        // Get the student's name using the student id
        $student_name = Student::getStudentName(self::$connection, $student_id);

        // Check that the student name is not false
        $this->assertNotFalse($student_name, "Failed to retrieve student's name from database.");

        // Check that the student name is not empty
        $this->assertNotEmpty($student_name, "Student name should not be empty.");
        // Check that the student name is a string
        $this->assertIsString($student_name, "Student name should be a string.");
        // Check that the student name is the expected value
        $this->assertEquals($first_name . ' ' . $last_name, $student_name, "Unexpected student name found in database.");

        // Rollback transaction
        self::$connection->rollback();

    }

    public function testSlipUpload() {

        // Start transaction
        self::$connection->begin_transaction();

        $image = __DIR__ . '/../public/img/paymentSlip.jpg';
        $slipContent = addslashes(file_get_contents($image));

        // Register a new student
        $result = Student::register(self::$connection, 'Charith', 'Sathsara', '2000-01-01', '123 Main St', 'Matara', '0784352377', 'sathcha@gmail.com', 'chaaa1234', password_hash('password1234', PASSWORD_DEFAULT));

        // Get the student id
        $student_id = self::$connection->insert_id;

        // Check if registration was successful
        $this->assertNotFalse($result, "Failed to register student.");

        // Upload slip content for the student
        $upload_result = Student::slipUpload(self::$connection, $slipContent, $student_id);
        // Get the slip id
        $slip_id = self::$connection->insert_id;

        // Check that the upload was successful
        $this->assertTrue($upload_result, "Failed to upload slip content for student.");

        // Verify that the slip payment record has been inserted
        $query = "SELECT * FROM slip_payment WHERE slipId = $slip_id";
        $result = self::$connection->query($query);

        $this->assertNotFalse($result, "Failed to retrieve slip payment record.");
        $this->assertEquals(1, $result->num_rows, "Incorrect number of slip payment records retrieved.");

        $row = $result->fetch_assoc();
        $this->assertEquals(0, $row['isVerified'], "Incorrect value for isVerified field in slip payment record.");

        // Rollback transaction
        self::$connection->rollback();

    }

}
