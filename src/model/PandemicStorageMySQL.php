<?php

require_once("model/Storage.php");

class PandemicStorageMySQL implements Storage
{
    private $database;

    public function __construct($pdo)
    {
        $this->database = $pdo;
    }

    public function read($object_id)
    {
        $request = "SELECT * FROM pandemics WHERE id=:id";
        $stmt = $this->database->prepare($request);
        $stmt->execute(array(":id" => intval($object_id)));
        $fetched_data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($fetched_data) {
            return new Pandemic($fetched_data['name'], $fetched_data['type'], intval($fetched_data['discoveryYear']), $fetched_data['description'], $fetched_data['creator']);
        }
        return null;
    }

    public function readAll()
    {
        $request = 'SELECT * FROM pandemics';
        $stmt = $this->database->prepare($request);
        $stmt->execute();
        $fetched_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $data = array();
        foreach ($fetched_data as $key => $value) {
            $data[$value['id']] = new Pandemic($value['name'], $value['type'], intval($value['discoveryYear']), $value['description'], $value['creator']);
        }
        return $data;
    }

    public function create($object)
    {
        $request = "INSERT INTO pandemics (name, type, discoveryYear, description, creator) VALUES (:name,:type,:discoveryYear,:description,:creator)";
        $stmt = $this->database->prepare($request);
        $stmt->bindValue(":name", $object->getName(), PDO::PARAM_STR);
        $stmt->bindValue(":type", $object->getType(), PDO::PARAM_STR);
        $stmt->bindValue(":description", $object->getDescription(), PDO::PARAM_STR);
        $stmt->bindValue(":discoveryYear", $object->getDiscoveryYear(), PDO::PARAM_INT);
        $stmt->bindValue(":creator", $object->getCreator(), PDO::PARAM_STR);
        $stmt->execute();
        return $this->database->lastInsertId();
    }

    public function exists($object_id)
    {
        $request = "SELECT * FROM pandemics WHERE id=:id";
        $stmt = $this->database->prepare($request)->execute();
        $stmt->bindValue(":id", $object_id, PDO::PARAM_INT);
        $fetched_data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $fetched_data !== null;
    }

    public function update($object_id, $object)
    {
        $request = "UPDATE pandemics SET name=:name, type=:type, discoveryYear=:discoveryYear, description=:description, creator=:creator WHERE id=:id";
        $stmt = $this->database->prepare($request);
        $stmt->bindValue(":name", $object->getName(), PDO::PARAM_STR);
        $stmt->bindValue(":type", $object->getType(), PDO::PARAM_STR);
        $stmt->bindValue(":description", $object->getDescription(), PDO::PARAM_STR);
        $stmt->bindValue(":discoveryYear", $object->getDiscoveryYear(), PDO::PARAM_INT);
        $stmt->bindValue(":creator", $object->getCreator(), PDO::PARAM_STR);
        $stmt->bindValue(":id", $object_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete($object_id)
    {
        $request = "DELETE FROM pandemics WHERE id=:id";
        $stmt = $this->database->prepare($request);
        $stmt->bindValue(":id", $object_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
