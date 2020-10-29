<?php

abstract class AbstractRouter {
    protected $app_name, $urls, $view, $main_router;

    public function __construct($app_name, $view, $main_router=null){
        $this->app_name = $app_name;
        $this->view = $view;
        $this->main_router = $main_router;
        $this->urls = array();
        $this->createURLs();
    }

    private function getURLParameters($url){
        $matches = array();
        preg_match_all("/<([A-Za-z0-9]+)>/", $url, $matches, PREG_OFFSET_CAPTURE);
        
        $parameters = array();
        for($i = 0; $i < count($matches[0]); $i++){ // on itère toutes les occurences trouvées
            $parameters[$matches[1][$i][0]] = array(
                "start" => $matches[0][$i][1], // l'index de début
                "end" => $matches[0][$i][1] + strlen($matches[1][$i][0]) + 1, // l'index de fin (+1 pour inclure le >)
                "length" => strlen($matches[1][$i][0]) + 2,
            );
        }
        return $parameters;
    }

    public abstract function createURLs();

    public abstract function main($db, $path_exploded);

    public function getConfigurableURL($name, $parameters){
        $url = $this->urls[$name];
        $url_parameters = $this->getURLParameters($url);
        foreach ($url_parameters as $key => $value) {
            if(!key_exists($key, $parameters)){
                throw Exception("invalid url parameters");
            }
            $url = substr_replace($url, $parameters[$key], $url_parameters[$key]["start"], $url_parameters[$key]["length"]);
        }
        return $url;
    }

    public function getSimpleURL($name){
        return $this->urls[$name];
    }

    public function getAppName(){
        return $this->app_name;
    }

    public function getURLs(){
        return $this->urls;
    }

    public function getView(){
        return $this->view;
    }

    public function getMainRouter(){
        return $this->main_router;
    }
}

?>