<?php

    class Event
    {
        private $id;
        private $name;
        private $location;
        private $event_time;
        private $reqs;
        private $description;
        private $skill_level;

        function __construct($name, $location, $event_time, $reqs, $description, $skill_level, $id = null)
        {
            $this->name = $name;
            $this->location = $location;
            $this->event_time = $event_time;
            $this->reqs = $reqs;
            $this->description = $description;
            $this->skill_level = $skill_level;
            $this->id = $id;
        }

        function setId($new_id)
        {
            $this->id = $new_id;
        }

        function getId()
        {
            return $this->id;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function setLocation($new_location)
        {
            $this->location = $new_location;
        }

        function getLocation()
        {
            return $this->location;
        }

        function setEventTime($new_event_time)
        {
            $this->event_time = $new_event_time;
        }

        function getEventTime()
        {
            return $this->event_time;
        }

        function setReqs($new_reqs)
        {
            $this->reqs = $new_reqs;
        }

        function getReqs()
        {
            return $this->reqs;
        }

        function setDescription($new_description)
        {
            $this->description = $new_description;
        }

        function getDescription()
        {
            return $this->description;
        }

        function setSkillLevel($new_skill_level)
        {
            $this->$skill_level = $new_skill_level;
        }

        function getSkillLevel()
        {
            return $this->skill_level;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO events (id, name, location, event_time, reqs, description, skill_level) VALUES ('{$this->getName()}', '{$this->getLocation()}', '{$this->getEventTime()}', '{$this->getReqs()}', '{$this->getDescription()}', '{$this->getSkillLevel()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function getAll()
        {
            $all_events = $GLOBALS['DB']->query("SELECT * FROM events");
            $returned_events = array();
            foreach($all_events as $event) {
                $name = $event['name'];
                $location = $event['location'];
                $event_time = $event['event_time'];
                $reqs = $event['reqs'];
                $description = $event['description'];
                $skill_level = $event['skill_level'];
                $id = $event['id'];
                $new_event = new Event($name, $location, $event_time, $reqs, $description, $skill_level, $id);
                array_push($returned_events, $new_event);
            }
            return $returned_events;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM events *;");
        }

        static function find($search_id)
        {
            $all_events = Event::getAll();
            $found_events = null;
            foreach($all_events as $event) {
                if ($event->getId() == $search_id) {
                    $found_brands = $brand;
                }
            }
            return $found_brands;
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM events WHERE id = {$this->getId()};");
        }

    }

?>
