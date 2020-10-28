<?php

require_once("Animal.php");

interface AnimalStorage {
    public function read($id);
    public function readAll();
    public function create($a);
    public function exists($id);
    public function update($id, $a);
    public function delete($id);
}

?>