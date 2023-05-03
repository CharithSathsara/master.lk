<?php

use PHPUnit\Framework\TestCase;

class GreetingTest extends TestCase {

    public static function getGreeting($name) {
        return "Hello, " . $name . "!";
    }

    public function testGetGreeting(){

        $this->assertEquals('Hello, John!', GreetingTest::getGreeting('John'));
        $this->assertEquals('Hello, Jane!', GreetingTest::getGreeting('Jane'));
    }


}
