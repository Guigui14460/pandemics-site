<?php

require_once("view/View.php");
require_once("model/Pandemic.php");
require_once("model/PandemicStorage.php");
require_once("model/PandemicBuilder.php");

class Controller {
    private $view;
    private $storage;

    public function __construct($view, $storage){
        $this->view = $view;
        $this->storage = $storage;
    }

    public function showInformation($id) {
        $pandemic = $this->storage->read($id);
        if($pandemic !== null){
            $this->view->makePandemicPage($pandemic, $id);
        } else {
			$this->view->makeUnknownPandemicPage();
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
            $this->view->makePandemicPage($pandemic, $id);
            header("Location: ../$id");
        } else {
            $this->view->makePandemicCreationPage($builder);
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
                    $this->view->makePandemicPage($pandemic, $id);
                    header("Location: ../$id");
                } else {
                    $this->view->makePandemicUpdatePage($builder, $id);
                }
            } else {
                $this->view->makeUnknownPandemicPage();
            }
        } else {
            $this->view->makeUnexpectedErrorPage();
        }
    }

    public function askUpdatePandemic($id){
        $pandemic = $this->storage->read($id);
        if($pandemic !== null){
            $this->view->makePandemicUpdatePage(PandemicBuilder::buildFromPandemic($pandemic), $id);
        } else {
			$this->view->makeUnknownPandemicPage();
		}
    }

    public function deletePandemic($data){
        if(isset($data['Pandemic_id'])){
            $id = $data['Pandemic_id'];
            $pandemic = $this->storage->read($id);
            if($pandemic !== null){
                $this->storage->delete($id);
                $this->showList();
            } else {
                $this->view->makeUnknownPandemicPage();
            }
        } else {
            $this->view->makeUnexpectedErrorPage();
        }
    }

    public function askDeletionPandemic($id){
        $pandemic = $this->storage->read($id);
        if($pandemic !== null){
            $this->view->makePandemicDeletionPage($pandemic, $id);
        } else {
			$this->view->makeUnknownPandemicPage();
		}
    }
}

?>