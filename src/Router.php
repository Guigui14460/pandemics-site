<?php

require_once("AbstractRouter.php");
require_once("AuthenticationRouter.php");
require_once("PandemicRouter.php");
require_once("view/GeneralView.php");

class Router extends AbstractRouter {
    private $subrouters;

    public function __construct(){
        $this->subrouters = array(new PandemicRouter($this), new AuthenticationRouter($this));
        parent::__construct("", new GeneralView($this));
    }

    public function createURLs(){
        $this->urls["home"] = "/";
        $this->urls["about"] = "/about";
        $this->urls = array_merge($this->urls, $this->getSubRouter("pandemic")->getURLs());
        $this->urls = array_merge($this->urls, $this->getSubRouter("accounts")->getURLs());
    }

    public function main($db, $path_exploded){
        // var_export($_SERVER);
        $path_exploded = array_slice(explode('/', $_SERVER['PATH_INFO']), 1);
        
        try {
            if(count($path_exploded) <= 0 || $path_exploded[0] === ""){
                $this->view->homePage();
            } else if(count($path_exploded) == 1 && $path_exploded[0] == "about") {
                $this->view->aboutPage();
            } else if($path_exploded[0] == "pandemic"){
                $sub_router = $this->getSubRouter("pandemic");
                $sub_router->main($db, array_slice($path_exploded, 1));
                $this->view = $sub_router->getView();
            } else if($path_exploded[0] == "accounts"){
                $sub_router = $this->getSubRouter("accounts");
                $sub_router->main($db, array_slice($path_exploded, 1));
                $this->view = $sub_router->getView();
            } else {
                $this->view->show404();
            }
        } catch(Exception $e){
            $this->view->show500();
        }
        $this->view->render();
    }

    public function getSubRouter($app_name){
        foreach ($this->subrouters as $key) {
            if($key->getAppName() == $app_name){
                return $key;
            }
        }
        return null;
    }
}

?>