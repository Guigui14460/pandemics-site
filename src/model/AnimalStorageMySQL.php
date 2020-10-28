<?php

require_once("AnimalStorage.php");

class AnimalStorageMySQL implements AnimalStorage {
    private $database;

    public function __construct($pdo){
        $this->database = $pdo;
    }

    public function read($id) {
        $request = 'SELECT * FROM animals WHERE id='.$id;
        $stmt = $this->database->prepare($request);
        $stmt->execute();
        $fetched_data = $stmt->fetch();
        if($fetched_data){
            return new Animal($fetched_data['name'], $fetched_data['species'], $fetched_data['age']);
        }
        return null;
    }

    public function readAll() {
        $request = 'SELECT * FROM animals';
        $stmt = $this->database->prepare($request);
        $stmt->execute();
        $fetched_data = $stmt->fetchAll();
        $data = array();
        foreach ($fetched_data as $key => $value) {
            $data[$value['id']] = new Animal($value['name'], $value['species'], $value['age']);
        }
        return $data;
    }

    public function create($a){
        $request = "INSERT INTO animals (name, species, age) VALUES (?,?,?)";
        $stmt = $this->database->prepare($request)->execute([$a->getName(), $a->getSpecies(), $a->getAge()]);
        return $this->database->lastInsertId();
    }

    public function exists($id){
        $request = 'SELECT * FROM animals WHERE id='.$id;
        $stmt = $this->database->prepare($request)->execute();
        $fetched_data = $stmt->fetch();
        return $fetched_data !== null;
    }

    public function update($id, $a){
        $request = "UPDATE animals SET name=?, species=?, age=? WHERE id=?";
        $stmt = $this->database->prepare($request)->execute([$a->getName(), $a->getSpecies(), $a->getAge(), $id]);
    }

    public function delete($id){
        $request = "DELETE FROM animals WHERE id=?";
        $stmt = $this->database->prepare($request)->execute([$id]);
    }
}

?>