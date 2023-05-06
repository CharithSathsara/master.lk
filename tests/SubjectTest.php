<?php

use PHPUnit\Framework\TestCase;

require_once 'config/DatabaseConnection.php';
require_once 'model/Subject.php';

class SubjectTest extends TestCase {

    private static $connection;

    /**
     * Set up the database connection before running the tests
     *
     * @beforeClass
     */
    public static function initializeDatabase() {
        self::$connection = DatabaseConnection::getInstance()->getConnection();
    }

    public function testGetSubjectTitleForPhysics() {

        // Retrieve the subject ID for Physics subject
        $physicsSubjectIdQuery = "SELECT subjectId FROM subject WHERE subjectTitle = 'Physics'";
        $physicsSubjectIdResult = self::$connection->query($physicsSubjectIdQuery);
        $physicsSubjectId = $physicsSubjectIdResult->fetch_assoc()['subjectId'];

        // Check if subject ID was successfully retrieved
        $this->assertNotFalse($physicsSubjectIdResult, "Failed to retrieve subject ID for Physics subject.");

        // Retrieve the title for the Physics subject ID
        $physicsSubjectTitle = Subject::getSubjectTitle(self::$connection, $physicsSubjectId);

        // Check if subject title was successfully retrieved
        $this->assertNotFalse($physicsSubjectTitle, "Failed to retrieve Physics subject title.");

        // Check that the subject title is correct
        $this->assertEquals('Physics', $physicsSubjectTitle, "Incorrect subject title retrieved for Physics subject.");
    }

    public function testGetSubjectTitleForChemistry() {

        // Retrieve the subject ID for Chemistry subject
        $chemistrySubjectIdQuery = "SELECT subjectId FROM subject WHERE subjectTitle = 'Chemistry'";
        $chemistrySubjectIdResult = self::$connection->query($chemistrySubjectIdQuery);
        $chemistrySubjectId = $chemistrySubjectIdResult->fetch_assoc()['subjectId'];

        // Check if subject ID was successfully retrieved
        $this->assertNotFalse($chemistrySubjectIdResult, "Failed to retrieve subject ID for Chemistry subject.");

        // Retrieve the title for the Chemistry subject ID
        $chemistrySubjectTitle = Subject::getSubjectTitle(self::$connection, $chemistrySubjectId);

        // Check if subject title was successfully retrieved
        $this->assertNotFalse($chemistrySubjectTitle, "Failed to retrieve Chemistry subject title.");

        // Check that the subject title is correct
        $this->assertEquals('Chemistry', $chemistrySubjectTitle, "Incorrect subject title retrieved for Chemistry subject.");

    }

}
