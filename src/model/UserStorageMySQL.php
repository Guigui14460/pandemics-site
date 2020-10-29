<?php

require_once("model/Storage.php");
require_once("model/User.php");

class UserStorageMySQL implements Storage {
    private $database;

    public function __construct($pdo){
        $this->database = $pdo;
    }

    public function read($object_username) {
        $request = 'SELECT * FROM users WHERE username='.$object_username;
        $stmt = $this->database->prepare($request);
        $stmt->execute();
        $fetched_data = $stmt->fetch();
        if($fetched_data){
            return new User($fetched_data['username'], $fetched_data['password'], boolval($fetched_data['admin']));
        }
        return null;
    }

    public function readAll() {
        $request = 'SELECT username, password FROM users';
        $stmt = $this->database->prepare($request);
        $stmt->execute();
        $fetched_data = $stmt->fetchAll();
        $data = array();
        foreach ($fetched_data as $key => $value) {
            $data[$value['id']] = new User($value['username'], $value['password'], boolval($value['admin']));
        }
        return $data;
    }

    public function create($object){
        $request = "INSERT INTO users (username, password, admin) VALUES (?,?,?)";
        $this->database->prepare($request)->execute([$object->getUsername(), $object->getPassword(), ($object->isAdmin() ? '1' : '0')]);
        return $this->database->lastInsertId();
    }

    public function exists($object_id){
        $request = 'SELECT * FROM users WHERE id='.$object_id;
        $stmt = $this->database->prepare($request);
        $stmt->execute();
        $fetched_data = $stmt->fetch();
        return $fetched_data !== null;
    }

    public function existsByUsername($object_username){
        $request = 'SELECT * FROM users WHERE username='.$object_username;
        $stmt = $this->database->prepare($request);
        $stmt->execute();
        $fetched_data = $stmt->fetch();
        return $fetched_data !== null;
    }

    public function update($object_id, $object){
        $request = "UPDATE users SET username=?, password=?, admin=? WHERE id=?";
        $this->database->prepare($request)->execute([$object->getUsername(), $object->getPassword(), $object->isAdmin(), $object_id]);
    }

    public function delete($object_id){
        $request = "DELETE FROM users WHERE id=?";
        $this->database->prepare($request)->execute([$object_id]);
    }
}

?>