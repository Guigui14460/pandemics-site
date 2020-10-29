<?php

abstract class AbstractObjectBuilder {
    protected $data, $error;

    public function __construct($data){
        $this->data = $data;
        $this->error = array();
    }

    public abstract function isValid();

    public function getData($ref){
        return key_exists($ref, $this->data) ? $this->data[$ref] : '';
    }

    public function getError($ref){
        return key_exists($ref, $this->error) ? $this->error[$ref] : '';
    }
}

?>