<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Player.php";

    $DB = new PDO('pgsql:host=localhost;dbname=pickapp_test');

    class PlayerTest extends PHPUnit_Framework_TestCase
    {

        function test_setName()
        {
            //Arrange
            $name = "Tom";
            $id = 1;
            $test_player = new Player($name, $id);

            //Act
            $test_player->setName("Bob");
            $result = $test_player->getName();

            //Assert
            $this->assertEquals("Bob", $result);
        }

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


        function test_getId()
        {
            //Arrange
            $name = "Bill";
            $id = 3;
            $test_player = new Player($name, $id);
            //Act
            $result = $test_player->getId();
            //Assert
            $this->assertEquals(3, $result);
        }

        function test_setId()
        {
            //Arrange
            $name = "Bill";
            $id = 3;
            $test_player = new Player($name, $id);

            //Act
            $test_player->setId(1);

            //Assert
            $result = $test_player->getId();
            $this->assertEquals(1, $result);
        }

        function test_save()
        {
            //Arrange
            $name = "Bob";
            $id = 1;
            $test_player = new Player($name, $id);
            $test_player->save();
            //Act
            $result = Player::getAll();
            //Assert
            $this->assertEquals($test_player, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Tom";
            $id = 1;
            $name2 = "Bob";
            $id2 = 4;
            $test_player = new Player($name, $id);
            $test_player->save();
            $test_player2 = new Player($name2, $id2);
            $test_player2->save();
            //Act
            $result = Player::getAll();
            //Assert
            $this->assertEquals([$test_player, $test_player2], $result);
        }










    }



?>
