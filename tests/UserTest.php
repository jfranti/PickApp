<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/User.php";

    require_once "src/Category.php";

    require_once "src/User.php";

    $DB = new PDO('pgsql:host=localhost;dbname=pickapp_test');

    class UserTest extends PHPUnit_Framework_TestCase
    {
        function test_getUser()
        {
            //Arrange
            $email = "pittsburghpenguin01@gmail.com";
            $id = 1;
            $test_user = new User($user, $id);
            //Act
            $result = $test_user->getEmail();
            //Assert
            $this->assertEquals($user, $result);
        }

        function test_getId()
        {
            //Arrange
            $email = "redwings@gmail.com";
            $id = 1;
            $test_user = new User($email, $id);
            //Act
            $result = $test_user->getId();
            //Assert
            $this->assertEquals($id, $result);
        }

        function test_save()
        {
            //Arrange
            $email = "yarbles@gmail.com";
            $id = 1;
            $test_user = new User($email, $id);
            $test_user->save();
            //Act
            $result = User::getAll();
            //Assert
            $this->assertEquals($test_user, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $email = "ilikecheese@gmail.com";
            $id = 1;
            $test_user = new User($user, $id);
            $test_user->save();
            $user2 = "ilikechocolate@gmail.com";
            $id2 = 2;
            $test_user2 = new User ($user2, $id2);
            $test_user2->save();
            //Act
            $result = User::getAll();
            //Assert
            $this->assertEquals([$test_user, $test_user2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $email = "gopackers@gmail.com";
            $id = 1;
            $test_user = new User($user, $id);
            $test_user->save();
            $email2 = "yarbles@gmails.com";
            $id2 = 2;
            $test_user2 = new User($user2, $id2);
            $test_user2->save();
            //Act
            User::deleteAll();
            $result = User::getAll();
            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $email = "ilikecheese@gmails.com";
            $id = 1;
            $test_user = new User($user, $id);
            $test_user->save();
            $email2 = "radiolover@gmail.com";
            $id2 = 2;
            $test_user2 = new User ($user2, $id2);
            $test_user2->save();
            //Act
            $result = User::find($test_user->getId());
            //Assert
            $this->assertEquals($test_user, $result);
        }

        function test_deleteUser()
        {
            //Arrange
            $email = "ballsballsballs@gmail.com";
            $id = null;
            $test_user = new User($user, $id);
            $test_user->save();
            $email2 = "callmemaybe@gmail.com";
            $id2 = null;
            $test_user2 = new User ($user2, $id2);
            $test_user2->save();
            //Act
            $test_user->deleteUser();
            $result = User::getAll();
            //Assert
            $this->assertEquals([$test_user2], $result);
        }








    }

?>
