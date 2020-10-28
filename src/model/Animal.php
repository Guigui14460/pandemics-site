<?php

class Animal {
    private $name;
    private $species;
    private $age;

    public function __construct($name, $species, $age){
        $this->setName($name);
        $this->setSpecies($species);
        $this->setAge($age);
    }

    public function getName(){
        return $this->name;
    }

    public function getSpecies(){
        return $this->species;
    }

    public function getAge(){
        return $this->age;
    }

    public function setName($name){
        if(!self::isNameValid($name)){
            throw new Exception("Invalid name");
        }
        $this->name = $name;
    }

    public function setSpecies($species){
        if(!self::isSpeciesValid($species)){
            throw new Exception("Invalid species");
        }
        $this->species = $species;
    }

    public function setAge($age){
        if(!self::isAgeValid($age)){
            throw new Exception("Invalid age");
        }
        $this->age = $age;
    }

    public static function isNameValid($name){
        return $name !== "";
    }

    public static function isSpeciesValid($species){
        return $species !== "";
    }

    public static function isAgeValid($age){
        return $age >= 0;
    }
}

?>