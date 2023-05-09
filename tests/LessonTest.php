<?php

use PHPUnit\Framework\TestCase;

require_once 'config/DatabaseConnection.php';
require_once 'model/Lesson.php';

class LessonTest extends TestCase {

    private static $connection;

    /**
     * Set up the database connection before running the tests
     *
     * @beforeClass
     */
    public static function initializeDatabase() {
        self::$connection = DatabaseConnection::getInstance()->getConnection();
    }

    public function testGetLessonForPhysics() {

        // Retrieve a lesson ID for Physics subject
        $physicsLessonIdQuery = "SELECT lessonId FROM lesson 
                             WHERE subjectId = (SELECT subjectId FROM subject WHERE subjectTitle = 'Physics') 
                             LIMIT 1";

        $physicsLessonIdResult = self::$connection->query($physicsLessonIdQuery);
        $physicsLessonId = $physicsLessonIdResult->fetch_assoc()['lessonId'];

        // Check if lessons was successfully retrieved
        $this->assertNotFalse($physicsLessonIdResult, "Failed to retrieve lesson ID for Physics subject.");

        // Retrieve the lesson for the Physics lesson ID
        $physicsLesson = Lesson::getLesson(self::$connection, $physicsLessonId);

        // Check if lesson was successfully retrieved
        $this->assertNotFalse($physicsLesson, "Failed to retrieve Physics lesson.");

        // Check that the lesson has all expected properties
        $this->assertArrayHasKey('lessonId', $physicsLesson, "Lesson does not have 'lessonId' property.");
        $this->assertArrayHasKey('subjectId', $physicsLesson, "Lesson does not have 'subjectId' property.");
        $this->assertArrayHasKey('lessonName', $physicsLesson, "Lesson does not have 'lessonName' property.");

        // Check that the lesson's properties are of the expected data types
        $this->assertIsString($physicsLesson['lessonName'], "Lesson name is not of type string.");

        // Check that the lesson's properties are not empty or null
        $this->assertNotEmpty($physicsLesson['lessonId'], "Lesson ID is empty or null.");
        $this->assertNotEmpty($physicsLesson['subjectId'], "Subject ID is empty or null.");
        $this->assertNotEmpty($physicsLesson['lessonName'], "Lesson name is empty or null.");

    }

    public function testGetLessonForChemistry() {

        // Retrieve a lesson ID for Chemistry subject
        $chemistryLessonIdQuery = "SELECT lessonId FROM lesson 
                             WHERE subjectId = (SELECT subjectId FROM subject WHERE subjectTitle = 'Chemistry') 
                             LIMIT 1";

        $chemistryLessonIdResult = self::$connection->query($chemistryLessonIdQuery);
        $chemistryLessonId = $chemistryLessonIdResult->fetch_assoc()['lessonId'];

        // Check if lessons was successfully retrieved
        $this->assertNotFalse($chemistryLessonIdResult, "Failed to retrieve a lesson ID for Chemistry subject.");

        // Retrieve a lesson for the Chemistry lesson ID
        $chemistryLesson = Lesson::getLesson(self::$connection, $chemistryLessonId);

        // Check if lesson was successfully retrieved
        $this->assertNotFalse($chemistryLesson, "Failed to retrieve Chemistry lesson.");

        // Check that the lesson has all expected properties
        $this->assertArrayHasKey('lessonId', $chemistryLesson, "Lesson does not have 'lessonId' property.");
        $this->assertArrayHasKey('subjectId', $chemistryLesson, "Lesson does not have 'subjectId' property.");
        $this->assertArrayHasKey('lessonName', $chemistryLesson, "Lesson does not have 'lessonName' property.");

        // Check that the lesson's properties are of the expected data types
        $this->assertIsString($chemistryLesson['lessonName'], "Lesson name is not of type string.");

        // Check that the lesson's properties are not empty or null
        $this->assertNotEmpty($chemistryLesson['lessonId'], "Lesson ID is empty or null.");
        $this->assertNotEmpty($chemistryLesson['subjectId'], "Subject ID is empty or null.");
        $this->assertNotEmpty($chemistryLesson['lessonName'], "Lesson name is empty or null.");

    }

}
