<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Event.php";

    $DB = new PDO('pgsql:host=localhost;dbname=pickapp_test');

    class EventTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Event::deleteAll();
        }

        function test_setId()
        {
            //Arrange
            $name = "Baseball Game";
            $location = "Overlook Park";
            $event_time = "2015/12/12 14:00:00";
            $reqs = "Bring a glove.";
            $description = "n/a";
            $skill_level = "Beginner";
            $id = 1;
            $test_event = new Event($name, $location, $event_time, $reqs, $description, $skill_level, $id);
            //Act
            $result = $test_event->getId();
            //Assert
            $this->assertEquals($id, $result);
        }

        function test_getName()
        {
            //Arrange
            $name = "Baseball Game";
            $location = "Overlook Park";
            $event_time = "2015/12/12 14:00:00";
            $reqs = "Bring a glove.";
            $description = "n/a";
            $skill_level = "Beginner";
            $id = 1;
            $test_event = new Event($name, $location, $event_time, $reqs, $description, $skill_level, $id);
            //Act
            $result = $test_event->getName();
            //Assert
            $this->assertEquals($name, $result);

        }

        function test_getLocation()
        {
            //Arrange
            $name = "Baseball Game";
            $location = "Overlook Park";
            $event_time = "2015/12/12 14:00:00";
            $reqs = "Bring a glove.";
            $description = "n/a";
            $skill_level = "Beginner";
            $id = 1;
            $test_event = new Event($name, $location, $event_time, $reqs, $description, $skill_level, $id);
            //Act
            $result = $test_event->getLocation();
            var_dump($result);
            //Assert
            $this->assertEquals($location, $result);

        }


    }



?>
