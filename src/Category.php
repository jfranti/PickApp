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
        function update($new_name, $new_description)
        {
          $GLOBALS['DB']->exec("UPDATE categories SET name = '{$new_name}' WHERE id = {$this->getId()};");
          $GLOBALS['DB']->exec("UPDATE categories SET description = '{$new_description}' WHERE id = {$this->getId()};");
          $this->setName($new_name);
          $this->setDescription($new_description);
        }
    }
?>
