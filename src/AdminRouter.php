<?php

require_once("AbstractRouter.php");
require_once("controller/AdminController.php");
require_once("model/UserBuilder.php");
require_once("view/AdminView.php");

class AdminRouter extends AbstractRouter
{
    public function __construct($main_router)
    {
        parent::__construct("admin", new AdminView($main_router), $main_router);
    }

    public function createURLs()
    {
        $this->urls["{$this->app_name}_index"] = "/{$this->app_name}";
        $this->urls["{$this->app_name}_user_list"] = "/{$this->app_name}/user";
        $this->urls["{$this->app_name}_user_detail"] = "/{$this->app_name}/user/<id>";
        $this->urls["{$this->app_name}_user_create"] = "/{$this->app_name}/user/create";
        $this->urls["{$this->app_name}_user_update"] = "/{$this->app_name}/user/<id>/update";
        $this->urls["{$this->app_name}_user_delete"] = "/{$this->app_name}/user/<id>/delete";
    }

    public function main($db, $path_exploded = "", $auth_manager = null)
    {
        $next = ".";
        for ($i = 0; $i < count(array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 1)); $i++) {
            $next .= "/..";
        }
        try {
            $controller = new AdminController($this->view, $db->getStorage('users'), $this->main_router, $auth_manager);
            if (count($path_exploded) <= 0 || $path_exploded[0] === '') {
                $this->view->showIndex();
            } else if ($path_exploded[0] === 'user') {
                if (count($path_exploded) <= 1 || $path_exploded[1] === '') {
                    $controller->showList();
                } else if (count($path_exploded) == 2) {
                    if ($path_exploded[1] === "create") {
                        if ($_SERVER['REQUEST_METHOD'] === "POST") {
                            $controller->saveNewUser($_POST);
                        } else if ($_SERVER['REQUEST_METHOD'] == "GET") {
                            $controller->newUser();
                        } else {
                            $this->view->show405();
                        }
                    } else {
                        $controller->showInformation($path_exploded[1]);
                    }
                } else if (count($path_exploded) == 3) {
                    if ($path_exploded[2] === 'update') {
                        if ($_SERVER['REQUEST_METHOD'] === "POST") {
                            $controller->updateUser($_POST);
                        } else if ($_SERVER['REQUEST_METHOD'] == "GET") {
                            $controller->askUpdateUser($path_exploded[1]);
                        } else {
                            $this->view->show405();
                        }
                    } else if ($path_exploded[2] === "delete") {
                        if ($_SERVER['REQUEST_METHOD'] === "POST") {
                            $controller->deleteUser($_POST);
                        } else if ($_SERVER['REQUEST_METHOD'] == "GET") {
                            $controller->askDeletionUser($path_exploded[1]);
                        } else {
                            $this->view->show405();
                        }
                    }
                } else {
                    $this->view->show404();
                }
            }
        } catch (Exception $e) {
            var_export($e);
            $this->view->show500();
        }
    }
}
