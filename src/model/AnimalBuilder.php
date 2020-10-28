<?php

class AnimalBuilder {
    private $data;
    private $error;
    private static string $NAME_REF = "name", $SPECIES_REF = "species", $AGE_REF = "age";

    public function __construct($data=null){
        if($data === null){
            $data = array(
                $this->getNameRef() => "",
                $this->getSpeciesRef() => "",
                $this->getAgeRef() => -1,
            );
        }
        $this->data = $data;
        $this->error = array();
    }

	public function getData($ref) {
		return key_exists($ref, $this->data) ? $this->data[$ref] : '';
	}

	public function getErrors($ref) {
		return key_exists($ref, $this->error) ? $this->error[$ref] : null;
    }
    
    public static function buildFromAnimal(Animal $animal){
        return new AnimalBuilder(array(
            self::$NAME_REF => $animal->getName(),
            self::$SPECIES_REF => $animal->getSpecies(),
            self::$AGE_REF => $animal->getAge(),
        ));
    }

    public function createAnimal(){
        if(!key_exists($this->getNameRef(), $this->data) || !key_exists($this->getSpeciesRef(), $this->data) || !key_exists($this->getAgeRef(), $this->data))
            throw new Exception("Missing fields for animal creation");
        if(!$this->isValid()){
            throw new Exception("Some fields are invalid for animal creation");
        }
        return new Animal($this->data[$this->getNameRef()], $this->data[$this->getSpeciesRef()], intval($this->data[$this->getAgeRef()]));
    }

    public function updateAnimal(Animal $animal){
        if(key_exists($this->getNameRef(), $this->data)){
            $animal->setName($this->data[$this->getNameRef()]);
        }
        if(key_exists($this->getSpeciesRef(), $this->data)){
            $animal->setSpecies($this->data[$this->getSpeciesRef()]);
        }
        if(key_exists($this->getAgeRef(), $this->data)){
            $animal->setAge($this->data[$this->getAgeRef()]);
        }
    }

    public function isValid(){
        $this->error = array();
		if(!key_exists($this->getNameRef(), $this->data) || $this->data[$this->getNameRef()] === null || $this->data[$this->getNameRef()] === "")
			$this->error[$this->getNameRef()] = "Vous devez entrer un nom";
        if(!key_exists($this->getSpeciesRef(), $this->data) || $this->data[$this->getSpeciesRef()] === null || $this->data[$this->getSpeciesRef()] === "")
            $this->error[$this->getSpeciesRef()] = "Vous devez entrer une espèce";
        if(!key_exists($this->getAgeRef(), $this->data) || $this->data[$this->getAgeRef()] === null || $this->data[$this->getAgeRef()] < 0)
            $this->error[$this->getAgeRef()] = "Vous devez entrer un âge positif";
		return count($this->error) === 0;
    }

	public function getNameRef() {
		return self::$NAME_REF;
	}

	public function getSpeciesRef() {
		return self::$SPECIES_REF;
	}

	public function getAgeRef() {
		return self::$AGE_REF;
	}
}

?>