<?php

require_once("model/Storage.php");
require_once("model/User.php");

#require_once("Storage.php");
#require_once("User.php");
class UserStorageMySQL implements Storage
{
    private $database;

    public function __construct($pdo)
    {
        $this->database = $pdo;
    }

    public function lastInsertId()
    {
        return $this->database->lastInsertId();
    }

    public function read($object_username)
    {
        $request = "SELECT * FROM users WHERE username=:username";
        $stmt = $this->database->prepare($request);
        $stmt->bindValue(":username", $object_username, PDO::PARAM_STR);
        $stmt->execute();
        $fetched_data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($fetched_data) {
            return new User($fetched_data['username'], $fetched_data['password'], $fetched_data['status']);
        }
        return null;
    }

    public function readAll()
    {
        $request = 'SELECT * FROM users';
        $stmt = $this->database->prepare($request);
        $stmt->execute();
        $fetched_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $data = array();
        foreach ($fetched_data as $key => $value) {
            $data[$value['id']] = new User($value['username'], $value['password'], $value['status']);
        }
        return $data;
    }

    public function create($object)
    {
        $request = "INSERT INTO users (username, password, status) VALUES (:username,:password,:status)";
        $stmt = $this->database->prepare($request);
        $stmt->bindValue(":username", $object->getUsername(), PDO::PARAM_STR);
        $stmt->bindValue(":password", $object->getPassword(), PDO::PARAM_STR);
        $stmt->bindValue(":status", $object->getStatus(), PDO::PARAM_STR);
        $stmt->execute();
        return $this->database->lastInsertId();
    }

    public function exists($object_id)
    {
        $request = "SELECT * FROM users WHERE id=:id";
        $stmt = $this->database->prepare($request);
        $stmt->bindValue(":id", $object_id, PDO::PARAM_INT);
        $stmt->execute();
        $fetched_data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $fetched_data !== null;
    }

    public function existsByUsername($object_username)
    {
        $request = "SELECT * FROM users WHERE username=:username";
        $stmt = $this->database->prepare($request);
        $stmt->bindValue(":username", $object_username, PDO::PARAM_STR);
        $stmt->execute();
        $fetched_data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $fetched_data !== false;
    }

    public function update($object_id, $object)
    {
        $request = "UPDATE users SET username=:username, password=:password, status=:status WHERE id=:id";
        $stmt = $this->database->prepare($request);
        $stmt->bindValue(":username", $object->getUsername(), PDO::PARAM_STR);
        $stmt->bindValue(":password", $object->getPassword(), PDO::PARAM_STR);
        $stmt->bindValue(":status", $object->getStatus(), PDO::PARAM_STR);
        $stmt->bindValue(":id", $object_id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function delete($object_id)
    {
        $request = "DELETE FROM users WHERE id=:id";
        $stmt = $this->database->prepare($request);
        $stmt->bindValue(":id", $object_id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
