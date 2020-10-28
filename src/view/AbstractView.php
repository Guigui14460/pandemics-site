<?php

abstract class AbstractView {
    protected $title, $content, $router;
    protected $include_file_name;

    public function __construct($router, $include_file_name){
        $this->router = $router;
        $this->include_file_name = $include_file_name;
    }

    public function render(){
        $title = $this->title;
        $content = $this->content;
        $this->abstractRender();
        include($this->include_file_name);
    }

    public abstract function abstractRender();

    public function show500(){
        set_status_header('500');
        $this->title = "Erreur serveur (code 500)";
        $this->content = "<p>Une erreur est survenu avec le serveur. Veuillez réesaayer l'action effectuée.</p>";
    }

    public function show404(){
        set_status_header('404');
        $this->title = "Page non trouvée (code 404)";
        $this->content = "<p>La page que vous recherchez n'existe pas ou plus.</p>";
    }

    public function showDebugPage($variable){
        $this->title = 'Debug';
        $this->content = "<pre>".htmlspecialchars(var_export($variable, true))."</pre>";
    }
    
    public static function htmlesc($str) {
		return htmlspecialchars($str,
			/* on échappe guillemets _et_ apostrophes : */
			ENT_QUOTES
			/* les séquences UTF-8 invalides sont
			* remplacées par le caractère �
			* au lieu de renvoyer la chaîne vide…) */
			| ENT_SUBSTITUTE
			/* on utilise les entités HTML5 (en particulier &apos;) */
			| ENT_HTML5,
			'UTF-8');
	}
}

?>