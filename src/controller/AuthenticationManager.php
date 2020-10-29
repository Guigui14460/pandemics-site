<?php

class AuthenticationManager {
    private $accounts;
    public static $SESSION_KEY = "user";

    public function __construct($accounts){
        $this->accounts = $accounts;
    }

    public function login($username, $password){
        if($username !== "" || $password !== ""){
            $user = $this->exists($username);
            if($user !== null && password_verify($password, $user->getPassword())){
                $_SESSION[self::$SESSION_KEY] = $user;
                return true;
            }
        }
        return false;
    }

    public function exists($username){
        foreach($this->accounts as $key){
            if($key->getUsername() === $username){
                return $key;
            }
        }
        return null;
    }

    public function isUserConnected(){
        return key_exists(self::$SESSION_KEY, $_SESSION) && $_SESSION[self::$SESSION_KEY] !== null;
    }

    public function isAdminConnected(){
        return $this->isUserConnected() && $_SESSION[self::$SESSION_KEY]->isAdmin();
    }

    public function getUser(){
        if($this->isUserConnected()){
            return $_SESSION[self::$SESSION_KEY];
        }
        return null;
    }

    public function logout(){
        $_SESSION[self::$SESSION_KEY] = null;
    }
}

?>