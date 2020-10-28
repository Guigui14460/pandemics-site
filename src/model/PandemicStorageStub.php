<?php

require_once("PandemicStorage.php");

class PandemicStorageStub implements PandemicStorage {
    private $PandemicsTab;

    public function __construct(){
        $this->PandemicsTab = array(
            'medor' => new Pandemic('Médor', 'chien', 4),
            'felix' => new Pandemic('Félix', 'chat', 8),
            'denver' => new Pandemic('Denver', 'dinosaure', 300),
        );
    }

    public function read($id) {
        if(key_exists($id, $this->PandemicsTab)){
            return $this->PandemicsTab[$id];
        }
        return null;
    }

    public function readAll() {
        return $this->PandemicsTab;
    }

    public function create($a){
        $id = uniqid();
        $this->PandemicsTab[$id] = $a;
        return $id;
    }

    public function exists($id){
        return key_exists($id, $this->PandemicsTab);
    }

    public function update($id, $a){
        if($this->exists($id)){
            $this->PandemicsTab[$id] = $a;
        }
    }

    public function delete($id){
        if($this->exists($id)){
            unset($id);
        }
    }
} 

?>