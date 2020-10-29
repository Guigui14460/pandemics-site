<?php

class Database {
    private $storages;

    public function __construct(){
        $this->storages = array();
    }

    public function addStorage($key, $storage){
        $this->storages[$key] = $storage;
    }

    public function getStorage($key){
        return $this->storages[$key];
    }
}

?>