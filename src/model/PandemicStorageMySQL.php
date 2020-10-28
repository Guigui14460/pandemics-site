<?php

require_once("PandemicStorage.php");

class PandemicStorageMySQL implements PandemicStorage {
    private $database;

    public function __construct($pdo){
        $this->database = $pdo;
    }

    public function read($id) {
        $request = 'SELECT * FROM Pandemics WHERE id='.$id;
        $stmt = $this->database->prepare($request);
        $stmt->execute();
        $fetched_data = $stmt->fetch();
        if($fetched_data){
            return new Pandemic($fetched_data['name'], $fetched_data['species'], $fetched_data['age']);
        }
        return null;
    }

    public function readAll() {
        $request = 'SELECT * FROM Pandemics';
        $stmt = $this->database->prepare($request);
        $stmt->execute();
        $fetched_data = $stmt->fetchAll();
        $data = array();
        foreach ($fetched_data as $key => $value) {
            $data[$value['id']] = new Pandemic($value['name'], $value['species'], $value['age']);
        }
        return $data;
    }

    public function create($a){
        $request = "INSERT INTO Pandemics (name, species, age) VALUES (?,?,?)";
        $stmt = $this->database->prepare($request)->execute([$a->getName(), $a->getSpecies(), $a->getAge()]);
        return $this->database->lastInsertId();
    }

    public function exists($id){
        $request = 'SELECT * FROM Pandemics WHERE id='.$id;
        $stmt = $this->database->prepare($request)->execute();
        $fetched_data = $stmt->fetch();
        return $fetched_data !== null;
    }

    public function update($id, $a){
        $request = "UPDATE Pandemics SET name=?, species=?, age=? WHERE id=?";
        $stmt = $this->database->prepare($request)->execute([$a->getName(), $a->getSpecies(), $a->getAge(), $id]);
    }

    public function delete($id){
        $request = "DELETE FROM Pandemics WHERE id=?";
        $stmt = $this->database->prepare($request)->execute([$id]);
    }
}

?>