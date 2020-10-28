<?php

require_once("view/View.php");
require_once("model/Animal.php");
require_once("model/AnimalStorage.php");
require_once("model/AnimalBuilder.php");

class Controller {
    private $view;
    private $storage;

    public function __construct($view, $storage){
        $this->view = $view;
        $this->storage = $storage;
    }

    public function showInformation($id) {
        $animal = $this->storage->read($id);
        if($animal !== null){
            $this->view->makeAnimalPage($animal, $id);
        } else {
			$this->view->makeUnknownAnimalPage();
		}
    }

    public function showList(){
        $this->view->makeListPage($this->storage->readAll());
    }

    public function saveNewAnimal($data){
        $builder = new AnimalBuilder($data);
        if($builder->isValid()){
            $animal = $builder->createAnimal();
            $id = $this->storage->create($animal);
            $this->view->makeAnimalPage($animal, $id);
            header("Location: ../$id");
        } else {
            $this->view->makeAnimalCreationPage($builder);
        }
    }

    public function updateAnimal($data){
        if(isset($data['animal_id'])){
            $id = $data['animal_id'];
            $animal = $this->storage->read($id);
            if($animal !== null){
                $builder = new AnimalBuilder($data);
                if($builder->isValid()){
                    $builder->updateAnimal($animal);
                    $this->storage->update($id, $animal);
                    $this->view->makeAnimalPage($animal, $id);
                    header("Location: ../$id");
                } else {
                    $this->view->makeAnimalUpdatePage($builder, $id);
                }
            } else {
                $this->view->makeUnknownAnimalPage();
            }
        } else {
            $this->view->makeUnexpectedErrorPage();
        }
    }

    public function askUpdateAnimal($id){
        $animal = $this->storage->read($id);
        if($animal !== null){
            $this->view->makeAnimalUpdatePage(AnimalBuilder::buildFromAnimal($animal), $id);
        } else {
			$this->view->makeUnknownAnimalPage();
		}
    }

    public function deleteAnimal($data){
        if(isset($data['animal_id'])){
            $id = $data['animal_id'];
            $animal = $this->storage->read($id);
            if($animal !== null){
                $this->storage->delete($id);
                $this->showList();
            } else {
                $this->view->makeUnknownAnimalPage();
            }
        } else {
            $this->view->makeUnexpectedErrorPage();
        }
    }

    public function askDeletionAnimal($id){
        $animal = $this->storage->read($id);
        if($animal !== null){
            $this->view->makeAnimalDeletionPage($animal, $id);
        } else {
			$this->view->makeUnknownAnimalPage();
		}
    }
}

?>