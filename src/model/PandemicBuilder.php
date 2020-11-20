<?php

require_once("model/AbstractObjectBuilder.php");

class PandemicBuilder extends AbstractObjectBuilder {
    private static $NAME_REF = "name", $TYPE_REF = "type", $DISCOVERY_YEAR_REF = "discoveryYear", $DESCRIPTION_REF = "description",$CREATOR_REF = "creator";
    public function __construct($data=null){
        if($data === null){
            $data = array(
                self::$NAME_REF => "",
                self::$TYPE_REF => "",
                self::$DISCOVERY_YEAR_REF => -1,
                self::$DESCRIPTION_REF => "",
                self::$CREATOR_REF => "",
            );
        }
        $data[self::$DISCOVERY_YEAR_REF] = intval($data[self::$DISCOVERY_YEAR_REF]);
        parent::__construct($data);
    }
    
    public static function buildFromPandemic($pandemic){
        return new PandemicBuilder(array(
            self::$NAME_REF => $pandemic->getName(),
            self::$TYPE_REF => $pandemic->getType(),
            self::$DISCOVERY_YEAR_REF => $pandemic->getDiscoveryYear(),
            self::$DESCRIPTION_REF => $pandemic->getDescription(),
            self::$CREATOR_REF => $pandemic->getCreator(),
        ));
    }

    public function createPandemic(){
        if(!key_exists($this->getNameRef(), $this->data) || !key_exists($this->getTypeRef(), $this->data) || !key_exists($this->getDiscoveryYearRef(), $this->data) || !key_exists($this->getDescriptionRef(), $this->data) || !key_exists($this->getCreatorRef(), $this->data))
            throw new Exception("Missing fields for Pandemic creation");
        if(!$this->isValid()){
            throw new Exception("Some fields are invalid for Pandemic creation");
        }
        return new Pandemic($this->data[$this->getNameRef()], $this->data[$this->getTypeRef()], intval($this->data[$this->getDiscoveryYearRef()]), $this->data[$this->getDescriptionRef()] , $this->data[$this->getCreatorRef()] );
    }

    public function updatePandemic($pandemic){
        if(key_exists($this->getNameRef(), $this->data)){
            $pandemic->setName($this->data[$this->getNameRef()]);
        }
        if(key_exists($this->getTypeRef(), $this->data)){
            $pandemic->setType($this->data[$this->getTypeRef()]);
        }
        if(key_exists($this->getDiscoveryYearRef(), $this->data)){
            $pandemic->setDiscoveryYear($this->data[$this->getDiscoveryYearRef()]);
        }
        if(key_exists($this->getDescriptionRef(), $this->data)){
            $pandemic->setDescription($this->data[$this->getDescriptionRef()]);
        }
    }

    public function isValid(){
        $this->error = array();
		if(!key_exists($this->getNameRef(), $this->data) || $this->data[$this->getNameRef()] === null || $this->data[$this->getNameRef()] === "")
			$this->error[$this->getNameRef()] = "Vous devez entrer un nom";
        if(!key_exists($this->getTypeRef(), $this->data) || $this->data[$this->getTypeRef()] === null || $this->data[$this->getTypeRef()] === "")
            $this->error[$this->getTypeRef()] = "Vous devez entrer un type de maladie";
        if(!key_exists($this->getDiscoveryYearRef(), $this->data) || $this->data[$this->getDiscoveryYearRef()] === null || $this->data[$this->getDiscoveryYearRef()] < 0)
            $this->error[$this->getDiscoveryYearRef()] = "Vous devez entrer une date d'apparution";
        if(!key_exists($this->getDescriptionRef(), $this->data) || $this->data[$this->getDescriptionRef()] === null || $this->data[$this->getDescriptionRef()] === "")
            $this->error[$this->getDescriptionRef()] = "Vous devez entrer une description";
		return count($this->error) === 0;
    }

	public function getNameRef() {
		return self::$NAME_REF;
	}

	public function getTypeRef() {
		return self::$TYPE_REF;
	}

	public function getDiscoveryYearRef() {
		return self::$DISCOVERY_YEAR_REF;
    }
    
    public function getDescriptionRef() {
		return self::$DESCRIPTION_REF;
    }
    
    public function getCreatorRef() {
		return self::$CREATOR_REF;
	}
}

?>