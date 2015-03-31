<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    $DB = new PDO('pgsql:host=localhost;dbname=pickapp_test');

    require_once "src/Category.php";
    require_once "src/Event.php";

    class CategoryTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Category::deleteAll();
            Event::deleteAll();
        }
        function test_getName()
        {
            //Arrange
            $name = "Work stuff";
            $description = 'Hardcore';
            $id = 1;
            $test_category = new Category($name, $description, $id);
            //Act
            $result = $test_category->getName();
            //Assert
            $this->assertEquals($name, $result);
        }
        function test_setName()
        {
            //Arrange
            $name = 'Hardcore';
            $description = 'stuff';
            $id = 1;
            $test_category = new Category($name, $description, $id);
            //Act
            $test_category->setName('Home chores');
            $result = $test_category->getName();
            //Assert
            $this->assertEquals('Home chores', $result);
        }
        function test_getDescription()
        {
            $name = 'Hardcore';
            $description = 'Nothardcore';
            $id = 1;
            $test_category = new Category($name, $description, $id);
            $result = $test_category->getDescription();
            $this->assertEquals($description, $result);
        }
        function test_setDescription()
        {
            $name = 'Hardcore';
            $description = 'NotHardcore';
            $id = 1;
            $test_category = new Category($name, $description, $id);
            $test_category->setDescription('Hardcore');
            $result = $test_category->getDescription();
            $this->assertEquals('Hardcore', $result);
        }
        function test_getId()
        {
            //Arrange
            $name = "Hardcore";
            $description = 'stuff';
            $id = 1;
            $test_category = new Category($name, $description, $id);
            //Act
            $result = $test_category->getId();
            //Assert
            $this->assertEquals(1, $result);
        }
        function test_setId()
        {
            //Arrange
            $name = "Hardcore";
            $description = 'stuff';
            $id = 1;
            $test_category = new Category($name, $description, $id);
            //Act
            $test_category->setId(2);
            //Assert
            $result = $test_category->getId();
            $this->assertEquals(2, $result);
        }
        function test_save()
        {
            //Arrange
            $name = "Hardcore";
            $description = 'stuff';
            $id = 1;
            $test_category = new Category($name, $description, $id);
            $test_category->save();
            //Act
            $result = Category::getAll();
            //Assert
            $this->assertEquals($test_category, $result[0]);
        }
        function test_find()
        {
            $name = 'Hardcore';
            $description = 'nothardcore';
            $id = 1;
            $test_category = new Category($name, $description, $id);
            $test_category->save();

            $name2 = 'Hardcore';
            $description2 = 'superhardcore';
            $id = 1;
            $test_category = new Category($name, $description, $id);
            $test_category->save();

            $result = Category::find($test_category->getId());

            $this->assertEquals($test_category, $result);
        }
        function test_update()
        {
            $name = 'Hardcore';
            $description = 'Nothardcore';
            $id = 1;
            $test_category = new Category($name, $description, $id);
            $test_category->save();
            $new_name = 'Superhardcore';

            $test_category->updateName($new_name);

            $this->assertEquals(['Superhardcore'], [$test_category->getName()]);
        }
        function test_addEvent()
        {
            $name = 'Hardcore';
            $description = 'Nothardcore';
            $id = 1;
            $test_category = new Category($name, $description, $id);
            $test_category->save();

            $name = "Baseball Game";
            $location = "Overlook Park";
            $event_time = "2015-12-12 14:00:00";
            $reqs = "Bring a glove.";
            $description = "n/a";
            $skill_level = "Beginner";
            $test_event = new Event($name, $location, $event_time, $reqs, $description, $skill_level);
            $test_event->save();

            $test_category->addEvent($test_event);
            $result = $test_category->getEvents();

            $this->assertEquals($test_event, $result[0]);
        }


    }
?>
