<?php

use PHPUnit\Framework\TestCase;

require_once 'config/DatabaseConnection.php';
require_once 'model/Teacher.php';


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

    public function testAddQuestion() {

        // Test data
        $question = "What is the speed of light?";
        $answer1 = "299,792,458 meters per second";
        $answer2 = "186,000 miles per second";
        $answer3 = "300,000 kilometers per second";
        $answer4 = "All of the above";
        $answer5 = "Non of the above";
        $correctAnswer = 4;
        $answerDescription = "The speed of light in a vacuum is approximately 299,792,458 meters per second (or about 186,282 miles per second).";
        $type = 'PASTQUESTION';
        $subject = 'Physics';
        $topicId = 6;
        $teacherId = 17;

        // Begin a transaction
        self::$connection->begin_transaction();

        // Add a question
        $result = Teacher::addQuestion($question, $answer1, $answer2, $answer3, $answer4, $answer5, $correctAnswer, $answerDescription, $type, $subject, $topicId, $teacherId, self::$connection);

        $this->assertTrue($result, 'The addQuestion method should return true for a successful insertion.');

        $last_id = self::$connection->insert_id;

        // Retrieve the inserted question from the database
        $query = "SELECT * FROM `question` WHERE `questionId` = $last_id";
        $data = self::$connection->query($query);
        $row = $data->fetch_assoc();

        // Check the retrieved question
        $this->assertEquals($question, $row['question'], 'The inserted question should match the given question.');
        $this->assertEquals($answer1, $row['opt01'], 'The inserted answer 1 should match the given answer 1.');
        $this->assertEquals($answer2, $row['opt02'], 'The inserted answer 2 should match the given answer 2.');
        $this->assertEquals($answer3, $row['opt03'], 'The inserted answer 3 should match the given answer 3.');
        $this->assertEquals($answer4, $row['opt04'], 'The inserted answer 4 should match the given answer 4.');
        $this->assertEquals($answer5, $row['opt05'], 'The inserted answer 5 should match the given answer 5.');
        $this->assertEquals($correctAnswer, $row['correctAnswer'], 'The inserted correct answer should match the given correct answer.');
        $this->assertEquals($answerDescription, $row['answerDescription'], 'The inserted answer description should match the given answer description.');
        $this->assertEquals($type, $row['questionType'], 'The inserted question type should match the given question type.');
        $this->assertEquals($topicId, $row['topicId'], 'The inserted topic ID should match the given topic ID.');
        $this->assertEquals($teacherId, $row['teacherId'], 'The inserted teacher ID should match the given teacher ID.');

        // Rollback the transaction
        self::$connection->rollback();

    }

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
        $topicId = 6;
        $teacherId = 17;

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

    public function testUpdateQuestion() {

        // Test data
        $question = "What is the capital of Sri Lanka?";
        $answer1 = "Kandy";
        $answer2 = "Galle";
        $answer3 = "Colombo";
        $answer4 = "Jaffna";
        $answer5 = "Matara";
        $correctAnswer = 4;
        $answerDescription = "Colombo is the commercial capital and largest city of Sri Lanka.";
        $type = "MODELQUESTION";
        $subject = "Physics";
        $topicId = 6;
        $teacherId = 17;

        // Begin a transaction
        self::$connection->begin_transaction();

        // Add the question
        $insertResult = Teacher::addQuestion($question, $answer1, $answer2, $answer3, $answer4, $answer5, $correctAnswer, $answerDescription, $type, $subject, $topicId, $teacherId, self::$connection);
        $this->assertTrue($insertResult, "Failed to add the question");

        // Get the question ID from the last insert query
        $questionId = self::$connection->insert_id;

        // Update the question
        $newQuestion = "What is the capital of France?";
        $newAnswer1 = "Paris";
        $newAnswer2 = "Berlin";
        $newAnswer3 = "London";
        $newAnswer4 = "Madrid";
        $newAnswer5 = "Colombo";
        $newCorrectAnswer = 1;
        $newAnswerDescription = "Paris is the capital and largest city of France.";

        $updateResult = Teacher::updateQuestion(self::$connection, $questionId, $newQuestion, $newAnswer1, $newAnswer2, $newAnswer3, $newAnswer4, $newAnswer5, $newCorrectAnswer, $newAnswerDescription);
        $this->assertTrue($updateResult, "Failed to update the question");

        // Fetch the updated question from the database
        $query = "SELECT * FROM question WHERE questionId = $questionId";
        $result = self::$connection->query($query);
        $this->assertTrue($result->num_rows > 0, "Failed to fetch the updated question");

        $updateRow = $result->fetch_assoc();

        // Assert that the updated question data matches the expected values
        $this->assertEquals($newQuestion, $updateRow['question'], "Update question text doesn't match");
        $this->assertEquals($newAnswer1, $updateRow['opt01'], "Update answer 1 doesn't match");
        $this->assertEquals($newAnswer2, $updateRow['opt02'], "Update answer 2 doesn't match");
        $this->assertEquals($newAnswer3, $updateRow['opt03'], "Update answer 3 doesn't match");
        $this->assertEquals($newAnswer4, $updateRow['opt04'], "Update answer 4 doesn't match");
        $this->assertEquals($newAnswer5, $updateRow['opt05'], "Update answer 5 doesn't match");
        $this->assertEquals($newCorrectAnswer, $updateRow['correctAnswer'], "Update correct answer doesn't match");
        $this->assertEquals($newAnswerDescription, $updateRow['answerDescription'], "Update answer description doesn't match");

        // Rollback the transaction
        self::$connection->rollback();

    }








}
