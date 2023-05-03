<?php

use PHPUnit\Framework\TestCase;

require_once 'model/Teacher.php';
require_once 'config/DatabaseConnection.php';

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

        // Call the addQuestion method with test data
        $question = 'What is the capital of France?';
        $answer1 = 'Berlin';
        $answer2 = 'Paris';
        $answer3 = 'Rome';
        $answer4 = 'London';
        $answer5 = 'New York';
        $correctAnswer = 2;
        $answerDescription = 'Paris is the capital of France';
        $type = 'PASTQUESTION';
        $subject = 'Physics';
        $topicId = 6;
        $teacherId = 17;

        // Begin a transaction
        //self::$connection->begin_transaction();

        $result = Teacher::addQuestion($question, $answer1, $answer2, $answer3, $answer4, $answer5,
            $correctAnswer, $answerDescription, $type, $subject, $topicId, $teacherId, self::$connection);

        // Verify the expected output
        $this->assertNotEquals(false, $result);

        // Rollback the transaction
        //self::$connection->rollback();

    }

}
