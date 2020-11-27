<?php

class User
{
    private $username, $password, $status;

    public function __construct($username, $password, $status)
    {
        $this->setUsername($username);
        $this->password = $password;
        $this->setStatus($status);
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

    public function getPassword()
    {
        return $this->password;
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

    public static function isStatusValid($status)
    {
        return is_string($status) && $status !== "" && ($status === "user" || $status === "admin");
    }
}
