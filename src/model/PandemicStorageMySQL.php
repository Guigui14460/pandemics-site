<?php

require_once("model/Storage.php");

class PandemicStorageMySQL implements Storage {
    private $database;

    public function __construct($pdo){
        $this->database = $pdo;
    }

    public function read($object_id) {
        $request = 'SELECT * FROM pandemics WHERE id='.$object_id;
        $stmt = $this->database->prepare($request);
        $stmt->execute();
        $fetched_data = $stmt->fetch();
        if($fetched_data){
            return new Pandemic($fetched_data['name'], $fetched_data['type'], intval($fetched_data['discoveryYear']), $fetched_data['description'] , $fetched_data['creator']);
        }
        return null;
    }

    public function readAll() {
        $request = 'SELECT * FROM pandemics';
        $stmt = $this->database->prepare($request);
        $stmt->execute();
        $fetched_data = $stmt->fetchAll();
        $data = array();
        foreach ($fetched_data as $key => $value) {
            $data[$value['id']] = new Pandemic($value['name'], $value['type'], intval($value['discoveryYear']), $value['description'],$value['creator']);
        }
        return $data;
    }

    public function create($object){
        $request = "INSERT INTO pandemics (name, type, discoveryYear, description , creator ) VALUES (?,?,?,?,?)";
        $this->database->prepare($request)->execute([$object->getName(), $object->getType(), $object->getDiscoveryYear(), $object->getDescription(),$object->getCreator()  ]);
        return $this->database->lastInsertId();
    }

    public function exists($object_id){
        $request = 'SELECT * FROM pandemics WHERE id='.$object_id;
        $stmt = $this->database->prepare($request)->execute();
        $fetched_data = $stmt->fetch();
        return $fetched_data !== null;
    }

    public function update($object_id, $object){
        $request = "UPDATE pandemics SET name=?, type=?, discoveryYear=?, description=? , creator=? WHERE id=?";
        $this->database->prepare($request)->execute([$object->getName(), $object->getType(), $object->getDiscoveryYear(), $object->getDescription(),$object->getCreator(), $object_id]);
    }

    public function delete($object_id){
        $request = "DELETE FROM pandemics WHERE id=?";
        $this->database->prepare($request)->execute([$object_id]);
    }
}

?>