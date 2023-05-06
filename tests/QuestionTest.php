<?php

use PHPUnit\Framework\TestCase;

require_once 'config/DatabaseConnection.php';
require_once 'model/Question.php';

class QuestionTest extends TestCase {

    private static $connection;

    /**
     * Set up the database connection before running the tests
     *
     * @beforeClass
     */
    public static function initializeDatabase() {
        self::$connection = DatabaseConnection::getInstance()->getConnection();
    }

    public function testGetCountOfAllQuestions() {

        // Get count of all questions
        $count = Question::getCountOfAllQuestions(self::$connection);

        // Assert that the count is an integer
        $this->assertIsInt($count, "The count of all questions should be an integer.");

        // Assert that the count is greater than or equal to zero
        $this->assertGreaterThanOrEqual(0, $count, "The count of all questions should be greater than or equal to zero.");

        // Assert that the count is not null or false
        $this->assertNotNull($count, "The count of all questions should not be null.");
        $this->assertNotFalse($count, "The count of all questions should not be false.");
    }

    public function testGetNoOfQuestionsOfPhysics() {

        // Get count of questions for Physics subject
        $physicsCount = Question::getNoOfQuestions(self::$connection, "Physics");

        // Check that the count is not null or false
        $this->assertNotNull($physicsCount, "The count of questions for Physics should not be null.");
        $this->assertNotFalse($physicsCount, "The count of questions for Physics should not be false.");

        // Check that the count is an integer
        $this->assertIsInt($physicsCount, "The count of questions for Physics should be an integer.");

        // Check that the count is greater than zero
        $this->assertGreaterThan(0, $physicsCount, "The count of questions for Physics should be greater than zero.");

    }

    public function testGetNoOfQuestionsOfChemistry() {

        // Get count of questions for Chemistry subject
        $chemistryCount = Question::getNoOfQuestions(self::$connection, "Chemistry");

        // Check that the count is not null or false
        $this->assertNotNull($chemistryCount, "The count of questions for Chemistry should not be null.");
        $this->assertNotFalse($chemistryCount, "The count of questions for Chemistry should not be false.");

        // Check that the count is an integer
        $this->assertIsInt($chemistryCount, "The count of questions for Chemistry should be an integer.");

        // Check that the count is greater than zero
        $this->assertGreaterThan(0, $chemistryCount, "The count of questions for Chemistry should be greater than zero.");

    }

}