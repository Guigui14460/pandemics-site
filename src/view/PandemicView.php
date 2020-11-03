<?php

require_once("PandemicRouter.php");
require_once("model/Pandemic.php");
require_once("model/PandemicBuilder.php");
require_once("view/AbstractView.php");

class PandemicView extends AbstractView {
    public function __construct($router){
        parent::__construct($router, "skull.php");
    }

    public function abstractRender(){
    }

    public function makeListPage($pandemics){
        $this->title = "Liste des maladies";
        $this->css = "./css/ListPage.css";
        $list = "";
        foreach($pandemics as $key => $value){
            $list .= "<li><a href=\"{$this->router->getConfigurableURL("pandemic_detail", array("id" => $key))}\">{$value->getName()}</a></li>";
        }
        $this->content = "<h1>Liste des maladies</h1><ul>$list</ul>";
    }

    public function makePandemicPage($pandemic, $id){
        $this->title = "Page sur {$pandemic->getName()}";
        $this->css = "./../css/ListPage.css";
        $this->content = "<p>{$pandemic->getName()} est une maladie du type {$pandemic->getSpecies()} dont l'existence remonte à {$pandemic->getAge()} ans. Plus d'information ? En voici : {$pandemic->getText()}</p><a href=\"{$this->router->getConfigurableURL("pandemic_update", array("id" => $id))}\">Modifier Pandemic</a>&nbsp;&nbsp;<a href=\"{$this->router->getConfigurableURL("pandemic_delete", array("id" => $id))}\">Supprimer Pandemic</a>";
    }

    public function makeUnknownPandemicPage(){
        $this->title = "Maladie inconnue";
        $this->content = "<p style=\"color: red; font-weight: bold;\">La maladie de la requête n'existe pas dans notre base de données !</p>";
    }

    public function makePandemicCreationPage($builder){
        $this->title = "Ajouter votre maladie";
        $this->css = "./../css/AjoutPage.css";
        $s = '<h1>Ajouter des maladies</h1>
        <form action="'.$this->router->getSimpleURL("pandemic_create").'" method="POST">'."\n";

		$s .= '<p><label>Nom de la maladie: <input type="text" name="'.$builder->getNameRef().'" value="';
		$s .= self::htmlesc($builder->getData($builder->getNameRef()));
		$s .= "\" />";
		$err = $builder->getError($builder->getNameRef());
		if ($err !== null)
			$s .= ' <span class="error">'.$err.'</span>';
		$s .="</label></p>\n";

		$s .= '<p><label>Type de la maladie: <input type="text" name="'.$builder->getSpeciesRef().'" value="';
		$s .= self::htmlesc($builder->getData($builder->getSpeciesRef()));
		$s .= "\" />";
		$err = $builder->getError($builder->getSpeciesRef());
		if ($err !== null)
			$s .= ' <span class="error">'.$err.'</span>';
		$s .="</label></p>\n";

		$s .= '<p><label>Date de la maladie: <input type="number" name="'.$builder->getAgeRef().'" value="';
		$s .= self::htmlesc($builder->getData($builder->getAgeRef()));
		$s .= "\" />";
		$err = $builder->getError($builder->getAgeRef());
		if ($err !== null)
			$s .= ' <span class="error">'.$err.'</span>';
        $s .="</label></p>\n";
        
        $s .= '<p><label>Un petit paragraphe pour nous en dire plus ? <input type="text" name="'.$builder->getTextRef().'" value="';
		$s .= self::htmlesc($builder->getData($builder->getTextRef()));
		$s .= "\" />";
		$err = $builder->getError($builder->getTextRef());
		if ($err !== null)
			$s .= ' <span class="error">'.$err.'</span>';
		$s .="</label></p>\n";

        $s .= "<button type=\"submit\">Soumettre le formulaire</button>\n</form>\n";
        $this->content = $s;
    }
    
    public function makePandemicUpdatePage($builder, $id){
        $this->title = "Modifier votre maladie";
        $this->css = "./../../css/AjoutPage.css";
        $s = '<form action="'.$this->router->getConfigurableURL("pandemic_update", array("id" => $id)).'" method="POST">'."\n";

        $s .= "<input type=\"hidden\" name=\"pandemic_id\" value=\"$id\"  />";
		$s .= '<p><label>Nom de l\'Pandemic: <input type="text" name="'.$builder->getNameRef().'" value="';
		$s .= self::htmlesc($builder->getData($builder->getNameRef()));
		$s .= "\" />";
		$err = $builder->getError($builder->getNameRef());
		if ($err !== null)
			$s .= ' <span class="error">'.$err.'</span>';
        $s .="</label></p>\n";
        

		$s .= '<p><label>Type de la maladie: <input type="text" name="'.$builder->getSpeciesRef().'" value="';
		$s .= self::htmlesc($builder->getData($builder->getSpeciesRef()));
		$s .= "\" />";
		$err = $builder->getError($builder->getSpeciesRef());
		if ($err !== null)
			$s .= ' <span class="error">'.$err.'</span>';
		$s .="</label></p>\n";

		$s .= '<p><label>Âge de la maladie: <input type="number" name="'.$builder->getAgeRef().'" value="';
		$s .= self::htmlesc($builder->getData($builder->getAgeRef()));
		$s .= "\" />";
		$err = $builder->getError($builder->getAgeRef());
		if ($err !== null)
			$s .= ' <span class="error">'.$err.'</span>';
        $s .="</label></p>\n";
        
        $s .= '<p><label>Un petit paragraphe ? <input type="text" name="'.$builder->getTextRef().'" value="';
		$s .= self::htmlesc($builder->getData($builder->getTextRef()));
		$s .= "\" />";
		$err = $builder->getError($builder->getTextRef());
		if ($err !== null)
			$s .= ' <span class="error">'.$err.'</span>';
		$s .="</label></p>\n";

        $s .= "<button type=\"submit\">Soumettre le formulaire</button>\n</form>\n";
        $this->content = $s;
    }

    public function makePandemicDeletionPage($pandemic, $id){
        $this->title = "Suppression de {$pandemic->getName()}";
        $this->css = "./../../css/AjoutPage.css";
        $this->content = "<p>Êtes-vous sûr de vouloir supprimer cette maladie ?<br>
        <form action=\"{$this->router->getConfigurableURL("pandemic_delete", array("id" => $id))}\" method=\"POST\"><input type=\"hidden\" name=\"pandemic_id\" value=\"$id\"  /><button>Oui</button></form>&nbsp<a href=\"{$this->router->getConfigurableURL("pandemic_detail", array("id" => $id))}\">Annuler</a></p>";
    }
}

?>