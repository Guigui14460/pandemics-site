<?php

require_once("AbstractRouter.php");
require_once("controller/PandemicController.php");
require_once("view/PandemicView.php");

class PandemicRouter extends AbstractRouter {
    public function __construct($main_router){
        parent::__construct("pandemic", new PandemicView($main_router), $main_router);
    }

    public function createURLs(){
        $this->urls["{$this->app_name}_list"] = "/{$this->app_name}";
        $this->urls["{$this->app_name}_list2"] = "/{$this->app_name}/list";
        $this->urls["{$this->app_name}_detail"] = "/{$this->app_name}/<id>";
        $this->urls["{$this->app_name}_create"] = "/{$this->app_name}/create";
        $this->urls["{$this->app_name}_update"] = "/{$this->app_name}/<id>/update";
        $this->urls["{$this->app_name}_delete"] = "/{$this->app_name}/<id>/delete";
    }

    public function main($db, $path_exploded){
        try {
            $controller = new PandemicController($this->view, $db->getStorage('pandemics'), $this->main_router);
            if(count($path_exploded) <= 0 || $path_exploded[0] === '' || $path_exploded[0] === "list"){
                $controller->showList();
            } else {
                if($path_exploded[0] === "create"){
                    if($_SERVER['REQUEST_METHOD'] === "POST"){
                        $controller->saveNewPandemic($_POST);
                    } else if($_SERVER['REQUEST_METHOD'] == "GET"){
                        $this->view->makePandemicCreationPage(new PandemicBuilder(array()));
                    } else {
                        $this->view->show405();
                    }
                } else if(count($path_exploded) == 1) {
                    $controller->showInformation($path_exploded[0]);
                } else if(count($path_exploded) == 2){
                    if($path_exploded[1] === 'update'){
                        if($_SERVER['REQUEST_METHOD'] === "POST"){
                            $controller->updatePandemic($_POST);
                        } else if($_SERVER['REQUEST_METHOD'] == "GET"){
                            $controller->askUpdatePandemic($path_exploded[0]);
                        } else {
                            $this->view->show405();
                        }
                    } else if($path_exploded[1] === "delete"){
                        if($_SERVER['REQUEST_METHOD'] === "POST"){
                            $controller->deletePandemic($_POST);
                        } else if($_SERVER['REQUEST_METHOD'] == "GET"){
                            $controller->askDeletionPandemic($path_exploded[0]);
                        } else {
                            $this->view->show405();
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

?>