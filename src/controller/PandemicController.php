<?php

require_once("model/Pandemic.php");
require_once("model/PandemicBuilder.php");
require_once("model/Storage.php");
require_once("view/PandemicView.php");

class PandemicController {
    private $view, $storage, $router;

    public function __construct($view, $storage, $router){
        $this->view = $view;
        $this->storage = $storage;
        $this->router = $router;
    }

    public function showInformation($id,$user) {
        $pandemic = $this->storage->read($id);
        if($pandemic !== null){
            $this->view->makePandemicPage($pandemic, $id, $user);
        } else {
            $this->view->displayUnknownPandemic();
		}
    }

    public function showList(){
        $this->view->makeListPage($this->storage->readAll());
    }

    public function saveNewPandemic($data){
        $builder = new PandemicBuilder($data);
        if($builder->isValid()){
            $pandemic = $builder->createPandemic();
            $id = $this->storage->create($pandemic);
            $this->view->displayCreationPandemicSuccess($id);
        } else {
            $this->view->makePandemicCreationPage($builder); // à modifier plus tard avec l'utilisation des sessions
        }
    }

    public function updatePandemic($data){
        if(isset($data['pandemic_id'])){
            $id = $data['pandemic_id'];
            $pandemic = $this->storage->read($id);
            if($pandemic !== null){
                $builder = new PandemicBuilder($data);
                if($builder->isValid()){
                    $builder->updatePandemic($pandemic);
                    $this->storage->update($id, $pandemic);
                    $this->view->displayUpdatePandemicSuccess($id);
                } else {
                    $this->view->makePandemicUpdatePage($builder, $id); // à modifier plus tard avec l'utilisation des sessions
                }
            } else {
                $this->view->displayUnknownPandemic();
            }
        } else {
            $this->view->show500();
        }
    }

    public function askUpdatePandemic($id){
        $pandemic = $this->storage->read($id);
        if($pandemic !== null){
            $this->view->makePandemicUpdatePage(PandemicBuilder::buildFromPandemic($pandemic), $id);
        } else {
            $this->view->displayUnknownPandemic();
		}
    }

    public function deletePandemic($data){
        if(isset($data['pandemic_id'])){
            $id = $data['pandemic_id'];
            $pandemic = $this->storage->read($id);
            if($pandemic !== null){
                $this->storage->delete($id);
                $this->showList();
                $this->view->displayDeletionPandemicSuccess();
            } else {
                $this->view->displayUnknownPandemic();
            }
        } else {
            $this->view->show500();
        }
    }

    public function askDeletionPandemic($id){
        $pandemic = $this->storage->read($id);
        if($pandemic !== null){
            $this->view->makePandemicDeletionPage($pandemic, $id);
        } else {
            $this->view->displayUnknownPandemic();
		}
    }
}

?>