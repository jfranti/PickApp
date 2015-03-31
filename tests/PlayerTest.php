<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Player.php";

    $DB = new PDO('pgsql:host=localhost;dbname=pickapp_test');

    class PlayerTest extends PHPUnit_Framework_TestCase
    {

        function test_getName()
        {
            //Arrange
            $name = "Tom";
            $id = 1;
            $test_event = new Player($name, $id);
            //Act
            $result = $test_event->getName();
            //Assert
            $this->assertEquals($name, $result);
        }

    }



?>
