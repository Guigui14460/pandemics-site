<?php

require_once("AbstractRouter.php");
require_once("controller/AuthenticationController.php");
require_once("model/UserBuilder.php");
require_once("view/AuthenticationView.php");

class AuthenticationRouter extends AbstractRouter {
    public function __construct($main_router){
        parent::__construct("accounts", new AuthenticationView($main_router), $main_router);
    }

    public function createURLs(){
        $this->urls["{$this->app_name}_login"] = "/{$this->app_name}/login";
        $this->urls["{$this->app_name}_logout"] = "/{$this->app_name}/logout";
        $this->urls["{$this->app_name}_signup"] = "/{$this->app_name}/signup";
    }

    public function main($db, $path_exploded){
        try {
            $controller = new AuthenticationController($this->view, $db->getStorage('users'), $this->main_router);
            $manager = $controller->getManager();
            if(count($path_exploded) == 1){
                if($path_exploded[0] == "login"){
                    if(!$manager->isUserConnected()){
                        if($_SERVER["REQUEST_METHOD"] == "POST"){
                            $controller->saveLoginPage($_POST);
                        } else if($_SERVER["REQUEST_METHOD"] == "GET"){
                            $this->view->makeLoginPage(new UserBuilder(null, true));
                        } else {
                            $this->view->show405();
                        }
                    } else {
                        header("Location: {$_SERVER['HTTP_REFERER']}");
                    }
                } else if($path_exploded[0] == "logout"){
                    if($manager->isUserConnected()){
                        if($_SERVER["REQUEST_METHOD"] == "POST"){
                            $controller->saveLogoutPage();
                        } else if($_SERVER["REQUEST_METHOD"] == "GET"){
                            $this->view->makeLogoutPage($manager->getUser());
                        } else {
                            $this->view->show405();
                        }
                    } else {
                        header("Location: /");
                    }
                } else if($path_exploded[0] == "signup"){
                    if(!$manager->isUserConnected()){
                        if($_SERVER["REQUEST_METHOD"] == "POST"){
                            $controller->saveRegisterPage($_POST);
                        } else if($_SERVER["REQUEST_METHOD"] == "GET"){
                            $this->view->makeRegisterPage(new UserBuilder());
                        } else {
                            $this->view->show405();
                        }
                    } else {
                        header("Location: {$_SERVER['HTTP_REFERER']}");
                    }
                }
            } else {
                $this->view->show404();
            }
        } catch (Exception $e) {
            $this->view->show500();
        }
    }
}

?>