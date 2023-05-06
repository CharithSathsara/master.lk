<?php

use PHPUnit\Framework\TestCase;

require_once 'config/DatabaseConnection.php';
require_once 'model/ForumQuestion.php';

class ForumQuestionTest extends TestCase
{

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



}
