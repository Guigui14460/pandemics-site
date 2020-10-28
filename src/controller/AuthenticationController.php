<?php

class AuthenticationController {
    private $view, $storage;

    public function __construct($view, $storage){
        $this->view = $view;
        $this->storage = $storage;
    }

    public function getAllUsername(){
        return array();
    }
}

?>