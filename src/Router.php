<?php

require_once("AbstractRouter.php");
require_once("AuthenticationRouter.php");
require_once("PandemicRouter.php");
require_once("controller/AuthenticationManager.php");
require_once("view/GeneralView.php");

class Router extends AbstractRouter
{
    
    private $subrouters;

    public function __construct()
    {
        $this->subrouters = array(new PandemicRouter($this), new AuthenticationRouter($this));
        parent::__construct("", new GeneralView($this));
    }

    public function createURLs()
    {
        $this->urls["home"] = "";
        $this->urls["about"] = "/about";
        $this->urls = array_merge($this->urls, $this->getSubRouter("pandemics")->getURLs());
        $this->urls = array_merge($this->urls, $this->getSubRouter("accounts")->getURLs());
    }

    public function main($db, $path_exploded = "", $auth_manager = null)
    {
       
        if (isset($_SERVER['PATH_INFO'])) {
            $path_exploded = array_slice(explode('/', $_SERVER['PATH_INFO']), 1);
        }
        $auth_manager = new AuthenticationManager($db->getStorage("users"));

        try {
            if ($path_exploded === "" || (count($path_exploded) == 1 && $path_exploded[0] === "")) {
                $this->view->homePage();
            } else if (count($path_exploded) == 1 && $path_exploded[0] === "about") {
                $this->view->aboutPage();
            } else {
                switch ($path_exploded[0]) {
                    case 'pandemics':
                        $sub_router = $this->getSubRouter("pandemics");
                        $sub_router->main($db, array_slice($path_exploded, 1), $auth_manager);
                        $this->view = $sub_router->getView();
                        break;
                    case 'accounts':
                        $sub_router = $this->getSubRouter("accounts");
                        $sub_router->main($db, array_slice($path_exploded, 1), $auth_manager);
                        $this->view = $sub_router->getView();
                        break;
                    default:
                        $this->view->show404();
                        break;
                }
            }
        } catch (Exception $e) {
            $this->view->show500();
        }
        if ($auth_manager->isUserConnected()) {
            $this->view->removeNavLink("Connexion");
            $this->view->removeNavLink("S'inscrire");
        } else {
            $this->view->removeNavLink("Nouvelle maladie");
            $this->view->removeNavLink("Déconnexion");
        }
        $this->view->setFeedback($this->getFeedback()); // on met le feedback pour n'importe quelle vue (General, Pandemic ou Authentication)
        $this->view->render();
    }

    public function getSubRouter($app_name)
    {
        foreach ($this->subrouters as $key) {
            if ($key->getAppName() === $app_name) {
                return $key;
            }
        }
        return null;
    }
}
