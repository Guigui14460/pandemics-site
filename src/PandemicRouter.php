<?php

require_once("AbstractRouter.php");
require_once("controller/PandemicController.php");
require_once("model/PandemicBuilder.php");
require_once("view/PandemicView.php");

class PandemicRouter extends AbstractRouter
{
    public function __construct($main_router)
    {
        parent::__construct("pandemics", new PandemicView($main_router), $main_router);
    }

    public function createURLs()
    {
        $this->urls["{$this->app_name}_list"] = "/{$this->app_name}";
        $this->urls["{$this->app_name}_detail"] = "/{$this->app_name}/<id>";
        $this->urls["{$this->app_name}_create"] = "/{$this->app_name}/create";
        $this->urls["{$this->app_name}_update"] = "/{$this->app_name}/<id>/update";
        $this->urls["{$this->app_name}_delete"] = "/{$this->app_name}/<id>/delete";
    }

    public function main($db, $path_exploded = "", $auth_manager = null)
    {
        $is_user_connected = $auth_manager->isUserConnected();
        $next = ".";
        for ($i = 0; $i < count(array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 1)); $i++) {
            $next .= "/..";
        }
        try {
            $controller = new PandemicController($this->view, $db->getStorage('pandemics'), $this->main_router, $auth_manager);
            if (count($path_exploded) <= 0 || $path_exploded[0] === '' || $path_exploded[0] === "list") {
                if ($_SERVER['REQUEST_METHOD'] === "POST") {
                    $controller->showListSearch($_POST["search"]);
                } else if ($_SERVER['REQUEST_METHOD'] == "GET") {
                    $controller->showList();
                } else {
                    $this->view->show405();
                }
            } else {
                if ($path_exploded[0] === "create") {
                    if ($is_user_connected) {
                        if ($_SERVER['REQUEST_METHOD'] === "POST") {
                            $controller->saveNewPandemic($_POST);
                        } else if ($_SERVER['REQUEST_METHOD'] == "GET") {
                            $controller->newPandemic();
                        } else {
                            $this->view->show405();
                        }
                    } else {
                        $next .= $this->main_router->getSimpleURL('pandemics_create');
                        $this->POSTredirect($this->main_router->getSimpleURL('accounts_login') . "?next=$next", "Vous devez être connecté pour créer une pandémie.", "info");
                    }
                } else if (count($path_exploded) == 1) {
                    if ($is_user_connected) {
                        $controller->showInformation($path_exploded[0], $auth_manager->getUser());
                    } else {
                        $next .= $this->main_router->getConfigurableURL('pandemics_detail', array('id' => $path_exploded[0]));
                        $this->POSTredirect(
                            $this->main_router->getSimpleURL('accounts_login') . "?next=$next",
                            "Vous devez être connecté pour voir les détails d'une pandémie.",
                            "info"
                        );
                    }
                } else if (count($path_exploded) == 2) {
                    if ($path_exploded[1] === 'update') {
                        if ($is_user_connected) {
                            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                                $controller->updatePandemic($_POST);
                            } else if ($_SERVER['REQUEST_METHOD'] == "GET") {
                                $controller->askUpdatePandemic($path_exploded[0]);
                            } else {
                                $this->view->show405();
                            }
                        } else {
                            $next .= $this->main_router->getConfigurableURL('pandemics_update', array('id' => $path_exploded[0]));
                            $this->POSTredirect(
                                $this->main_router->getSimpleURL('accounts_login') . "?next=$next",
                                "Vous devez être connecté pour modifier une pandémie.",
                                "info"
                            );
                        }
                    } else if ($path_exploded[1] === "delete") {
                        if ($is_user_connected) {
                            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                                $controller->deletePandemic($_POST);
                            } else if ($_SERVER['REQUEST_METHOD'] == "GET") {
                                $controller->askDeletionPandemic($path_exploded[0]);
                            } else {
                                $this->view->show405();
                            }
                        } else {
                            $next .= $this->main_router->getConfigurableURL('pandemics_delete', array('id' => $path_exploded[0]));
                            $this->POSTredirect(
                                $this->main_router->getSimpleURL('accounts_login') . "?next=$next",
                                "Vous devez être connecté pour supprimer une pandémie."
                            );
                        }
                    }
                } else {
                    $this->view->show404();
                }
            }
        } catch (Exception $e) {
            $this->view->show500();
        }
    }
}
