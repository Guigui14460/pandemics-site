<?php

class User
{
    private $username, $password, $status, $oldUsername;

    public function __construct($username, $password, $status)
    {
        $this->setUsername($username);
        $this->password = $password;
        $this->setStatus($status);
        $this->setOldUsername($username);
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        if (!self::isUsernameValid($username)) {
            throw new Exception("invalid username");
        }
        $this->username = $username;
    }

    public function getOldUsername()
    {
        return $this->oldUsername;
    }

    public function setOldUsername($oldUsername)
    {
        if (!self::isUsernameValid($oldUsername)) {
            throw new Exception("invalid old username");
        }
        $this->oldUsername = $oldUsername;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        if (!self::isPasswordValid($password)) {
            throw new Exception("password not hashed");
        }
        $this->password = $password;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        if (!self::isStatusValid($status)) {
            throw new Exception("invalid status");
        }
        $this->status = $status;
    }

    public function isAdmin()
    {
        return $this->status === "admin";
    }

    public static function isUsernameValid($username)
    {
        return is_string($username) && $username !== "";
    }

    public static function isPasswordValid($password)
    {
        return is_string($password) && $password !== "" && substr($password, 0, 7) === "$2y$10$";
    }

    public static function isStatusValid($status)
    {
        return is_string($status) && $status !== "" && ($status === "user" || $status === "admin");
    }
}
