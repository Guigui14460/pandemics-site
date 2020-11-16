<?php

require_once("controller/AuthenticationManager.php");
require_once("model/UserBuilder.php");

class AuthenticationController {
    private $view, $storage, $manager;

    public function __construct($view, $storage){
        $this->view = $view;
        $this->storage = $storage;
        $this->manager = new AuthenticationManager($storage->readAll());
    }

    public function authenticate($login, $password){
        if(!$this->storage->existsByUsername($login)){
            return false;
        }
        return $this->manager->connectUser($login, $password);
    }

    public function loginUser($data, $next_url){
        $builder = new UserBuilder($data, true, $this->manager);
        if($builder->isValid() && $this->authenticate($builder->getData($builder->getUsernameRef()), $builder->getData($builder->getPasswordRef()))){
            $this->view->displayLoginSuccess($next_url);
        } else {
            $this->view->makeLoginPage($builder, $next_url); // à modifier plus tard avec l'utilisation des sessions
        }
    }

    public function registerUser($data, $next_url){
        $builder = new UserBuilder($data, false, $this->manager);
        if($builder->isValid()){
            $user = $builder->createUser();
            $this->storage->create($user);
            $this->manager->connectUser($builder->getData($builder->getUsernameRef()), $builder->getData($builder->getPasswordRef()));
            $this->view->displayRegisterSuccess($next_url);
        } else {
            $this->view->makeRegisterPage($builder, $next_url); // à modifier plus tard avec l'utilisation des sessions
        }
    }

    public function logoutUser(){
        $this->manager->disconnectUser();
        $this->view->displayLogoutSuccess();
    }
}

?>