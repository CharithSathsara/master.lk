<?php

use PHPUnit\Framework\TestCase;

require_once 'config/DatabaseConnection.php';
require_once 'model/Teacher.php';
require_once 'model/Student.php';

class TeacherTest extends TestCase {

    private static $connection;

    /**
     * Set up the database connection before running the tests
     *
     * @beforeClass
     */
    public static function initializeDatabase(){
        self::$connection = DatabaseConnection::getInstance()->getConnection();
    }

//    public function testAddQuestion() {
//
//        // Test data
//        $question = "What is the speed of light?";
//        $answer1 = "299,792,458 meters per second";
//        $answer2 = "186,000 miles per second";
//        $answer3 = "300,000 kilometers per second";
//        $answer4 = "All of the above";
//        $answer5 = "Non of the above";
//        $correctAnswer = 4;
//        $answerDescription = "The speed of light in a vacuum is approximately 299,792,458 meters per second (or about 186,282 miles per second).";
//        $type = 'PASTQUESTION';
//        $subject = 'Physics';
//        $topicId = 1;
//        $teacherId = 35;
//
//        // Begin a transaction
//        self::$connection->begin_transaction();
//
//        // Add a question
//        $result = Teacher::addQuestion($question, $answer1, $answer2, $answer3, $answer4, $answer5, $correctAnswer, $answerDescription, $type, $subject, $topicId, $teacherId, self::$connection);
//
//        $this->assertTrue($result, 'The addQuestion method should return true for a successful insertion.');
//
//        $last_id = self::$connection->insert_id;
//
//        // Retrieve the inserted question from the database
//        $query = "SELECT * FROM `question` WHERE `questionId` = $last_id";
//        $data = self::$connection->query($query);
//        $row = $data->fetch_assoc();
//
//        // Check the retrieved question
//        $this->assertEquals($question, $row['question'], 'The inserted question should match the given question.');
//        $this->assertEquals($answer1, $row['opt01'], 'The inserted answer 1 should match the given answer 1.');
//        $this->assertEquals($answer2, $row['opt02'], 'The inserted answer 2 should match the given answer 2.');
//        $this->assertEquals($answer3, $row['opt03'], 'The inserted answer 3 should match the given answer 3.');
//        $this->assertEquals($answer4, $row['opt04'], 'The inserted answer 4 should match the given answer 4.');
//        $this->assertEquals($answer5, $row['opt05'], 'The inserted answer 5 should match the given answer 5.');
//        $this->assertEquals($correctAnswer, $row['correctAnswer'], 'The inserted correct answer should match the given correct answer.');
//        $this->assertEquals($answerDescription, $row['answerDescription'], 'The inserted answer description should match the given answer description.');
//        $this->assertEquals($type, $row['questionType'], 'The inserted question type should match the given question type.');
//        $this->assertEquals($topicId, $row['topicId'], 'The inserted topic ID should match the given topic ID.');
//        $this->assertEquals($teacherId, $row['teacherId'], 'The inserted teacher ID should match the given teacher ID.');
//
//        // Rollback the transaction
//        self::$connection->rollback();
//
//    }

    public function testDeleteQuestion() {

        // Test data
        $question = "What is the capital of Sri Lanka?";
        $answer1 = "Kandy";
        $answer2 = "Galle";
        $answer3 = "Colombo";
        $answer4 = "Jaffna";
        $answer5 = "Matara";
        $correctAnswer = 3;
        $answerDescription = "Colombo is the commercial capital and largest city of Sri Lanka.";
        $type = "MODELQUESTION";
        $subject = "Physics";
        $topicId = 1;
        $teacherId = 35;

        // Add the question
        $insertResult = Teacher::addQuestion($question, $answer1, $answer2, $answer3, $answer4, $answer5, $correctAnswer, $answerDescription, $type, $subject, $topicId, $teacherId, self::$connection);
        $this->assertTrue($insertResult, "Failed to add question");

        // Get the question ID from the last insert query
        $questionId = self::$connection->insert_id;

        // Delete the question
        $deleteResult= Teacher::deleteQuestion(self::$connection, $questionId);
        $this->assertTrue($deleteResult, "Failed to delete question");

        // Check that the question was actually deleted from the database
        $query = "SELECT * FROM question WHERE questionId = $questionId";
        $result = self::$connection->query($query);
        $this->assertEquals(0, $result->num_rows, "Question still exists in the database");

    }

//    public function testUpdateQuestion() {
//
//        // Test data
//        $question = "What is the capital of Sri Lanka?";
//        $answer1 = "Kandy";
//        $answer2 = "Galle";
//        $answer3 = "Colombo";
//        $answer4 = "Jaffna";
//        $answer5 = "Matara";
//        $correctAnswer = 4;
//        $answerDescription = "Colombo is the commercial capital and largest city of Sri Lanka.";
//        $type = "MODELQUESTION";
//        $subject = "Physics";
//        $topicId = 1;
//        $teacherId = 35;
//
//        // Begin a transaction
//        self::$connection->begin_transaction();
//
//        // Add the question
//        $insertResult = Teacher::addQuestion($question, $answer1, $answer2, $answer3, $answer4, $answer5, $correctAnswer, $answerDescription, $type, $subject, $topicId, $teacherId, self::$connection);
//        $this->assertTrue($insertResult, "Failed to add the question");
//
//        // Get the question ID from the last insert query
//        $questionId = self::$connection->insert_id;
//
//        // Update the question
//        $newQuestion = "What is the capital of France?";
//        $newAnswer1 = "Paris";
//        $newAnswer2 = "Berlin";
//        $newAnswer3 = "London";
//        $newAnswer4 = "Madrid";
//        $newAnswer5 = "Colombo";
//        $newCorrectAnswer = 1;
//        $newAnswerDescription = "Paris is the capital and largest city of France.";
//
//        $updateResult = Teacher::updateQuestion(self::$connection, $questionId, $newQuestion, $newAnswer1, $newAnswer2, $newAnswer3, $newAnswer4, $newAnswer5, $newCorrectAnswer, $newAnswerDescription);
//        $this->assertTrue($updateResult, "Failed to update the question");
//
//        // Fetch the updated question from the database
//        $query = "SELECT * FROM question WHERE questionId = $questionId";
//        $result = self::$connection->query($query);
//        $this->assertTrue($result->num_rows > 0, "Failed to fetch the updated question");
//
//        $updateRow = $result->fetch_assoc();
//
//        // Assert that the updated question data matches the expected values
//        $this->assertEquals($newQuestion, $updateRow['question'], "Update question text doesn't match");
//        $this->assertEquals($newAnswer1, $updateRow['opt01'], "Update answer 1 doesn't match");
//        $this->assertEquals($newAnswer2, $updateRow['opt02'], "Update answer 2 doesn't match");
//        $this->assertEquals($newAnswer3, $updateRow['opt03'], "Update answer 3 doesn't match");
//        $this->assertEquals($newAnswer4, $updateRow['opt04'], "Update answer 4 doesn't match");
//        $this->assertEquals($newAnswer5, $updateRow['opt05'], "Update answer 5 doesn't match");
//        $this->assertEquals($newCorrectAnswer, $updateRow['correctAnswer'], "Update correct answer doesn't match");
//        $this->assertEquals($newAnswerDescription, $updateRow['answerDescription'], "Update answer description doesn't match");
//
//        // Rollback the transaction
//        self::$connection->rollback();
//
//    }

    public function testViewQuestions() {

        // Test data
        $subject = "Physics";
        $topic = "Work, Energy and Power";
        $type = "PASTQUESTION";

        // Retrieve questions
        $result = Teacher::viewQuestions(self::$connection, $subject, $topic, $type);

        // Check that the result is not false
        $this->assertNotFalse($result, "Error: Unable to view questions");
        // Check that the result is not empty
        $this->assertNotEmpty($result, "No questions found");
        // Check that the number of rows in the result is greater than 0
        $this->assertGreaterThan(0, $result->num_rows, "No questions found for the specified criteria");

    }

    public function testGetAllStudentsWithSearchParameter() {

        $search = "Charith";

        // Call the function with search parameter
        $result = Teacher::getAllStudents(self::$connection, $search);

        // Check that result is not false
        $this->assertNotFalse($result, "Failed to retrieve students from database with search parameter.");

        // Check that each row returned has the expected columns
        while ($row = $result->fetch_assoc()) {
            $this->assertArrayHasKey('userId', $row);
            $this->assertArrayHasKey('firstName', $row);
            $this->assertArrayHasKey('lastName', $row);
            $this->assertArrayHasKey('email', $row);
            $this->assertArrayHasKey('password', $row);
            $this->assertArrayHasKey('userType', $row);
        }

    }

    public function testGetAllStudentsWithoutSearchParameter() {

        // Call the function without search parameter
        $result = Teacher::getAllStudents(self::$connection, "");

        // Check that result is not false
        $this->assertNotFalse($result, "Failed to retrieve students from database without search parameter.");

        // Check that the number of rows returned is greater than zero
        $this->assertGreaterThan(0, $result->num_rows, "No students found in database without search parameter.");

        // Check that each row returned has the expected columns
        while ($row = $result->fetch_assoc()) {
            $this->assertArrayHasKey('userId', $row);
            $this->assertArrayHasKey('firstName', $row);
            $this->assertArrayHasKey('lastName', $row);
            $this->assertArrayHasKey('email', $row);
            $this->assertArrayHasKey('password', $row);
            $this->assertArrayHasKey('userType', $row);
        }

    }

    public function testGetStudentSubjects() {

        // Start transaction
        self::$connection->begin_transaction();

        // Sample data
        $first_name = "Sathsara";
        $last_name = "Pathirana";
        $dob = "1999-06-01";
        $address_first = "123 Main St";
        $address_second = "Matara";
        $telephone = "0753428877";
        $email = "johndoe@example.com";
        $username = "chasath12345";
        $password = "password1234";

        $result = Student::register(self::$connection, $first_name, $last_name, $dob, $address_first, $address_second, $telephone, $email, $username, $password);
        // Get the student id
        $student_id = self::$connection->insert_id;

        // Check if registration was successful
        $this->assertNotFalse($result, "Failed to register student.");

        // Add two subjects to the subject table with known ids
        $query = "INSERT INTO subject (subjectId, subjectTitle, price) VALUES (100, 'ICT', 5000), (200, 'Combined Maths', 7500);";
        self::$connection->query($query);

        // Add the student and subjects to the student_subject table
        $start_date = "2023-05-01";
        $query2 = "INSERT INTO student_subject (studentId, subjectId, startDate) VALUES ($student_id, 100, '$start_date'), ($student_id, 200, '$start_date')";
        self::$connection->query($query2);

        // Get the student's subjects
        $subjectResult = Teacher::getStudentSubjects(self::$connection, $student_id);

        // Assert that result is not false
        $this->assertNotFalse($subjectResult, "Failed to retrieve student's subjects from database.");

        // Assert that the number of rows returned is greater than zero
        $this->assertGreaterThan(0, $subjectResult->num_rows, "No subjects found for student in database.");

        // Assert that each row returned has the expected columns
        while ($row = $subjectResult->fetch_assoc()) {
            $this->assertArrayHasKey('studentId', $row);
            $this->assertEquals($student_id, $row['studentId'], "Invalid student id found in database.");
            $this->assertArrayHasKey('subjectId', $row);
            $this->assertGreaterThan(0, $row['subjectId'], "Invalid subject id found in database.");
            $this->assertArrayHasKey('startDate', $row);
            $this->assertEquals($start_date, $row['startDate'], "Unexpected start date found in database.");
        }

        // Rollback transaction
        self::$connection->rollback();

    }

    public function testGetAllFeedbacksWithoutFilters() {

        // Get all feedbacks without filters
        $feedbackResult = Teacher::getAllFeedbacks(self::$connection, '', '');

        // Check that result is not false
        $this->assertNotFalse($feedbackResult, "Failed to retrieve feedbacks from database.");

        // Check that each row returned has the expected columns
        while ($row = $feedbackResult->fetch_assoc()) {
            $this->assertArrayHasKey('feedbackId', $row);
            $this->assertArrayHasKey('feedback', $row);
            $this->assertArrayHasKey('studentId', $row);
            $this->assertArrayHasKey('lessonId', $row);
            $this->assertArrayHasKey('timestamp', $row);
        }

    }

    public function testGetAllFeedbacksWithSubjectFilter() {

        // Get subject ID of "Physics" from the database
        $subjectIdResult = self::$connection->query("SELECT subjectId FROM subject WHERE subjectTitle = 'Physics'");
        $subjectIdRow = $subjectIdResult->fetch_assoc();
        $subjectId = $subjectIdRow['subjectId'];

        // Get all feedbacks for the "Physics" subject
        $feedbackResult = Teacher::getAllFeedbacks(self::$connection, '', $subjectId);
        // Check that result is not false
        $this->assertNotFalse($feedbackResult, "Failed to retrieve feedbacks from database for Physics subject.");

        // Check that each row returned has the expected columns
        while ($row = $feedbackResult->fetch_assoc()) {
            $this->assertArrayHasKey('feedbackId', $row);
            $this->assertArrayHasKey('feedback', $row);
            $this->assertArrayHasKey('studentId', $row);
            $this->assertArrayHasKey('lessonId', $row);
            $this->assertArrayHasKey('timestamp', $row);
        }

    }

    public function testGetAllFeedbacksWithLessonFilter() {

        // Get lesson ID of "Mechanics" from the database
        $lessonIdResult = self::$connection->query("SELECT lessonId FROM lesson WHERE lessonname = 'Mechanics'");
        $lessonIdRow = $lessonIdResult->fetch_assoc();
        $lessonId = $lessonIdRow['lessonId'];

        // Get all feedbacks for the "Physics" subject
        $feedbackResult = Teacher::getAllFeedbacks(self::$connection, $lessonId, '');
        // Check that result is not false
        $this->assertNotFalse($feedbackResult, "Failed to retrieve feedbacks from database for Mechanics lesson.");

        // Check that each row returned has the expected columns
        while ($row = $feedbackResult->fetch_assoc()) {
            $this->assertArrayHasKey('feedbackId', $row);
            $this->assertArrayHasKey('feedback', $row);
            $this->assertArrayHasKey('studentId', $row);
            $this->assertArrayHasKey('lessonId', $row);
            $this->assertArrayHasKey('timestamp', $row);
        }

    }

    public function testGetAllFeedbacksWithBothFilters() {

        // Get subject ID of "Physics" from the database
        $subjectIdResult = self::$connection->query("SELECT subjectId FROM subject WHERE subjectTitle = 'Physics'");
        $subjectIdRow = $subjectIdResult->fetch_assoc();
        $subjectId = $subjectIdRow['subjectId'];

        // Get lesson ID of "Mechanics" from the database
        $lessonIdResult = self::$connection->query("SELECT lessonId FROM lesson WHERE lessonname = 'Mechanics'");
        $lessonIdRow = $lessonIdResult->fetch_assoc();
        $lessonId = $lessonIdRow['lessonId'];

        // Get all feedbacks for the "Physics" subject
        $feedbackResult = Teacher::getAllFeedbacks(self::$connection, $lessonId, $subjectId);
        // Check that result is not false
        $this->assertNotFalse($feedbackResult, "Failed to retrieve feedbacks from database for Physics subject Mechanics lesson.");

        // Check that each row returned has the expected columns
        while ($row = $feedbackResult->fetch_assoc()) {
            $this->assertArrayHasKey('feedbackId', $row);
            $this->assertArrayHasKey('feedback', $row);
            $this->assertArrayHasKey('studentId', $row);
            $this->assertArrayHasKey('lessonId', $row);
            $this->assertArrayHasKey('timestamp', $row);
        }

    }

    public function testGetAllSubjects() {

        // Get all subjects
        $subjectResult = Teacher::getAllSubjects(self::$connection);

        // Check that result is not false
        $this->assertNotFalse($subjectResult, "Failed to retrieve subjects from database.");

        // Check that the number of rows returned is greater than zero
        $this->assertGreaterThan(0, $subjectResult->num_rows, "No subjects found in database.");

        // Check that each row returned has the expected columns
        while ($row = $subjectResult->fetch_assoc()) {
            $this->assertArrayHasKey('subjectId', $row);
            $this->assertArrayHasKey('subjectTitle', $row);
            $this->assertArrayHasKey('price', $row);
        }
    }

    public function testGetAllLessons() {

        // Retrieve all lessons related to "Physics"
        $physics_lessons = Teacher::getAllLessons(self::$connection, "Physics");

        // Check that the result is not false
        $this->assertNotFalse($physics_lessons, "Failed to retrieve lessons related to Physics.");

        // Check that the number of rows returned is greater than zero
        $this->assertGreaterThan(0, $physics_lessons->num_rows, "No lessons found for Physics subject in database.");

        // Check that each row returned has the expected columns
        while ($row = $physics_lessons->fetch_assoc()) {
            $this->assertArrayHasKey('lessonId', $row);
            $this->assertArrayHasKey('lessonName', $row);
            $this->assertArrayHasKey('subjectId', $row);
        }

        // Retrieve all lessons related to "Chemistry"
        $chemistry_lessons = Teacher::getAllLessons(self::$connection, "Chemistry");

        // Check that the result is not false
        $this->assertNotFalse($chemistry_lessons, "Failed to retrieve lessons related to Chemistry.");

        // Check that the number of rows returned is greater than zero
        $this->assertGreaterThan(0, $chemistry_lessons->num_rows, "No lessons found for Chemistry subject in database.");

        // Check that each row returned has the expected columns
        while ($row = $physics_lessons->fetch_assoc()) {
            $this->assertArrayHasKey('lessonId', $row);
            $this->assertArrayHasKey('lessonName', $row);
            $this->assertArrayHasKey('subjectId', $row);
        }

    }

}
