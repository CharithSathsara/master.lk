<?php

use PHPUnit\Framework\TestCase;

require_once 'config/DatabaseConnection.php';
require_once 'model/Topic.php';


class TopicTest extends TestCase {

    private static $connection;

    /**
     * Set up the database connection before running the tests
     *
     * @beforeClass
     */
    public static function initializeDatabase() {
        self::$connection = DatabaseConnection::getInstance()->getConnection();
    }

    public function testGetAllTopics() {

        // Retrieve all topics for "Physics" subject
        $physicsTopics = Topic::getAllTopics(self::$connection, 'Physics');

        // Check if topics were successfully retrieved
        $this->assertNotFalse($physicsTopics, "Failed to retrieve topics for Physics subject.");

        // Check that the correct number of topics were retrieved for Physics subject
        $this->assertGreaterThan(0, $physicsTopics->num_rows, "No topics retrieved for Physics subject.");

        // Check that each row contains topicId and topicTitle
        while ($row = $physicsTopics->fetch_assoc()) {
            $this->assertArrayHasKey('topicId', $row, "topicId not found in row.");
            $this->assertArrayHasKey('topicTitle', $row, "topicTitle not found in row.");
        }

        // Retrieve all topics for "Chemistry" subject
        $chemistryTopics = Topic::getAllTopics(self::$connection, 'Chemistry');

        // Check if topics were successfully retrieved
        $this->assertNotFalse($chemistryTopics, "Failed to retrieve topics for Chemistry subject.");

        // Check that the correct number of topics were retrieved for Chemistry subject
        $this->assertGreaterThan(0, $chemistryTopics->num_rows, "No topics retrieved for Chemistry subject.");

        // Check that each row contains topicId and topicTitle
        while ($row = $chemistryTopics->fetch_assoc()) {
            $this->assertArrayHasKey('topicId', $row, "topicId not found in row.");
            $this->assertArrayHasKey('topicTitle', $row, "topicTitle not found in row.");
        }

    }

}