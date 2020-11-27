<?php

require_once("controller/AuthenticationManager.php");
require_once("model/UserBuilder.php");

class AuthenticationController
{
    private $view, $manager, $router;

    public function __construct($view, $router, $manager)
    {
        $this->view = $view;
        $this->router = $router;
        $this->manager = $manager;
    }

    public function authenticate($login, $password)
    {
        return $this->manager->connectUser($login, $password);
    }

    public function loginUser($data, $next_url)
    {
        $builder = new UserBuilder($data, true, $this->manager);
        if ($builder->isValid() && $this->authenticate($builder->getData($builder->getUsernameRef()), $builder->getData($builder->getPasswordRef()))) {
            $this->view->displayLoginSuccess($next_url);
        } else {
            $this->view->makeLoginPage($builder, $next_url);
        }
    }

    public function registerUser($data, $next_url)
    {
        $builder = new UserBuilder($data, false, $this->manager);
        if ($builder->isValid()) {
            $user = $builder->createUser();
            if ($this->manager->registerUser($user) && $this->authenticate($builder->getData($builder->getUsernameRef()), $builder->getData($builder->getPasswordRef()))) {
                $this->view->displayRegisterSuccess($next_url);
            } else {
                $this->view->displayRegisterFailure($next_url);
            }
        } else {
            $this->view->makeRegisterPage($builder, $next_url);
        }
    }

    public function logoutUser()
    {
        $this->manager->disconnectUser();
        $this->view->displayLogoutSuccess();
    }
}
