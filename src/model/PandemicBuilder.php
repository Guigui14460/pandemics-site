<?php

require_once("model/AbstractObjectBuilder.php");

class PandemicBuilder extends AbstractObjectBuilder {
    private static $NAME_REF = "name", $SPECIES_REF = "species", $AGE_REF = "age";

    public function __construct($data=null){
        if($data === null){
            $data = array(
                $this->getNameRef() => "",
                $this->getSpeciesRef() => "",
                $this->getAgeRef() => -1,
            );
        }
        parent::__construct($data);
    }
    
    public static function buildFromPandemic($Pandemic){
        return new PandemicBuilder(array(
            self::$NAME_REF => $Pandemic->getName(),
            self::$SPECIES_REF => $Pandemic->getSpecies(),
            self::$AGE_REF => $Pandemic->getAge(),
        ));
    }

    public function createPandemic(){
        if(!key_exists($this->getNameRef(), $this->data) || !key_exists($this->getSpeciesRef(), $this->data) || !key_exists($this->getAgeRef(), $this->data))
            throw new Exception("Missing fields for Pandemic creation");
        if(!$this->isValid()){
            throw new Exception("Some fields are invalid for Pandemic creation");
        }
        return new Pandemic($this->data[$this->getNameRef()], $this->data[$this->getSpeciesRef()], intval($this->data[$this->getAgeRef()]));
    }

    public function updatePandemic($Pandemic){
        if(key_exists($this->getNameRef(), $this->data)){
            $Pandemic->setName($this->data[$this->getNameRef()]);
        }
        if(key_exists($this->getSpeciesRef(), $this->data)){
            $Pandemic->setSpecies($this->data[$this->getSpeciesRef()]);
        }
        if(key_exists($this->getAgeRef(), $this->data)){
            $Pandemic->setAge($this->data[$this->getAgeRef()]);
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