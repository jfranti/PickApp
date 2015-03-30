

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
            $statement = $GLOBALS['DB']->exec("INSERT INTO user (email, password) VALUES ('$this->getEmail()', $this->getId());");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

         static function getAll()
        {
            $returned_users = $GLOBALS['DB']->query("SELECT * FROM user");

            $users = array();
            foreach($returned_users as $user){
                $email = $user['email'];
                $password = $user['password'];
                $id = $brand['id'];
                $new_user = new User($email, $password, $id);
                array_push($users, $new_user);
            }
            return $users;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM user *;")
        }
    }



?>
