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
        protected function tearDown()
        {
            User::deleteAll();
        }

        function test_getUser()
        {
            //Arrange
            $email = "pittsburghpenguin01@gmail.com";
            $id = 1;
            $password = "test";
            $test_user = new User($email, $password, $id);
            //Act
            $result = $test_user->getEmail();
            //Assert
            $this->assertEquals($email, $result);
        }

        function test_getId()
        {
            //Arrange
            $email = "detroit@gmail.com";
            $id = 1;
            $password = "test";
            $test_user = new User($email, $password, $id);
            //Act
            $result = $test_user->getId();
            //Assert
            $this->assertEquals(1, $result);
        }

        function test_save()
        {
            //Arrange
            $email = "yarbles@gmail.com";
            $id = 1;
            $password = "hello";
            $test_user = new User($email, $password, $id);
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
            $email2 = "ie@gmail.com";
            $id = 1;
            $id2 = 4;
            $password = "test";
            $password2 = "hello";
            $test_user = new User($email, $password, $id);
            $test_user->save();
            $test_user2 = new User($email2, $password2, $id2);
            $test_user2->save();
            //Act
            $result = User::getAll();
            //Assert
            $this->assertEquals([$test_user, $test_user2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $email = "ilikecheese@gmail.com";
            $email2 = "ie@gmail.com";
            $id = 1;
            $id2 = 4;
            $password = "test";
            $password2 = "hello";
            $test_user = new User($email, $password, $id);
            $test_user->save();
            $test_user2 = new User($email2, $password2, $id2);
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
            $email = "ilikecheese@gmail.com";
            $email2 = "ie@gmail.com";
            $id = 1;
            $id2 = 4;
            $password = "test";
            $password2 = "hello";
            $test_user = new User($email, $password, $id);
            $test_user->save();
            $test_user2 = new User($email2, $password2, $id2);
            $test_user2->save();
            //Act
            $result = User::find($test_user->getId());
            //Assert
            $this->assertEquals($test_user, $result);
        }

        function test_deleteUser()
        {
            //Arrange
            $email = "ilikecheese@gmail.com";
            $email2 = "ie@gmail.com";
            $id = 1;
            $id2 = 4;
            $password = "test";
            $password2 = "hello";
            $test_user = new User($email, $password, $id);
            $test_user->save();
            $test_user2 = new User($email2, $password2, $id2);
            $test_user2->save();
            //Act
            $test_user->deleteUser();
            $result = User::getAll();
            //Assert
            $this->assertEquals([$test_user2], $result);
        }








    }

?>
