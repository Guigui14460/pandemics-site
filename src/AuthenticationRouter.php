<?php

require_once("view/AuthenticationView.php");
require_once("controller/AuthenticationController.php");

class AuthenticationRouter {
    private $view;

    public function main($db, $path_exploded){
        $this->view = new AuthenticationView($this);
        try {
            //code...
        } catch (Exception $e) {
            //throw $th;
        }
        $this->view->render();
    }

    public function getLoginURL(){
        return "/login";
    }

    public function getLogoutURL(){
        return "/logout";
    }

    public function getSignUpURL(){
        return "/signup";
    }
}

?>