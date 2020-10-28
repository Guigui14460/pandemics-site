<?php

class AuthenticationManager {
    private $accounts;
    public static $SESSION_KEY = "user";

    public function login($username, $password){
        if($username !== "" || $password !== ""){
            foreach($this->comptes as $key){
                if($key.getUsername() == $username && password_verify($password, $key.getPassword())){
                    $_SESSION[$SESSION_KEY] = $key;
                    return true;
                }
            }
        }
        return false;
    }

    public function isUserConnected(){
        return key_exists($SESSION_KEY, $_SESSION) && $_SESSION[$SESSION_KEY] !== null;
    }

    public function isAdminConnected(){
        return $this->isUserConnected() && $_SESSION[$SESSION_KEY].isAdmin();
    }

    public function getUser(){
        if($this->isUserConnected()){
            return $_SESSION[$SESSION_KEY];
        }
        return null;
    }

    public function logout(){
        $_SESSION[$SESSION_KEY] = null;
    }
}

?>