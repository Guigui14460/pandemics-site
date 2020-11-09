<?php

class User {
    private $username, $password, $admin;
    
    public function __construct($username, $password, $admin=false){
        $this->setUsername($username);
        $this->password = $password;
        $this->setAdmin($admin);
    }

    public function getUsername(){
        return $this->username;
    }

    public function setUsername($username){
        if(!self::isUsernameValid($username)){
            throw new Exception("invalid username");
        }
        $this->username = $username;
    }

    public function getPassword(){
        return $this->password;
    }

    public function isAdmin(){
        return $this->admin;
    }

    private function setAdmin($admin){
        if(!self::isAdminValid($admin)){
            throw new Exception("invalid type used for admin attribute");
        }
        $this->admin = $admin;
    }

    public static function isUsernameValid($username){
        return is_string($username) && $username !== "";
    }

    public static function isAdminValid($admin){
        return is_bool($admin);
    }
}

?>