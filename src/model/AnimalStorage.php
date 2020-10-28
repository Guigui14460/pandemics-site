<?php

require_once("Animal.php");

interface AnimalStorage {
    public function read(string $id);
    public function readAll() : array;
    public function create(Animal $a);
    public function exists($id);
    public function update(string $id, Animal $a);
    public function delete(string $id);
}

?>