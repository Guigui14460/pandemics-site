<?php

require_once("model/AbstractObjectBuilder.php");
require_once("model/User.php");

class UserBuilder extends AbstractObjectBuilder
{
    private static $USERNAME_REF = "username", $PASSWORD_REF = "password", $STATUS_REF = "status";
    private $login, $modify;

    public function __construct($data = null, $login = false, $modify = false)
    {
        if ($data === null) {
            $data = array(
                self::$USERNAME_REF => "",
                self::$PASSWORD_REF => "",
                self::$STATUS_REF => "user",
            );
        } else {
            if (!key_exists(self::$STATUS_REF, $data)) {
                $data[self::$STATUS_REF] = "user";
            }
        }
        parent::__construct($data);
        $this->login = $login;
        $this->modify = $modify;
    }

    public static function buildFromUser($user, $login = false, $modify = false)
    {
        return new UserBuilder(array(
            self::$USERNAME_REF => $user->getUsername(),
            self::$PASSWORD_REF => $user->getPassword(),
            self::$STATUS_REF => $user->getStatus(),
        ), $login, $modify);
    }

    public function createUser($manager)
    {
        if (!key_exists($this->getUsernameRef(), $this->data) || !key_exists($this->getPasswordRef(), $this->data) || !key_exists($this->getStatusRef(), $this->data))
            throw new Exception("Missing fields for user creation");
        if (!$this->isValid($manager)) {
            throw new Exception("Some fields are invalid for user creation");
        }
        return new User($this->data[$this->getUsernameRef()], password_hash($this->data[$this->getPasswordRef()], PASSWORD_BCRYPT), $this->data[$this->getStatusRef()]);
    }

    public function updateUser($user)
    {
        if (key_exists($this->getUsernameRef(), $this->data)) {
            $user->setUsername($this->data[$this->getUsernameRef()]);
        }
        if (key_exists($this->getPasswordRef(), $this->data) && substr($this->data[$this->getPasswordRef()], 0, 7) !== "$2y$10$") {
            $user->setPassword(password_hash($this->data[$this->getPasswordRef()], PASSWORD_BCRYPT), $this->data[$this->getStatusRef()]);
        }
        if (key_exists($this->getStatusRef(), $this->data)) {
            $user->setStatus($this->data[$this->getStatusRef()]);
        }
    }

    public function isValid($manager)
    {
        $this->error = array();
        $user = $manager->exists($this->data[$this->getUsernameRef()]);
        if (!key_exists($this->getUsernameRef(), $this->data) || $this->data[$this->getUsernameRef()] === null || $this->data[$this->getUsernameRef()] === "") {
            $this->error[$this->getUsernameRef()] = "Vous devez entrer un nom d'utilisateur.";
        } else if (!$this->login && $user !== null && !$this->modify) { // on vérifie que personne a déjà ce nom d'utilisateur lors de l'inscription
            $this->error[$this->getUsernameRef()] = "Ce nom d'utilisateur a déjà été choisi.";
        } else if ($this->login && $user === null && !$this->modify) { // on vérifie que la personne existe lors de la connexion
            $this->error[$this->getUsernameRef()] = "Ce nom d'utilisateur n'existe pas.";
        }
        if (!key_exists($this->getPasswordRef(), $this->data) || $this->data[$this->getPasswordRef()] === null || $this->data[$this->getPasswordRef()] === "") {
            $this->error[$this->getPasswordRef()] = "Vous devez entrer un mot de passe.";
            $this->data[$this->getPasswordRef()] = "";
        } else if ($this->login && !$this->modify && $user !== null && !password_verify($this->data[$this->getPasswordRef()], $user->getPassword())) { // on vérifie que la personne a le bon mot de passe lors de la connexion
            $this->error[$this->getPasswordRef()] = "Votre mot de passe est erroné.";
            $this->data[$this->getPasswordRef()] = "";
        }
        if (!key_exists($this->getStatusRef(), $this->data) || $this->data[$this->getStatusRef()] === null || $this->data[$this->getStatusRef()] === "") {
            $this->error[$this->getStatusRef()] = "Vous devez entrer un statut.";
            $this->data[$this->getStatusRef()] = "";
        } else if ($this->data[$this->getStatusRef()] !== "admin" && $this->data[$this->getStatusRef()] !== "user") {
            $this->error[$this->getStatusRef()] = "Le status entré n'est pas autorisé. Seuls 'admin' et 'user' sont autorisés.";
            $this->data[$this->getStatusRef()] = "";
        }
        return count($this->error) === 0;
    }

    public function getUsernameRef()
    {
        return self::$USERNAME_REF;
    }

    public function getPasswordRef()
    {
        return self::$PASSWORD_REF;
    }

    public function getStatusRef()
    {
        return self::$STATUS_REF;
    }
}
