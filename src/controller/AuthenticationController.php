<?php

require_once("model/UserBuilder.php");

class AuthenticationController
{
    private $view, $manager, $router;
    protected $loginUserBuilder, $registerUserBuilder;

    public function __construct($view, $router, $manager)
    {
        $this->view = $view;
        $this->router = $router;
        $this->manager = $manager;
        $this->loginUserBuilder = key_exists('loginUserBuilder', $_SESSION) ? $_SESSION['loginUserBuilder'] : null;
        $this->registerUserBuilder = key_exists('registerUserBuilder', $_SESSION) ? $_SESSION['registerUserBuilder'] : null;
    }

    public function __destruct()
    {
        $_SESSION['loginUserBuilder'] = $this->loginUserBuilder;
        $_SESSION['registerUserBuilder'] = $this->registerUserBuilder;
    }

    public function authenticate($login, $password)
    {
        return $this->manager->connectUser($login, $password);
    }

    public function askLoginUser($next_url)
    {
        if ($this->loginUserBuilder === null) {
            $this->loginUserBuilder = new UserBuilder(null, true, false);
        }
        $this->view->makeLoginPage($this->loginUserBuilder, $next_url);
    }

    public function loginUser($data, $next_url)
    {
        $this->loginUserBuilder = new UserBuilder($data, true, false);
        if ($this->loginUserBuilder->isValid($this->manager) && $this->authenticate($this->loginUserBuilder->getData($this->loginUserBuilder->getUsernameRef()), $this->loginUserBuilder->getData($this->loginUserBuilder->getPasswordRef()))) {
            $this->loginUserBuilder = null;
            $this->view->displayLoginSuccess($next_url);
        } else {
            $this->view->displayLoginFailure($next_url);
        }
    }

    public function askRegisterUser($next_url)
    {
        if ($this->registerUserBuilder === null) {
            $this->registerUserBuilder = new UserBuilder(null, false, false);
        }
        $this->view->makeRegisterPage($this->registerUserBuilder, $next_url);
    }

    public function registerUser($data, $next_url)
    {
        $this->registerUserBuilder = new UserBuilder($data, false, false);
        if ($this->registerUserBuilder->isValid($this->manager)) {
            $user = $this->registerUserBuilder->createUser($this->manager);
            if ($this->manager->registerUser($user) && $this->authenticate($this->registerUserBuilder->getData($this->registerUserBuilder->getUsernameRef()), $this->registerUserBuilder->getData($this->registerUserBuilder->getPasswordRef()))) {
                $this->registerUserBuilder = null;
                $this->view->displayRegisterSuccess($next_url);
            } else {
                $this->view->displayRegisterFailure($next_url);
            }
        } else {
            $this->view->displayRegisterFailure($next_url);
        }
    }

    public function logoutUser()
    {
        $this->manager->disconnectUser();
        $this->view->displayLogoutSuccess();
    }
}
