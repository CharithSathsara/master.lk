<?php

use PHPUnit\Framework\TestCase;

require_once 'config/DatabaseConnection.php';
require_once 'model/ForumQuestion.php';
require_once 'model/ForumAnswer.php';

class ForumQuestionTest extends TestCase {

    private static $connection;

    /**
     * Set up the database connection before running the tests
     *
     * @beforeClass
     */
    public static function initializeDatabase() {
        self::$connection = DatabaseConnection::getInstance()->getConnection();
    }

    public function testInsertForumQuestion() {

        // Start transaction
        self::$connection->begin_transaction();

        // Retrieve a student ID from the database
        $studentIdQuery = "SELECT studentId FROM student LIMIT 1";
        $studentIdResult = self::$connection->query($studentIdQuery);
        $this->assertNotFalse($studentIdResult, "Failed to retrieve student ID from the database");

        // Retrieve a topic ID from the database
        $topicIdQuery = "SELECT topicId FROM topic LIMIT 1";
        $topicIdResult = self::$connection->query($topicIdQuery);
        $this->assertNotFalse($topicIdResult, "Failed to retrieve topic ID from the database");

        // Get the IDs from the results
        $studentId = $studentIdResult->fetch_assoc()['studentId'];
        $topicId = $topicIdResult->fetch_assoc()['topicId'];

        // Insert a new question into the database
        $question_text = "What is the capital of Sri Lanka?";
        $result = ForumQuestion::insertQuestion(self::$connection, $question_text, $studentId, $topicId);
        // Get the question id
        $question_id = self::$connection->insert_id;

        $this->assertTrue($result, "Failed to insert new question into the database");

        // Retrieve the inserted question from the database
        $questionQuery = "SELECT * FROM forum_question WHERE question_id = $question_id";
        $questionResult = self::$connection->query($questionQuery);
        $this->assertNotFalse($questionResult, "Failed to retrieve inserted question from the database");

        // Check that the question was inserted correctly
        $question = $questionResult->fetch_assoc();

        $this->assertNotEmpty($question["question_text"], "Inserted question text is empty");
        $this->assertNotEmpty($question["studentId"], "Inserted student ID is empty");
        $this->assertNotEmpty($question["topicId"], "Inserted topic ID is empty");

        $this->assertEquals($question_text, $question["question_text"], "Inserted question text does not match");
        $this->assertEquals($studentId, $question["studentId"], "Inserted student ID does not match");
        $this->assertEquals($topicId, $question["topicId"], "Inserted topic ID does not match");

        // End transaction
        self::$connection->rollback();

    }

    public function testGetQuestionAnswers() {

        // Start transaction
        self::$connection->begin_transaction();

        // Retrieve a student ID from the database
        $studentIdQuery = "SELECT `studentId` FROM `student` LIMIT 1";
        $studentIdResult = self::$connection->query($studentIdQuery);
        $studentId = $studentIdResult->fetch_assoc()['studentId'];

        // Retrieve a topic ID from the database
        $topicIdQuery = "SELECT `topicId` FROM `topic` LIMIT 1";
        $topicIdResult = self::$connection->query($topicIdQuery);
        $topicId = $topicIdResult->fetch_assoc()['topicId'];

        // Retrieve a teacher ID from the database
        $teacherIdQuery = "SELECT `teacherId` FROM `teacher` LIMIT 1";
        $teacherIdResult = self::$connection->query($teacherIdQuery);
        $teacherId = $teacherIdResult->fetch_assoc()['teacherId'];

        // Insert a new question into the database
        $question_text = "What is the capital of Sri Lanka?";
        $questionResult = ForumQuestion::insertQuestion(self::$connection, $question_text, $studentId, $topicId);
        $this->assertTrue($questionResult, "Failed to insert new question into the database");
        $question_id = self::$connection->insert_id;

        // Insert a new answer into the database
        $answer_text = "The capital of Sri Lanka is Colombo";
        $answerResult = ForumAnswer::insertAnswer(self::$connection, $answer_text, $question_id, $teacherId);

        $this->assertTrue($answerResult, "Failed to insert new answer into the database");

        // Retrieve the question answers from the database
        $questionAnswers = ForumQuestion::getQuestionAnswers(self::$connection, $question_id);

        $this->assertNotFalse($questionAnswers, "Failed to retrieve question answers from the database");

        // Check that the question answers were retrieved correctly
        $answer = $questionAnswers->fetch_assoc();
        $this->assertEquals($answer_text, $answer["answer_text"], "Retrieved answer text does not match");
        $this->assertEquals($question_id, $answer["question_id"], "Retrieved question ID does not match");
        $this->assertEquals($teacherId, $answer["teacherId"], "Retrieved teacher ID does not match");

        // End transaction
        self::$connection->rollback();

    }

    public function testGetTopicDetails() {

        // Start transaction
        self::$connection->begin_transaction();

        // Retrieve a topic ID from the database
        $topicIdQuery = "SELECT `topicId` FROM `topic` LIMIT 1";
        $topicIdResult = self::$connection->query($topicIdQuery);
        $topicId = $topicIdResult->fetch_assoc()['topicId'];

        // Get the details for the topic
        $details = ForumQuestion::getDetails(self::$connection, $topicId);

        // Check that the details were retrieved correctly
        $this->assertNotFalse($details, "Failed to retrieve details from the database");
        $this->assertArrayHasKey("topicTitle", $details, "Retrieved details do not contain topicTitle");
        $this->assertArrayHasKey("lessonName", $details, "Retrieved details do not contain lessonName");
        $this->assertArrayHasKey("subjectTitle", $details, "Retrieved details do not contain subjectTitle");

        $this->assertNotEmpty($details["topicTitle"], "Retrieved topicTitle is empty");
        $this->assertNotEmpty($details["lessonName"], "Retrieved lessonName is empty");
        $this->assertNotEmpty($details["subjectTitle"], "Retrieved subjectTitle is empty");

        // End transaction
        self::$connection->rollback();

    }

}
