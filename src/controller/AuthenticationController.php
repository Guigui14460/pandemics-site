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

    public function getManager(){
        return $this->manager;
    }

    public function authenticate($login, $password){
        if(!$this->storage->existsByUsername($login)){
            return false;
        }
        return $this->manager->login($login, $password);
    }

    public function saveLoginPage($data){
        $builder = new UserBuilder($data, true, $this->manager);
        if($builder->isValid() && $this->authenticate($builder->getData($builder->getUsernameRef()), $builder->getData($builder->getPasswordRef()))){
            header("Location: /");
        } else {
            $this->view->makeLoginPage($builder);
        }
    }

    public function saveRegisterPage($data){
        $builder = new UserBuilder($data, false, $this->manager);
        if($builder->isValid()){
            $user = $builder->createUser();
            $id = $this->storage->create($user);
            if($id != "0"){
                $this->manager->login($builder->getData($builder->getUsernameRef()), $builder->getData($builder->getPasswordRef()));
                header("Location: /");
            } else {
                $this->view->makeRegisterPage($builder);
            }
        } else {
            $this->view->makeRegisterPage($builder);
        }
    }

    public function saveLogoutPage(){
        $this->manager->logout();
        header("Location: /");
    }
}

?>