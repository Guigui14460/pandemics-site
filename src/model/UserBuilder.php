<?php

class UserBuilder {
    private $data;
    private $error;
    private static $USERNAME_REF = "username", $PASSWORD_REF = "password";

    public function __construct($data=null){
        if($data === null){
            $data = array(
                $USERNAME_REF => "",
                $PASSWORD_REF => "",
            );
        }
        $this->data = $data;
        $this->error = array();
    }

    public function getData($ref){
        return key_exists($ref, $this->data) ? $this->data[$ref] : '';
    }

    public function getError($ref){
        return key_exists($ref, $this->error) ? $this->error[$ref] : '';
    }

    public static function buildFromUser($user){
        return new UserBuilder(array(
            $USERNAME_REF => $user.getUsername(),
            $PASSWORD_REF => $user.getPassword(),
        ));
    }

    public function createUser(){

    }

    public function isValid(){
        // TODO: vérifier qu'un nom d'utilisateur n'a pas déjà été pris
        $this->error = array(); 
		if(!key_exists($this->getUsernameRef(), $this->data) || $this->data[$this->getUsernameRef()] === null || $this->data[$this->getUsernameRef()] === "")
            $this->error[$this->getUsernameRef()] = "Vous devez entrer un nom d'utilisateur";
        if(!key_exists($this->getPasswordRef(), $this->data) || $this->data[$this->getPasswordRef()] === null || $this->data[$this->getPasswordRef()] === "")
            $this->error[$this->getPasswordRef()] = "Vous devez entrer un mot de passe valide";
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