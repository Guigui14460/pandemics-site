<?php

class AuthenticationManager
{
    public static $SESSION_KEY = "user";
    private $storage;

    public function __construct($storage)
    {
        $this->storage = $storage;
    }

    public function registerUser($user)
    {
        $last_id = $this->storage->lastInsertId();
        $id = $this->storage->create($user);
        return $last_id !== $id;
    }

    public function connectUser($username, $password)
    {
        if ($username !== "" || $password !== "") {
            $user = $this->exists($username);
            if ($user !== null && password_verify($password, $user->getPassword())) {
                $_SESSION[self::$SESSION_KEY] = $user;
                return true;
            }
        }
        return false;
    }

    public function exists($username)
    {
        foreach ($this->storage->readAll() as $key => $value) {
            if ($value->getUsername() === $username) {
                return $value;
            }
        }
        return null;
    }

    public function isUserConnected()
    {
        return key_exists(self::$SESSION_KEY, $_SESSION) && $_SESSION[self::$SESSION_KEY] !== null;
    }

    public function isAdminConnected()
    {
        return $this->isUserConnected() && $_SESSION[self::$SESSION_KEY]->isAdmin();
    }

    public function getUser()
    {
        if ($this->isUserConnected()) {
            return $_SESSION[self::$SESSION_KEY];
        }
        return null;
    }

    public function disconnectUser()
    {
        $_SESSION[self::$SESSION_KEY] = null;
    }
}
