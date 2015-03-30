<?php

    class Event
    {
        private $id;
        private $name;
        private $location;
        private $time;
        private $reqs;
        private $description;
        private $skill_level;

        function __construct($name, $location, $time, $reqs, $description, $skill_level, $id = null)
        {
            $this->name = $name;
            $this->$location = $location;
            $this->time = $time;
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

        function setLocation($new_location)
        {
            $this->location = $new_location;
        }

        function getLocation()
        {
            return $this->location;
        }

        function setTime($new_time)
        {
            $this->time = $new_time;
        }

        function getTime()
        {
            return $this->time;
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
            return $this->description;
        }





    }

?>
