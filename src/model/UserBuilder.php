<?php

require_once("model/AbstractObjectBuilder.php");
require_once("model/User.php");

class UserBuilder extends AbstractObjectBuilder {
    private static $USERNAME_REF = "username", $PASSWORD_REF = "password";
    private $login, $manager;

    public function __construct($data=null, $login=false, $manager=null){
        if($data === null){
            $data = array(
                $USERNAME_REF => "",
                $PASSWORD_REF => "",
            );
        }
        parent::__construct($data);
        $this->login = $login;
        $this->manager = $manager;
    }

    public static function buildFromUser($user){
        return new UserBuilder(array(
            $USERNAME_REF => $user.getUsername(),
            $PASSWORD_REF => $user.getPassword(),
        ));
    }

    public function createUser(){
        if(!key_exists($this->getUsernameRef(), $this->data) || !key_exists($this->getPasswordRef(), $this->data))
            throw new Exception("Missing fields for user creation");
        if(!$this->isValid()){
            throw new Exception("Some fields are invalid for user creation");
        }
        return new User($this->data[$this->getUsernameRef()], password_hash($this->data[$this->getPasswordRef()], PASSWORD_BCRYPT));
    }

    public function isValid(){
        $this->error = array();
        $user = $this->manager->exists($this->data[$this->getUsernameRef()]);
		if(!key_exists($this->getUsernameRef(), $this->data) || $this->data[$this->getUsernameRef()] === null || $this->data[$this->getUsernameRef()] === ""){
            $this->error[$this->getUsernameRef()] = "Vous devez entrer un nom d'utilisateur.";
        } else if(!$this->login && $user !== null){ // on vérifie que personne a déjà ce nom d'utilisateur lors de l'inscription
            $this->error[$this->getUsernameRef()] = "Ce nom d'utilisateur a déjà été choisi.";
        } else if($this->login && $user === null){ // on vérifie que la personne existe lors de la connexion
            $this->error[$this->getUsernameRef()] = "Ce nom d'utilisateur n'existe pas.";
        }
        if(!key_exists($this->getPasswordRef(), $this->data) || $this->data[$this->getPasswordRef()] === null || $this->data[$this->getPasswordRef()] === ""){
            $this->error[$this->getPasswordRef()] = "Vous devez entrer un mot de passe.";
        } else if($this->login && $user !== null && !password_verify($this->data[$this->getPasswordRef()], $user->getPassword())){ // on vérifie que la personne a le bon mot de passe lors de la connexion
            $this->error[$this->getPasswordRef()] = "Votre mot de passe est erroné.";
        }
        return count($this->error) === 0;
    }

	public function getUsernameRef() {
		return self::$USERNAME_REF;
	}

	public function getPasswordRef() {
		return self::$PASSWORD_REF;
	}
}

?>