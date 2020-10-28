<?php

require_once("AnimalStorage.php");
require_once("Animal.php");
require_once("lib/ObjectFileDB.php");

class AnimalStorageFile implements AnimalStorage {
    private ObjectFileDB $db;

    public function __construct($file){
        $this->db = new ObjectFileDB($file);
    }

    public function read(string $id) {
        if($this->db->exists($id)){
            return $this->db->fetch($id);
        }
        return null;
    }

    public function readAll() : array {
        return $this->db->fetchAll();
    }

    public function reinit(){
        $this->db->insert(new Animal('Médor', 'chien', 4));
        $this->db->insert(new Animal('Félix', 'chat', 8));
        $this->db->insert(new Animal('Denver', 'dinosaure', 300));
    }

    public function exists($id){
        return $this->db->exists($id);
    }

    public function create(Animal $a){
        return $this->db->insert($a);
    }

    public function update(string $id, Animal $a){
        return $this->db->update($id, $a);
    }

    public function delete(string $id){
        return $this->db->delete($id);
    }
}

?>
