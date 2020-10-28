<?php

require_once("Pandemic.php");

interface PandemicStorage {
    public function read($id);
    public function readAll();
    public function create($a);
    public function exists($id);
    public function update($id, $a);
    public function delete($id);
}

?>