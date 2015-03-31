<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    $DB = new PDO('pgsql:host=localhost;dbname=pickapp_test');
    class Category
    {
        private $name;
        private $description;
        private $id;
        function __construct($name, $description, $id = null)
        {
            $this->name = $name;
            $this->description = $description;
            $this->id = $id;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }
        function setDescription($new_description)
        {
            $this->description = $new_description;
        }
        function setId($new_id)
        {
            $this->id = $new_id;
        }
        function getName()
        {
            return $this->name;
        }
        function getDescription()
        {
            return $this->description;
        }
        function getId()
        {
            return $this->id;
        }
        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO categories (name, description) VALUES ('{$this->getName()}', '{$this->getDescription()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }
        static function getAll()
        {
            $all_categories = $GLOBALS['DB']->query("SELECT * FROM categories");
            $returned_categories = array();
            foreach($all_categories as $category){
                $name = $category['name'];
                $description = $category['description'];
                $id = $category['id'];
                $new_category = new Category($name, $description, $id);
                array_push($returned_categories, $new_category);
            }
            return $returned_categories;
        }
        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM categories *;");
        }
        static function find($search_id)
        {
          $found_category = null;
          $categories = Category::getAll();
          foreach($categories as $category){
            $category_id = $category->getId();
            if($category_id == $search_id){
              $found_category = $category;
            }

          }
          return $found_category;
        }
        function updateName($new_name)
        {
          $GLOBALS['DB']->exec("UPDATE categories SET name = '{$new_name}' WHERE id = {$this->getId()};");
          $this->setName($new_name);
        }
        function updateDescription($new_description)
        {
          $GLOBALS['DB']->exec("UPDATE categories SET description = '{$new_description}' WHERE id = {$this->getId()};");
          $this->setDescription($new_description);
        }
        function delete()
        {
          $GLOBALS['DB']->exec("DELETE FROM categories WHERE id = {$this->getId()};");
          $GLOBALS['DB']->exec("DELETE FROM categories_events WHERE category_id = {$this->getId()};");
        }
        function addEvent($event)
        {
          $GLOBALS['DB']->exec("INSERT INTO categories_events (category_id, event_id) VALUES ({$this->getId()}, {$event->getId()});");
        }
        function getEvents()
        {
          $query = $GLOBALS['DB']->query("SELECT events.* FROM categories  JOIN categories_events ON (categories.id = categories_events.category_id) JOIN events ON (categories_events.event_id = events.id) WHERE categories.id = {$this->getId()};");
          $returned_events = $query->fetchAll(PDO::FETCH_ASSOC);

          $events = array();
          foreach($returned_events as $event) {
            $id = $event['id'];
            $name = $event['name'];
            $location = $event['location'];
            $event_time = $event['event_time'];
            $reqs = $event['reqs'];
            $description = $event['description'];
            $skill_level = $event['skill_level'];
            $new_event = new Event($name, $location, $event_time, $reqs, $description, $skill_level, $id);
            array_push($events, $new_event);
          }
          return $events;
        }

    }
?>
