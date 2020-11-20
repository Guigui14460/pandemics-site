<?php

require_once("model/Storage.php");

class PandemicStorageStub implements Storage {
    private $pandemicsTab;

    public function __construct(){
        $this->pandemicsTab = array(
            'medor' => new Pandemic('Médor', 'chien', 4, "",""),
            'felix' => new Pandemic('Félix', 'chat', 8, "",""),
            'denver' => new Pandemic('Denver', 'dinosaure', 300, "",""),
        );
    }

    public function read($id) {
        if(key_exists($id, $this->pandemicsTab)){
            return $this->pandemicsTab[$id];
        }
        return null;
    }

    public function readAll() {
        return $this->pandemicsTab;
    }

    public function create($a){
        $id = uniqid();
        $this->pandemicsTab[$id] = $a;
        return $id;
    }

    public function exists($id){
        return key_exists($id, $this->pandemicsTab);
    }

    public function update($id, $a){
        if($this->exists($id)){
            $this->pandemicsTab[$id] = $a;
        }
    }

    public function delete($id){
        if($this->exists($id)){
            unset($id);
        }
    }
} 

?>