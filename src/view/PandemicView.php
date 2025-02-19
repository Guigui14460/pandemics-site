<?php

require_once("Utils.php");
require_once("view/AbstractView.php");

class PandemicView extends AbstractView
{
	public function __construct($router)
	{
		parent::__construct($router, "skull.php");
	}

	public function makeListPage($pandemics, $no_found = False)
	{
		$this->title = "Liste des maladies";
		$list = "";
		foreach ($pandemics as $key => $value) {
			$list .= "<li><a href=\"{$this->router->getConfigurableURL("pandemics_detail", array("id" =>$key))}\">" . Utils::htmlesc($value->getName()) . "</a></li>";
		}

		$this->content = "<h1>Liste des maladies</h1><div class=\"buttons\"><a class=\"button\" href=\"{$this->router->getSimpleURL("pandemics_create")}\">Ajouter la vôtre</a></div>";
		$this->content .= "<form class=\"no-border\" action={$this->router->getSimpleURL("pandemics_list")} method=\"POST\" >";
		$this->content .= "<input type=\"text\" id=\"search\" name=\"search\" placeholder=\"Rechercher une maladie\">";
		$this->content .= "<button class=\"button info\" type=\"submit\">Recherche</button>";
		$this->content .= "</form>";
		if ($no_found) {
			$this->content .= "<p style=\"text-align:center;\">Nous n'avons pas trouvé de maladies liées à votre recherche</p>";
		} else {
			$this->content .= "<ul class=\"list\">$list</ul>";
		}
	}

	public function makePandemicPage($pandemic, $id, $has_permission)
	{
		$this->title = "Page sur " . Utils::htmlesc($pandemic->getName());
		$this->content = "<h1>" . Utils::htmlesc($pandemic->getName()) . "</h1><article><p>" . Utils::htmlesc($pandemic->getName()) . " est une maladie du type " . Utils::htmlesc($pandemic->getType()) . "</p><p>Les premiers signes de son apparition sont vers l'an {$pandemic->getDiscoveryYear()}.</p><p>Information sur la maladie :<br>" . Utils::htmlesc($pandemic->getDescription()) . "</p><p>Information rentrée par : {$pandemic->getCreator()}</p></article>";
		$this->content .= "<div class=\"buttons\">";
		if ($has_permission) {
			$this->content .= "<a class=\"button info\" href=\"{$this->router->getConfigurableURL("pandemics_update", array("id" =>$id))}\">Modifier la maladie</a><a class=\"button danger\" href=\"{$this->router->getConfigurableURL("pandemics_delete", array("id" =>$id))}\">Supprimer la maladie</a><br>";
		}
		$this->content .= "<a class=\"button\" href=\"{$this->router->getSimpleURL("pandemics_list")}\">Retourner à la liste des maladies</a></div>";
	}

	public function displayUnknownPandemic()
	{
		$this->router->POSTredirect($this->router->getSimpleURL("pandemics_list"), "La maladie de la requête n'existe pas dans notre base de données !", "info");
	}

	public function makePandemicCreationPage($builder)
	{
		$this->title = "Ajouter votre maladie";

		$s = '<h1>Ajouter des maladies</h1>
        <form action="' . $this->router->getSimpleURL("pandemics_create") . '" method="POST">' . "\n";

		$s .= '<p><label>Nom de la maladie : <input  type="text" name="' . $builder->getNameRef() . '" value="';
		$s .= Utils::htmlesc($builder->getData($builder->getNameRef()));
		$s .= "\" />";
		$err = $builder->getError($builder->getNameRef());
		if ($err !== null) {
			$s .= '<span class="error">' . $err . '</span>';
		}
		$s .= "</label></p>\n";

		$s .= '<p><label>Type de la maladie : <input type="text" name="' . $builder->getTypeRef() . '" value="';
		$s .= Utils::htmlesc($builder->getData($builder->getTypeRef()));
		$s .= "\" />";
		$err = $builder->getError($builder->getTypeRef());
		if ($err !== null) {
			$s .= '<span class="error">' . $err . '</span>';
		}
		$s .= "</label></p>\n";

		$s .= '<p><label>Date d\'apparution de la maladie : <input type="number" name="' . $builder->getDiscoveryYearRef() . '" value="';
		$s .= Utils::htmlesc($builder->getData($builder->getDiscoveryYearRef()));
		$s .= "\" />";
		$err = $builder->getError($builder->getDiscoveryYearRef());
		if ($err !== null) {
			$s .= '<span class="error">' . $err . '</span>';
		}
		$s .= "</label></p>\n";

		$s .= '<p><label>Description :<br><textarea id="text" name="' . $builder->getDescriptionRef() . '">';
		$s .= Utils::htmlesc($builder->getData($builder->getDescriptionRef()));
		$s .= "</textarea>";
		$err = $builder->getError($builder->getDescriptionRef());
		if ($err !== null) {
			$s .= '<span class="error">' . $err . '</span>';
		}
		$s .= "</label></p>\n";

		$s .= "<button class=\"button info\" type=\"submit\" onclick=\"divide()\">Soumettre le formulaire</button>\n</form>\n";
		$this->content = $s;
	}

	public function displayCreationPandemicSuccess($id)
	{
		$this->router->POSTredirect($this->router->getConfigurableURL("pandemics_detail", array('id' => $id)), "La pandémie a été ajoutée avec succès !", "success");
	}

	public function displayCreationPandemicFailure()
	{
		$this->router->POSTredirect($this->router->getSimpleURL("pandemics_create"), "La pandémie n'a pas pu être ajoutée !", "error");
	}

	public function makePandemicUpdatePage($builder, $id)
	{
		$this->title = "Modifier votre maladie";
		$s = '<h1>Modifier votre maladie</h1><form action="' . $this->router->getConfigurableURL("pandemics_update", array("id" => $id)) . '" method="POST">' . "\n";

		$s .= "<input type=\"hidden\" name=\"pandemic_id\" value=\"$id\"  />";
		$s .= '<p><label>Nom de la maladie : <input type="text" name="' . $builder->getNameRef() . '" value="';
		$s .= Utils::htmlesc($builder->getData($builder->getNameRef()));
		$s .= "\" />";
		$err = $builder->getError($builder->getNameRef());
		if ($err !== null) {
			$s .= '<span class="error">' . $err . '</span>';
		}
		$s .= "</label></p>\n";

		$s .= '<p><label>Type de la maladie : <input type="text" name="' . $builder->getTypeRef() . '" value="';
		$s .= Utils::htmlesc($builder->getData($builder->getTypeRef()));
		$s .= "\" />";
		$err = $builder->getError($builder->getTypeRef());
		if ($err !== null) {
			$s .= '<span class="error">' . $err . '</span>';
		}
		$s .= "</label></p>\n";

		$s .= '<p><label>Date d\'apparution de la maladie : <input type="number" name="' . $builder->getDiscoveryYearRef() . '" value="';
		$s .= Utils::htmlesc($builder->getData($builder->getDiscoveryYearRef()));
		$s .= "\" />";
		$err = $builder->getError($builder->getDiscoveryYearRef());
		if ($err !== null) {
			$s .= '<span class="error">' . $err . '</span>';
		}
		$s .= "</label></p>\n";

		$s .= '<p><label>Description :<br><textarea name="' . $builder->getDescriptionRef() . '">';
		$s .= Utils::htmlesc($builder->getData($builder->getDescriptionRef()));
		$s .= "</textarea>";
		$err = $builder->getError($builder->getDescriptionRef());
		if ($err !== null) {
			$s .= '<span class="error">' . $err . '</span>';
		}
		$s .= "</label></p>\n";

		$s .= "<button class=\"button success\" type=\"submit\">Soumettre le formulaire</button><a class=\"button\" href=\"{$this->router->getConfigurableURL("pandemics_detail", array("id" =>$id))}\">Annuler</a>\n</form>\n";
		$this->content = $s;
	}

	public function displayUpdatePandemicSuccess($id)
	{
		$this->router->POSTredirect($this->router->getConfigurableURL("pandemics_detail", array('id' => $id)), "La pandémie a été modifiée avec succès !", "success");
	}

	public function displayUpdatePandemicFailure($id)
	{
		$this->router->POSTredirect($this->router->getConfigurableURL("pandemics_update", array('id' => $id)), "La pandémie n'a pas pu être modifiée !", "error");
	}

	public function makePandemicDeletionPage($pandemic, $id)
	{
		$this->title = "Suppression de " . Utils::htmlesc($pandemic->getName());

		$this->content = "<h1>{$this->title}</h1><p>Êtes-vous sûr de vouloir supprimer cette maladie ?<br>
        <form class=\"no-border\" action=\"{$this->router->getConfigurableURL("pandemics_delete", array("id" =>$id))}\" method=\"POST\"><input type=\"hidden\" name=\"pandemic_id\" value=\"$id\"/><button class=\"button danger\">Oui</button><a class=\"button\" href=\"{$this->router->getConfigurableURL("pandemics_detail", array("id" =>$id))}\">Annuler</a></form></p>";
	}

	public function displayDeletionPandemicSuccess()
	{
		$this->router->POSTredirect($this->router->getSimpleURL("pandemics_list"), "La pandémie a été supprimée avec succès !", "success");
	}

	public function displayDeletionPandemicFailure($id)
	{
		$this->router->POSTredirect($this->router->getConfigurableURL("pandemics_delete", array('id' => $id)), "La pandémie n'a pas pu être supprimée !", "error");
	}
}
