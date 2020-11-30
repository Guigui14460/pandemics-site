<?php

require_once("PandemicRouter.php");
require_once("Utils.php");
require_once("model/Pandemic.php");
require_once("model/PandemicBuilder.php");
require_once("view/AbstractView.php");

class PandemicView extends AbstractView {
    public function __construct($router){
        parent::__construct($router, "skull.php");
    }

    public function makeListPage($pandemics){
        $this->title = "Liste des maladies";
        $this->css = "./../css/screen.css";
        $list = "";
        foreach($pandemics as $key => $value){
            $list .= "<a href=\"{$this->router->getConfigurableURL("pandemics_detail", array("id" => $key))}\"><li>{$value->getName()}</li></a>";
        }
        $this->content = "<h1>Liste des maladies</h1><ul class=\"list\">$list</ul>";
    }

    public function makePandemicPage($pandemic, $id, $user){
        $this->title = "Page sur {$pandemic->getName()}";
        $this->css = "./../../css/screen.css";
		$this->content = "<p>{$pandemic->getName()} est une maladie du type {$pandemic->getType()} dont l'existence remonte à {$pandemic->getDiscoveryYear()} ans. Plus d'information ? En voici : {$pandemic->getDescription()} ,  elle fut ajoutée à la base de données par {$pandemic->getCreator()} "  ;
		if($pandemic->getCreator() === $user->getUsername()){
		$this->content .= "</p><a href=\"{$this->router->getConfigurableURL("pandemics_update", array("id" => $id))}\">Modifier Pandemic</a>&nbsp;&nbsp;<a href=\"{$this->router->getConfigurableURL("pandemics_delete", array("id" => $id))}\">Supprimer Pandemic</a>";
		}
	}

    public function displayUnknownPandemic(){
		$this->router->POSTredirect($this->router->getSimpleURL("pandemics_list"), "La maladie de la requête n'existe pas dans notre base de données !");
	}

	public function makeUnknownPandemicPage()
	{
		$this->title = "Maladie inconnue";
		$this->content = "<p style=\"color: red; font-weight: bold;\">La maladie de la requête n'existe pas dans notre base de données !</p>";
	}

	public function makePandemicCreationPage($builder)
	{
		$this->title = "Ajouter votre maladie";

		$s = '<h1>Ajouter des maladies</h1>
        <form class="new" action="' . $this->router->getSimpleURL("pandemics_create") . '" method="POST">' . "\n";

		$s .= '<p><label>Nom de la maladie : <input  type="text" name="' . $builder->getNameRef() . '" value="';
		$s .= Utils::htmlesc($builder->getData($builder->getNameRef()));
		$s .= "\" />";
		$err = $builder->getError($builder->getNameRef());
		
		if ($err !== null ){  
			$this->content .= ' <span class="error">' . $err . '</span>';
		}   
		$s .= "</label></p>\n";

		$s .= '<p><label>Type de la maladie : <input type="text" name="' . $builder->getTypeRef() . '" value="';
		$s .= Utils::htmlesc($builder->getData($builder->getTypeRef()));
		$s .= "\" />";
		$err = $builder->getError($builder->getTypeRef());
		if ($err !== null ){  
			$this->content .= ' <span class="error">' . $err . '</span>';
		}   
		$s .= "</label></p>\n";

		$s .= '<p><label>Date d\'apparution de la maladie : <input type="number" name="' . $builder->getDiscoveryYearRef() . '" value="';
		$s .= $builder->getData($builder->getDiscoveryYearRef());
		$s .= "\" />";
		$err = $builder->getError($builder->getDiscoveryYearRef());
		if ($err !== null ){  
			$this->content .= ' <span class="error">' . $err . '</span>';
		}   
		$s .= "</label></p>\n";

		$s .= '<p><label>Description :<br><textarea name="' . $builder->getDescriptionRef() . '">';
		$s .= Utils::htmlesc($builder->getData($builder->getDescriptionRef()));
		$s .= "</textarea>";
		$err = $builder->getError($builder->getDescriptionRef());
		if ($err !== null ){  
			$this->content .= ' <span class="error">' . $err . '</span>';
		}   
		$s .= "</label></p>\n";

		$s .= "<button type=\"submit\">Soumettre le formulaire</button>\n</form>\n";
		$this->content = $s;
	}

	public function displayCreationPandemicSuccess($id)
	{
		$this->router->POSTredirect($this->router->getConfigurableURL("pandemics_detail", array('id' => $id)), "La pandémie a été ajoutée avec succès !");
	}

	public function displayCreationPandemicFailure()
	{
		$this->router->POSTredirect($this->router->getSimpleURL("pandemics_create"), "La pandémie n'a pas pu être ajoutée !");
	}

	public function makePandemicUpdatePage($builder, $id)
	{
		$this->title = "Modifier votre maladie";
		
		$s = '<form class="new" action="' . $this->router->getConfigurableURL("pandemics_update", array("id" => $id)) . '" method="POST">' . "\n";

		$s .= "<input type=\"hidden\" name=\"pandemic_id\" value=\"$id\"  />";
		$s .= '<p><label>Nom de la maladie : <input type="text" name="' . $builder->getNameRef() . '" value="';
		$s .= Utils::htmlesc($builder->getData($builder->getNameRef()));
		$s .= "\" />";
		$err = $builder->getError($builder->getNameRef());
		if ($err !== null ){  
			$this->content .= ' <span class="error">' . $err . '</span>';
		}   
		$s .= "</label></p>\n";


		$s .= '<p><label>Type de la maladie : <input type="text" name="' . $builder->getTypeRef() . '" value="';
		$s .= Utils::htmlesc($builder->getData($builder->getTypeRef()));
		$s .= "\" />";
		$err = $builder->getError($builder->getTypeRef());
		if ($err !== null ){  
			$this->content .= ' <span class="error">' . $err . '</span>';
		}   
		$s .= "</label></p>\n";

		$s .= '<p><label>Date d\'apparution de la maladie : <input type="number" name="' . $builder->getDiscoveryYearRef() . '" value="';
		$s .= $builder->getData($builder->getDiscoveryYearRef());
		$s .= "\" />";
		$err = $builder->getError($builder->getDiscoveryYearRef());
		if ($err !== null ){  
			$this->content .= ' <span class="error">' . $err . '</span>';
		}   
		$s .= "</label></p>\n";

		$s .= '<p><label>Description :<br><textarea name="' . $builder->getDescriptionRef() . '">';
		$s .= Utils::htmlesc($builder->getData($builder->getDescriptionRef()));
		$s .= "</textarea>";
		$err = $builder->getError($builder->getDescriptionRef());
		if ($err !== null ){  
			$this->content .= ' <span class="error">' . $err . '</span>';
		}   
		$s .= "</label></p>\n";

		$s .= "<button type=\"submit\">Soumettre le formulaire</button>\n</form>\n";
		$this->content = $s;
	}

	public function displayUpdatePandemicSuccess($id)
	{
		$this->router->POSTredirect($this->router->getConfigurableURL("pandemics_detail", array('id' => $id)), "La pandémie a été modifiée avec succès !");
	}

	public function displayUpdatePandemicFailure($id)
	{
		$this->router->POSTredirect($this->router->getConfigurableURL("pandemics_update", array('id' => $id)), "La pandémie n'a pas pu être modifiée !");
	}

	public function makePandemicDeletionPage($pandemic, $id)
	{
		$this->title = "Suppression de {$pandemic->getName()}";

		$this->content = "<h1>{$this->title}</h1><p>Êtes-vous sûr de vouloir supprimer cette maladie ?<br>
        <form action=\"{$this->router->getConfigurableURL("pandemics_delete", array("id" =>$id))}\" method=\"POST\"><input type=\"hidden\" name=\"pandemic_id\" value=\"$id\"  /><button>Oui</button></form>&nbsp<a href=\"{$this->router->getConfigurableURL("pandemics_detail", array("id" =>$id))}\">Annuler</a></p>";
	}

	public function displayDeletionPandemicSuccess()
	{
		$this->router->POSTredirect($this->router->getSimpleURL("pandemics_list"), "La pandémie a été supprimée avec succès !");
	}

	public function displayDeletionPandemicFailure($id)
	{
		$this->router->POSTredirect($this->router->getConfigurableURL("pandemics_delete", array('id' => $id)), "La pandémie n'a pas pu être supprimée !");
	}
}
