<?php

require_once("lib/ObjectFileDB.php");
require_once("model/Pandemic.php");
require_once("model/Storage.php");

class PandemicStorageFile implements Storage {
    private $db;

    public function __construct($file){
        $this->db = new ObjectFileDB($file);
    }

    public function read($id) {
        if($this->db->exists($id)){
            return $this->db->fetch($id);
        }
        return null;
    }

    public function readAll() {
        return $this->db->fetchAll();
    }

    public function reinit(){
        $this->db->insert(new Pandemic('Médor', 'chien', 4, ""));
        $this->db->insert(new Pandemic('Félix', 'chat', 8, ""));
        $this->db->insert(new Pandemic('Denver', 'dinosaure', 300, ""));
    }

    public function exists($id){
        return $this->db->exists($id);
    }

    public function create($a){
        return $this->db->insert($a);
    }

    public function update($id, $a){
        return $this->db->update($id, $a);
    }

    public function delete($id){
        return $this->db->delete($id);
    }
}

?>
