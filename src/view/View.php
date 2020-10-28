<?php

require_once("model/AnimalBuilder.php");
require_once("model/Animal.php");
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

    public function makeAnimalPage($animal, $id){
        $this->title = "Page sur {$animal->getName()}";
        $this->content = "<p>{$animal->getName()} est un animal de l'espèce {$animal->getSpecies()} âgé de {$animal->getAge()} ans.</p><a href=\"{$this->router->getAnimalUpdateURL($id)}\">Modifier animal</a>&nbsp;&nbsp;<a href=\"{$this->router->getAnimalDeletionURL($id)}\">Supprimer animal</a>";
    }

    public function makeUnknownAnimalPage(){
        $this->title = "Animal inconnu";
        $this->content = "<p style=\"color: red; font-weight: bold;\">L'animal de la requête n'existe pas dans notre base de données !</p>";
    }

    public function makeListPage($animals){
        $this->title = "Liste des animaux";
        $list = "";
        foreach($animals as $key => $value){
            $list .= "<li><a href=\"{$this->router->getAnimalURL($key)}\">{$value->getName()}</a></li>";
        }
        $this->content = "<ul>$list</ul>";
    }

    public function makeAnimalCreationPage($builder){
        $this->title = "Ajouter votre animal";
        $s = '<form action="'.$this->router->getAnimalCreationURL().'" method="POST">'."\n";

		$s .= '<p><label>Nom de l\'animal: <input type="text" name="'.$builder->getNameRef().'" value="';
		$s .= self::htmlesc($builder->getData($builder->getNameRef()));
		$s .= "\" />";
		$err = $builder->getErrors($builder->getNameRef());
		if ($err !== null)
			$s .= ' <span class="error">'.$err.'</span>';
		$s .="</label></p>\n";

		$s .= '<p><label>Espèce de l\'animal: <input type="text" name="'.$builder->getSpeciesRef().'" value="';
		$s .= self::htmlesc($builder->getData($builder->getSpeciesRef()));
		$s .= "\" />";
		$err = $builder->getErrors($builder->getSpeciesRef());
		if ($err !== null)
			$s .= ' <span class="error">'.$err.'</span>';
		$s .="</label></p>\n";

		$s .= '<p><label>Âge de l\'animal: <input type="number" name="'.$builder->getAgeRef().'" value="';
		$s .= self::htmlesc($builder->getData($builder->getAgeRef()));
		$s .= "\" />";
		$err = $builder->getErrors($builder->getAgeRef());
		if ($err !== null)
			$s .= ' <span class="error">'.$err.'</span>';
		$s .="</label></p>\n";

        $s .= "<button type=\"submit\">Soumettre le formulaire</button>\n</form>\n";
        $this->content = $s;
    }

    public function makeAnimalDeletionPage($animal, $id){
        $this->title = "Suppression de {$animal->getName()}";
        $this->content = "<p>Êtes-vous sûr de vouloir supprimer cet animal ?<br>
        <form action=\"{$this->router->getAnimalDeletionURL($id)}\" method=\"POST\"><input type=\"hidden\" name=\"animal_id\" value=\"$id\"  /><button>Oui</button></form>&nbsp<a href=\"{$this->router->getAnimalURL($id)}\">Annuler</a></p>";
    }


    public function makeAnimalUpdatePage($builder, $id){
        $this->title = "Modifier votre animal";
        $s = '<form action="'.$this->router->getAnimalUpdateURL($id).'" method="POST">'."\n";

        $s .= "<input type=\"hidden\" name=\"animal_id\" value=\"$id\"  />";
		$s .= '<p><label>Nom de l\'animal: <input type="text" name="'.$builder->getNameRef().'" value="';
		$s .= self::htmlesc($builder->getData($builder->getNameRef()));
		$s .= "\" />";
		$err = $builder->getErrors($builder->getNameRef());
		if ($err !== null)
			$s .= ' <span class="error">'.$err.'</span>';
		$s .="</label></p>\n";

		$s .= '<p><label>Espèce de l\'animal: <input type="text" name="'.$builder->getSpeciesRef().'" value="';
		$s .= self::htmlesc($builder->getData($builder->getSpeciesRef()));
		$s .= "\" />";
		$err = $builder->getErrors($builder->getSpeciesRef());
		if ($err !== null)
			$s .= ' <span class="error">'.$err.'</span>';
		$s .="</label></p>\n";

		$s .= '<p><label>Âge de l\'animal: <input type="number" name="'.$builder->getAgeRef().'" value="';
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
			"Animaux" => $this->router->getAnimalListURL(),
			"Nouvel animal" => $this->router->getAnimalCreationURL(),
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