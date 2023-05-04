<?php

use PHPUnit\Framework\TestCase;

require_once 'config/DatabaseConnection.php';
require_once 'model/User.php';

class UserTest extends TestCase {

    private static $connection;

    /**
     * Set up the database connection before running the tests
     *
     * @beforeClass
     */
    public static function initializeDatabase(){
        self::$connection = DatabaseConnection::getInstance()->getConnection();
    }

    public function testLoginValidCredentialsWithUserName() {

        // Valid username
        $username = 'sathsara';
        //valid password
        $password = 'aws@12345';

        $result = User::login(self::$connection, $username, $password);

        $this->assertIsBool($result, 'The login method should return a boolean value.');
        $this->assertTrue($result, 'The login method should return true for valid credentials.');

        // Check that the session contains the expected values after a successful login
        $this->assertArrayHasKey('authenticated', $_SESSION, 'The session should contain the "authenticated" key after a successful login.');
        $this->assertTrue($_SESSION['authenticated'], 'The "authenticated" key in the session should be true after a successful login.');

        $this->assertArrayHasKey('auth_role', $_SESSION, 'The session should contain the "auth_role" key after a successful login.');
        $this->assertEquals('TEACHER',$_SESSION['auth_role'], 'The "auth_role" key in the session should contain the correct role after a successful login.');

        $this->assertArrayHasKey('auth_user', $_SESSION, 'The session should contain the "auth_user" key after a successful login.');
        $this->assertIsArray($_SESSION['auth_user'], 'The "auth_user" key in the session should contain an array after a successful login.');
        $this->assertCount(5, $_SESSION['auth_user'], 'The "auth_user" array in the session should have 5 items after a successful login.');
        $this->assertArrayHasKey('userId', $_SESSION['auth_user'], 'The "auth_user" array in the session should contain the "userId" key after a successful login.');
        $this->assertArrayHasKey('userEmail', $_SESSION['auth_user'], 'The "auth_user" array in the session should contain the "userEmail" key after a successful login.');
        $this->assertArrayHasKey('userName', $_SESSION['auth_user'], 'The "auth_user" array in the session should contain the "userName" key after a successful login.');
        $this->assertArrayHasKey('userFirstName', $_SESSION['auth_user'], 'The "auth_user" array in the session should contain the "userFirstName" key after a successful login.');
        $this->assertArrayHasKey('userLastName', $_SESSION['auth_user'], 'The "auth_user" array in the session should contain the "userLastName" key after a successful login.');

        // Unset all session variables
        //$_SESSION = [];

    }

    public function testLoginValidCredentialsWithEmail() {

        // Valid email
        $email = 'sathsaracharith@gmail.com';
        //valid password
        $password = 'aws@12345';

        $result = User::login(self::$connection, $email, $password);

        $this->assertIsBool($result, 'The login method should return a boolean value.');
        $this->assertTrue($result, 'The login method should return true for valid credentials.');

        // Check that the session contains the expected values after a successful login
        $this->assertArrayHasKey('authenticated', $_SESSION, 'The session should contain the "authenticated" key after a successful login.');
        $this->assertTrue($_SESSION['authenticated'], 'The "authenticated" key in the session should be true after a successful login.');

        $this->assertArrayHasKey('auth_role', $_SESSION, 'The session should contain the "auth_role" key after a successful login.');
        $this->assertEquals('TEACHER',$_SESSION['auth_role'], 'The "auth_role" key in the session should contain the correct role after a successful login.');

        $this->assertArrayHasKey('auth_user', $_SESSION, 'The session should contain the "auth_user" key after a successful login.');
        $this->assertIsArray($_SESSION['auth_user'], 'The "auth_user" key in the session should contain an array after a successful login.');
        $this->assertCount(5, $_SESSION['auth_user'], 'The "auth_user" array in the session should have 5 items after a successful login.');
        $this->assertArrayHasKey('userId', $_SESSION['auth_user'], 'The "auth_user" array in the session should contain the "userId" key after a successful login.');
        $this->assertArrayHasKey('userEmail', $_SESSION['auth_user'], 'The "auth_user" array in the session should contain the "userEmail" key after a successful login.');
        $this->assertArrayHasKey('userName', $_SESSION['auth_user'], 'The "auth_user" array in the session should contain the "userName" key after a successful login.');
        $this->assertArrayHasKey('userFirstName', $_SESSION['auth_user'], 'The "auth_user" array in the session should contain the "userFirstName" key after a successful login.');
        $this->assertArrayHasKey('userLastName', $_SESSION['auth_user'], 'The "auth_user" array in the session should contain the "userLastName" key after a successful login.');

        // Unset all session variables
        //$_SESSION = [];

    }

    public function testLoginInvalidCredentialsWithUserName() {

        // Invalid username
        $username = 'InvalidUserName';
        // Invalid password
        $password = 'InVaLiD@2023';

        $result = User::login(self::$connection, $username, $password);

        $this->assertIsBool($result, 'The login method should return a boolean value.');
        $this->assertFalse($result, 'The login method should return false for invalid username and invalid password.');

        // Check that the session does not contain any authentication information after an unsuccessful login
        $this->assertArrayNotHasKey('authenticated', $_SESSION, 'The session should not contain the "authenticated" key after an unsuccessful login.');
        $this->assertArrayNotHasKey('auth_role', $_SESSION, 'The session should not contain the "auth_role" key after an unsuccessful login.');
        $this->assertArrayNotHasKey('auth_user', $_SESSION, 'The session should not contain the "auth_user" key after an unsuccessful login.');

    }

    /**
     * @after
     */
    public function cleanUp() {
        echo "\tClearing Session Variables...\n";
        // Unset all session variables
        $_SESSION = [];
    }



}


