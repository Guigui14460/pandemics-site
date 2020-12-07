<?php

require_once("AbstractRouter.php");
require_once("controller/AuthenticationController.php");
require_once("model/UserBuilder.php");
require_once("view/AuthenticationView.php");

class AuthenticationRouter extends AbstractRouter
{
    public function __construct($main_router)
    {
        parent::__construct("accounts", new AuthenticationView($main_router), $main_router);
    }

    public function createURLs()
    {
        $this->urls["{$this->app_name}_login"] = "/{$this->app_name}/login";
        $this->urls["{$this->app_name}_logout"] = "/{$this->app_name}/logout";
        $this->urls["{$this->app_name}_signup"] = "/{$this->app_name}/signup";
    }

    public function main($db, $path_exploded = "", $auth_manager = null)
    {
        $next_url = (isset($_GET["next"]) ? $_GET["next"] : null);
        try {
            $controller = new AuthenticationController($this->view, $this->main_router, $auth_manager);
            if (count($path_exploded) == 1) {
                if ($path_exploded[0] == "login") {
                    if (!$auth_manager->isUserConnected()) {
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $controller->loginUser($_POST, $next_url);
                        } else if ($_SERVER["REQUEST_METHOD"] == "GET") {
                            $controller->askLoginUser($next_url);
                        } else {
                            $this->view->show405();
                        }
                    } else {
                        $this->POSTredirect(($next_url !== null ? $_SERVER['SCRIPT_NAME'] . $next_url : $this->getSimpleURL('home')), "Vous êtes déjà connecté !", "info");
                    }
                } else if ($path_exploded[0] == "logout") {
                    if ($auth_manager->isUserConnected()) {
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $controller->logoutUser();
                        } else if ($_SERVER["REQUEST_METHOD"] == "GET") {
                            $this->view->makeLogoutPage($auth_manager->getUser());
                        } else {
                            $this->view->show405();
                        }
                    } else {
                        $this->POSTredirect(($next_url !== null ? $_SERVER['SCRIPT_NAME'] . $next_url : $this->getSimpleURL('home')), "Vous êtes déjà déconnecté !", "info");
                    }
                } else if ($path_exploded[0] == "signup") {
                    if (!$auth_manager->isUserConnected()) {
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $controller->registerUser($_POST, $next_url);
                        } else if ($_SERVER["REQUEST_METHOD"] == "GET") {
                            $controller->askRegisterUser($next_url);
                        } else {
                            $this->view->show405();
                        }
                    } else {
                        $this->POSTredirect((isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $this->router->getSimpleURL("home")), "Vous êtes déjà connecté !", "info");
                    }
                } else {
                    $this->view->show404();
                }
            } else {
                $this->view->show404();
            }
        } catch (Exception $e) {
            $this->view->show500();
        }
    }
}
