<?php
    class User
    {
        private $email;
        private $password;
        private $id;
        function __construct($email, $password, $id = null)
        {
            $this->email = $email;
            $this->password = $password;
            $this->id = $id;
        }
        function setEmail($new_email)
        {
            $this->email = $new_email;
        }
        function setPassword($new_password)
        {
            $this->password = $new_password;
        }
        function setId($new_id)
        {
            $this->id = $new_id;
        }
        function getEmail()
        {
            return $this->email;
        }
        function getPassword()
        {
            return $this->password;
        }
        function getId()
        {
            return $this->id;
        }
        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO users (email, password) VALUES ('{$this->getEmail()}', '{$this->getPassword()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }
        function update($new_email)
        {
            $GLOBALS['DB']->exec("UPDATE users SET email = '{$new_email}' WHERE id = {$this->getId()};");
            $this->setEmail($new_email);
        }
        function updatePassword($new_password)
        {
            $GLOBALS['DB']->exec("UPDATE users SET password = '{$new_epassword}' WHERE id = {$this->getId()};");
            $this->setPassword($new_password);
        }
         static function getAll()
        {
            $returned_users = $GLOBALS['DB']->query("SELECT * FROM users");
            $users = array();
            foreach($returned_users as $user){
                $email = $user['email'];
                $password = $user['password'];
                $id = $user['id'];
                $new_user = new User($email, $password, $id);
                array_push($users, $new_user);
            }
            return $users;
        }
        function addEvent($event)//THIS IS OUR RSVP FUNCTION
        {
            $GLOBALS['DB']->exec("INSERT INTO events_users (event_id, user_id) VALUES ({$event->getId()}), {$this->getId()};");
        }
        function getEvents()
        {
            $user_ids = $GLOBALS['DB']->query("SELECT events.* FROM users JOIN events_users ON (users.id = events_users.user_id) JOIN events ON (events_users.event_id = events.id ) WHERE users.id = {$this->getId()};");
            $users = array();
            foreach($user_ids as $user) {
                $email = $user['email'];
                $password = $user['password'];
                $id = $user['id'];
                $new_user = new User($email, $password, $id);
                array_push($users, $new_user);
            }
            return $users;
        }
        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM users *;");
        }
        static function find($search_id)
        {
            $found_user = null;
            $users = User::getAll();
            foreach($users as $user) {
               $user_id = $user->getId();
               if ($user_id == $search_id) {
                   $found_user = $user;
               }
        }
           return  $found_user;
        }

        function deleteUser()
        {
            $GLOBALS['DB']->exec("DELETE FROM users WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM events_users WHERE user_id = {$this->getId()};");
        }
        static function authentication($email, $password)
        {
            //Here is where we access the database.
            $result = null;
            $users = User::getAll();
            foreach($users as $user) {
                $user_email = $user->getEmail();
                $user_password = $user->getPassword();
              if($email == $user_email && $password == $user_password) {
                  $result = $user;
            }
            return $result;
        }
        function startSession($user)
        {
          session_start();
          $_SESSION['user'] = $user;
        }

    }
}
?>
