<?php

require_once("AnimalStorage.php");

class AnimalStorageStub implements AnimalStorage {
    private array $animalsTab;

    public function __construct(){
        $this->animalsTab = array(
            'medor' => new Animal('Médor', 'chien', 4),
            'felix' => new Animal('Félix', 'chat', 8),
            'denver' => new Animal('Denver', 'dinosaure', 300),
        );
    }

    public function read(string $id) {
        if(key_exists($id, $this->animalsTab)){
            return $this->animalsTab[$id];
        }
        return null;
    }

    public function readAll() :array {
        return $this->animalsTab;
    }

    public function create(Animal $a){
        $id = uniqid();
        $this->animalsTab[$id] = $a;
        return $id;
    }

    public function exists($id){
        return key_exists($id, $this->animalsTab);
    }

    public function update(string $id, Animal $a){
        if($this->exists($id)){
            $this->animalsTab[$id] = $a;
        }
    }

    public function delete(string $id){
        if($this->exists($id)){
            unset($id);
        }
    }
} 

?>