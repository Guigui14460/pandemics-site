<?php

require_once("AnimalStorage.php");

class AnimalStorageMySQL implements AnimalStorage {
    private PDO $database;

    public function __construct(PDO $pdo){
        $this->database = $pdo;
    }

    public function read(string $id) {
        $request = 'SELECT * FROM animals WHERE id='.$id;
        $stmt = $this->database->prepare($request);
        $stmt->execute();
        $fetched_data = $stmt->fetch();
        if($fetched_data){
            return new Animal($fetched_data['name'], $fetched_data['species'], $fetched_data['age']);
        }
        return null;
    }

    public function readAll() : array {
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

    public function create(Animal $a){
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

    public function update(string $id, Animal $a){
        $request = "UPDATE animals SET name=?, species=?, age=? WHERE id=?";
        $stmt = $this->database->prepare($request)->execute([$a->getName(), $a->getSpecies(), $a->getAge(), $id]);
    }

    public function delete(string $id){
        $request = "DELETE FROM animals WHERE id=?";
        $stmt = $this->database->prepare($request)->execute([$id]);
    }
}

?>