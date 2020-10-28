<?php

require_once("model/PandemicBuilder.php");
require_once("model/Pandemic.php");
require_once("Router.php");

class View {
    private $title, $content;
    private $router;

    public function __construct($router){
        $this->router = $router;
    }

    public function render(){
        $title = $this->title;
        $content = $this->content;
        include("skull.php");
    }

    public function makeTestPage(){
        $this->title = "Page de test";
        $this->content = "<p>Ceci est <strong>un test</strong>.</p>";
    }

    public function makeHomePage(){
        $this->title = "Page d'accueil";
        $this->content = "<p style=\"color: green; font-weight: bold;\">Bienvenue sur notre site !</p>";
    }

    public function makePandemicPage($pandemic, $id){
        $this->title = "Page sur {$pandemic->getName()}";
        $this->content = "<p>{$pandemic->getName()} est une maladie du type {$pandemic->getSpecies()} dont l'existence remonte à {$pandemic->getAge()} ans.</p><a href=\"{$this->router->getPandemicUpdateURL($id)}\">Modifier Pandemic</a>&nbsp;&nbsp;<a href=\"{$this->router->getPandemicDeletionURL($id)}\">Supprimer Pandemic</a>";
    }

    public function makeUnknownPandemicPage(){
        $this->title = "Maladie inconnue";
        $this->content = "<p style=\"color: red; font-weight: bold;\">La maladie de la requête n'existe pas dans notre base de données !</p>";
    }

    public function makeListPage($pandemics){
        $this->title = "Liste des maladies";
        $list = "";
        foreach($pandemics as $key => $value){
            $list .= "<li><a href=\"{$this->router->getPandemicURL($key)}\">{$value->getName()}</a></li>";
        }
        $this->content = "<ul>$list</ul>";
    }

    public function makePandemicCreationPage($builder){
        $this->title = "Ajouter votre maladie";
        $s = '<form action="'.$this->router->getPandemicCreationURL().'" method="POST">'."\n";

		$s .= '<p><label>Nom de la maladie: <input type="text" name="'.$builder->getNameRef().'" value="';
		$s .= self::htmlesc($builder->getData($builder->getNameRef()));
		$s .= "\" />";
		$err = $builder->getErrors($builder->getNameRef());
		if ($err !== null)
			$s .= ' <span class="error">'.$err.'</span>';
		$s .="</label></p>\n";

		$s .= '<p><label>Type de la maladie: <input type="text" name="'.$builder->getSpeciesRef().'" value="';
		$s .= self::htmlesc($builder->getData($builder->getSpeciesRef()));
		$s .= "\" />";
		$err = $builder->getErrors($builder->getSpeciesRef());
		if ($err !== null)
			$s .= ' <span class="error">'.$err.'</span>';
		$s .="</label></p>\n";

		$s .= '<p><label>Date de la maladie: <input type="number" name="'.$builder->getAgeRef().'" value="';
		$s .= self::htmlesc($builder->getData($builder->getAgeRef()));
		$s .= "\" />";
		$err = $builder->getErrors($builder->getAgeRef());
		if ($err !== null)
			$s .= ' <span class="error">'.$err.'</span>';
		$s .="</label></p>\n";

        $s .= "<button type=\"submit\">Soumettre le formulaire</button>\n</form>\n";
        $this->content = $s;
    }

    public function makePandemicDeletionPage($pandemic, $id){
        $this->title = "Suppression de {$pandemic->getName()}";
        $this->content = "<p>Êtes-vous sûr de vouloir supprimer cette maladie ?<br>
        <form action=\"{$this->router->getPandemicDeletionURL($id)}\" method=\"POST\"><input type=\"hidden\" name=\"Pandemic_id\" value=\"$id\"  /><button>Oui</button></form>&nbsp<a href=\"{$this->router->getPandemicURL($id)}\">Annuler</a></p>";
    }


    public function makePandemicUpdatePage($builder, $id){
        $this->title = "Modifier votre maladie";
        $s = '<form action="'.$this->router->getPandemicUpdateURL($id).'" method="POST">'."\n";

        $s .= "<input type=\"hidden\" name=\"Pandemic_id\" value=\"$id\"  />";
		$s .= '<p><label>Nom de l\'Pandemic: <input type="text" name="'.$builder->getNameRef().'" value="';
		$s .= self::htmlesc($builder->getData($builder->getNameRef()));
		$s .= "\" />";
		$err = $builder->getErrors($builder->getNameRef());
		if ($err !== null)
			$s .= ' <span class="error">'.$err.'</span>';
		$s .="</label></p>\n";

		$s .= '<p><label>Type de la maladie: <input type="text" name="'.$builder->getSpeciesRef().'" value="';
		$s .= self::htmlesc($builder->getData($builder->getSpeciesRef()));
		$s .= "\" />";
		$err = $builder->getErrors($builder->getSpeciesRef());
		if ($err !== null)
			$s .= ' <span class="error">'.$err.'</span>';
		$s .="</label></p>\n";

		$s .= '<p><label>Âge de la maladie: <input type="number" name="'.$builder->getAgeRef().'" value="';
		$s .= self::htmlesc($builder->getData($builder->getAgeRef()));
		$s .= "\" />";
		$err = $builder->getErrors($builder->getAgeRef());
		if ($err !== null)
			$s .= ' <span class="error">'.$err.'</span>';
		$s .="</label></p>\n";

        $s .= "<button type=\"submit\">Soumettre le formulaire</button>\n</form>\n";
        $this->content = $s;
    }

    public function makeUnexpectedErrorPage(){
        $this->title = "Erreur";
        $this->content = "<p>Une erreur est survenue !</p>";
    }

    public function makeBadMethodErrorPage(){
        $this->title = "Mauvaise méthode";
        $this->content = "<p>Vous avez utilisé une mauvaise méthode !</p>";
    }

    public function makeDebugPage($variable){
        $this->title = 'Debug';
        $this->content = "<pre>".htmlspecialchars(var_export($variable, true))."</pre>";
    }

    protected function getMenu() {
		return array(
			"Accueil" => $this->router->getHomeURL(),
			"Maladies" => $this->router->getPandemicListURL(),
			"Nouvelle maladie" => $this->router->getPandemicCreationURL(),
		);
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