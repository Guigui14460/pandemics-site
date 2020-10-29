<?php

interface Storage {
    public function read($object_id);
    public function readAll();
    public function create($object);
    public function exists($object_id);
    public function update($object_id, $object);
    public function delete($object_id);
}

?>