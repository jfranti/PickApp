<?php
    class Player

    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function setName($new_name)

        {
            $this->name = (string) $new_name;
        }

        function getName()

        {
            return $this->name;
        }

        function getId()

        {
            return $this->id;
        }

        function setId($new_id)

        {
            $this->id = (int) $new_id;
        }

        function save()

        {
           $statement = $GLOBALS['DB']->query("INSERT INTO players (name) VALUES ('{$this->getName()}') RETURNING id;");
           $result = $statement->fetch(PDO::FETCH_ASSOC);
           $this->setId($result['id']);
        }

        static function getAll()

        {
            $returned_players = $GLOBALS['DB']->query("SELECT * FROM players;");
            $players = array();
            foreach($returned_players as $player){
                $name = $player['name'];
                $id = $player['id'];
                $new_player = new Player($name, $id);
                array_push($players, $new_player);
            }
            return $players;
        }

?>
