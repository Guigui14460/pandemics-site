<?php

class Pandemic {
    private $name;
    private $species;
    private $age;
    private $text;

    public function __construct($name, $species, $age, $text){
        $this->setName($name);
        $this->setSpecies($species);
        $this->setAge($age);
        $this->setText($text);
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

    public function getText(){
        return $this->text;
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

    public function setText($text){
        if(!self::isNameValid($text)){
            throw new Exception("Invalid name");
        }
        $this->text = $text;
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

    public static function isTextValid($text){
        return $text !== "";
    }
}

?>