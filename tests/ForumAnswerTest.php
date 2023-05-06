<?php

use PHPUnit\Framework\TestCase;

require_once 'config/DatabaseConnection.php';
require_once 'model/ForumAnswer.php';

class ForumAnswerTest extends TestCase {

    private static $connection;

    /**
     * Set up the database connection before running the tests
     *
     * @beforeClass
     */
    public static function initializeDatabase() {
        self::$connection = DatabaseConnection::getInstance()->getConnection();
    }

    public function testInsertForumAnswer() {

        // Start transaction
        self::$connection->begin_transaction();

        // Retrieve a question ID from the database
        $questionIdQuery = "SELECT question_id FROM forum_question LIMIT 1";
        $questionIdResult = self::$connection->query($questionIdQuery);
        $questionId = $questionIdResult->fetch_assoc()['question_id'];

        // Retrieve a teacher ID from the database
        $teacherIdQuery = "SELECT teacherId FROM teacher LIMIT 1";
        $teacherIdResult = self::$connection->query($teacherIdQuery);
        $teacherId = $teacherIdResult->fetch_assoc()['teacherId'];

        // Insert a new answer into the database
        $answerText = "The capital of Sri Lanka is Colombo.";
        $result = ForumAnswer::insertAnswer(self::$connection, $answerText, $questionId, $teacherId);
        // Get the answer id
        $answer_id = self::$connection->insert_id;
        $this->assertTrue($result, "Failed to insert new answer into the database");

        // Retrieve the inserted answer from the database
        $answerQuery = "SELECT * FROM `forum_answer` WHERE `answer_id` = $answer_id";
        $answerResult = self::$connection->query($answerQuery);
        $this->assertNotFalse($answerResult, "Failed to retrieve inserted answer from the database");

        // Check that the answer was inserted correctly
        $answer = $answerResult->fetch_assoc();
        $this->assertEquals($answerText, $answer["answer_text"], "Inserted answer text does not match");
        $this->assertEquals($questionId, $answer["question_id"], "Inserted question ID does not match");
        $this->assertEquals($teacherId, $answer["teacherId"], "Inserted teacher ID does not match");

        // End transaction
        self::$connection->rollback();
    }

}