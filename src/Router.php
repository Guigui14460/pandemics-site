<?php
require_once("view/View.php");
require_once("controller/Controller.php");
require_once("model/AnimalStorage.php");

class Router {
    private View $view;

    public function main(AnimalStorage $db){
        $path_exploded = array_slice(explode('/', $_SERVER['PATH_INFO']), 1);
        
        $this->view = new View($this);
        try {
            if(count($path_exploded) <= 0 || $path_exploded[0] === ''){
                $this->view->makeHomePage();
            } else {
                $controller = new Controller($this->view, $db);
                if($path_exploded[0] === "list"){
                    $controller->showList();
                } else if($path_exploded[0] === "create"){
                    if($_SERVER['REQUEST_METHOD'] === "POST"){
                        $controller->saveNewAnimal($_POST);
                    } else if($_SERVER['REQUEST_METHOD'] == "GET"){
                        $this->view->makeAnimalCreationPage(new AnimalBuilder(array()));
                    } else {
                        $this->view->makeBadMethodErrorPage();
                    }
                } else {
                    if(count($path_exploded) == 1) {
                        $controller->showInformation($path_exploded[0]);
                    } else if(count($path_exploded) == 2){
                        if($path_exploded[1] === 'update'){
                            if($_SERVER['REQUEST_METHOD'] === "POST"){
                                $controller->updateAnimal($_POST);
                            } else if($_SERVER['REQUEST_METHOD'] == "GET"){
                                $controller->askUpdateAnimal($path_exploded[0]);
                            } else {
                                $this->view->makeBadMethodErrorPage();
                            }
                        } else if($path_exploded[1] === "delete"){
                            if($_SERVER['REQUEST_METHOD'] === "POST"){
                                $controller->deleteAnimal($_POST);
                            } else if($_SERVER['REQUEST_METHOD'] == "GET"){
                                $controller->askDeletionAnimal($path_exploded[0]);
                            } else {
                                $this->view->makeBadMethodErrorPage();
                            }
                        }
                    }
                }
            }
        } catch(Exception $e){
            $this->view->makeUnexpectedErrorPage();
        }
        $this->view->render();
    }

    public function getHomeURL(){
        return "/";
    }

    public function getAnimalURL($id){
        return "/$id";
    }

    public function getAnimalListURL(){
        return "/list";
    }

    public function getAnimalCreationURL(){
        return "/create";
    }

    public function getAnimalUpdateURL($id){
        return "/$id/update";
    }

    public function getAnimalDeletionURL($id){
        return "/$id/delete";
    }
}

?>