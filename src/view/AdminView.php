<?php

require_once("Utils.php");
require_once("view/AbstractView.php");

class AdminView extends AbstractView
{
    public function __construct($router)
    {
        parent::__construct($router, "skull.php");
    }

    public function showIndex()
    {
        $this->title = "";

        $this->content = "<h1>Bienvenue sur la partie Administration !</h1>";
        $this->content .= "<p style=\"text-align: center;\">Allez voir la <a href=\"{$this->router->getSimpleURL("admin_user_list")}\">nos utilisateurs</a>.</p>";
    }

    public function makeListPage($users)
    {
        $this->title = "Liste des utilisateurs";
        $list = "";
        foreach ($users as $key => $value) {
            $list .= "<li><a href=\"{$this->router->getConfigurableURL("admin_user_detail", array("id" =>$key))}\">" . Utils::htmlesc($value->getUsername()) . "</a></li>";
        }
        $this->content = "<h1>Liste des utilisateurs</h1><div class=\"buttons\"><a class=\"button info\" href=\"{$this->router->getSimpleURL("admin_user_create")}\">Ajouter un utilisateur</a></div><ul class=\"list\">$list</ul>";
    }

    public function makeUserPage($user, $id)
    {
        $this->title = "Page sur " . Utils::htmlesc($user->getUsername());
        $this->content = "<h1>" . Utils::htmlesc($user->getUsername()) . "</h1><article><p>" . Utils::htmlesc($user->getUsername()) . " est un utilisateur qui a le statut \"" . Utils::htmlesc($user->getStatus()) . "\".</p></article>";
        $this->content .= "<div class=\"buttons\"><a class=\"button info\" href=\"{$this->router->getConfigurableURL("admin_user_update", array("id" =>$id))}\">Modifier l'utilisateur</a><a class=\"button danger\" href=\"{$this->router->getConfigurableURL("admin_user_delete", array("id" =>$id))}\">Supprimer l'utilisateur</a></div>";
    }

    public function displayUnknownUser()
    {
        $this->router->POSTredirect($this->router->getSimpleURL("admin_user_list"), "L'utilisateur de la requête n'existe pas dans notre base de données !", "info");
    }

    public function makeUserCreationPage($builder)
    {
        $this->title = "Ajouter un nouvel utilisateur";

        $s = '<h1>Ajouter un utilisateur</h1>
        <form action="' . $this->router->getSimpleURL("admin_user_create") . '" method="POST">' . "\n";

        $s .= "<p><label>Nom d'utilisateur : <input  type=\"text\" name=\"" . $builder->getUsernameRef() . '" value="';
        $s .= Utils::htmlesc($builder->getData($builder->getUsernameRef()));
        $s .= "\" />";
        $err = $builder->getError($builder->getUsernameRef());
        if ($err !== null) {
            $s .= '<span class="error">' . $err . '</span>';
        }
        $s .= "</label></p>\n";

        $s .= '<p><label>Mot de passe : <input type="password" name="' . $builder->getPasswordRef() . '" value="';
        $s .= Utils::htmlesc($builder->getData($builder->getPasswordRef()));
        $s .= "\" />";
        $err = $builder->getError($builder->getPasswordRef());
        if ($err !== null) {
            $s .= '<span class="error">' . $err . '</span>';
        }
        $s .= "</label></p>\n";

        $s .= '<p><label>Statut : <input type=\"text\" name="' . $builder->getStatusRef() . '" value="';
        $s .= Utils::htmlesc($builder->getData($builder->getStatusRef()));
        $s .= "\" />";
        $err = $builder->getError($builder->getStatusRef());
        if ($err !== null) {
            $s .= '<span class="error">' . $err . '</span>';
        }
        $s .= "</label></p>\n";

        $s .= "<button class=\"button info\" type=\"submit\" onclick=\"divide()\">Soumettre le formulaire</button>\n</form>\n";
        $this->content = $s;
    }

    public function displayCreationUserSuccess($id)
    {
        $this->router->POSTredirect($this->router->getConfigurableURL("admin_user_detail", array('id' => $id)), "L'utilisateur a été ajouté avec succès !", "success");
    }

    public function displayCreationUserFailure()
    {
        $this->router->POSTredirect($this->router->getSimpleURL("admin_user_create"), "L'utilisateur n'a pas pu être ajouté !", "error");
    }

    public function makeUserUpdatePage($builder, $id)
    {
        $this->title = "Modifier un utilisateur";
        $s = '<h1>Modifier un utilisateur</h1><form action="' . $this->router->getConfigurableURL("admin_user_update", array("id" => $id)) . '" method="POST">' . "\n";

        $s .= "<input type=\"hidden\" name=\"user_id\" value=\"$id\"  />";
        $s .= "<p><label>Nom d'utilisateur : <input  type=\"text\" name=\"" . $builder->getUsernameRef() . '" value="';
        $s .= Utils::htmlesc($builder->getData($builder->getUsernameRef()));
        $s .= "\" />";
        $err = $builder->getError($builder->getUsernameRef());
        if ($err !== null) {
            $s .= '<span class="error">' . $err . '</span>';
        }
        $s .= "</label></p>\n";

        $s .= '<p><label>Mot de passe : <input type="password" name="' . $builder->getPasswordRef() . '" value="';
        $s .= Utils::htmlesc($builder->getData($builder->getPasswordRef()));
        $s .= "\" />";
        $err = $builder->getError($builder->getPasswordRef());
        if ($err !== null) {
            $s .= '<span class="error">' . $err . '</span>';
        }
        $s .= "</label></p>\n";

        $s .= '<p><label>Statut : <input type=\"text\" name="' . $builder->getStatusRef() . '" value="';
        $s .= Utils::htmlesc($builder->getData($builder->getStatusRef()));
        $s .= "\" />";
        $err = $builder->getError($builder->getStatusRef());
        if ($err !== null) {
            $s .= '<span class="error">' . $err . '</span>';
        }
        $s .= "</label></p>\n";

        $s .= "<button class=\"button success\" type=\"submit\">Soumettre le formulaire</button><a class=\"button\" href=\"{$this->router->getConfigurableURL("admin_user_detail", array("id" =>$id))}\">Annuler</a>\n</form>\n";
        $this->content = $s;
    }

    public function displayUpdateUserSuccess($id)
    {
        $this->router->POSTredirect($this->router->getConfigurableURL("admin_user_detail", array('id' => $id)), "L'utilisateur a été modifié avec succès !", "success");
    }

    public function displayUpdateUserFailure($id)
    {
        $this->router->POSTredirect($this->router->getConfigurableURL("admin_user_update", array('id' => $id)), "L'utilisateur n'a pas pu être modifié !", "error");
    }

    public function makeUserDeletionPage($user, $id)
    {
        $this->title = "Suppression de {$user->getUsername()}";

        $this->content = "<h1>{$this->title}</h1><p>Êtes-vous sûr de vouloir supprimer cet utilisateur ainsi que tous les objets qu'il a pu créé ?<br>
        <form class=\"no-border\" action=\"{$this->router->getConfigurableURL("admin_user_delete", array("id" =>$id))}\" method=\"POST\"><input type=\"hidden\" name=\"user_id\" value=\"$id\"/><button class=\"button danger\">Oui</button><a class=\"button\" href=\"{$this->router->getConfigurableURL("admin_user_detail", array("id" =>$id))}\">Annuler</a></form></p>";
    }

    public function displayDeletionUserSuccess()
    {
        $this->router->POSTredirect($this->router->getSimpleURL("admin_user_list"), "L'utilisateur a été supprimé avec succès !", "success");
    }

    public function displayDeletionUserFailure($id)
    {
        $this->router->POSTredirect($this->router->getConfigurableURL("admin_user_delete", array('id' => $id)), "L'utilisateur n'a pas pu être supprimé !", "error");
    }

    public function getMenu()
    {
        $menu = array(
            "Accueil admin" => $this->router->getSimpleURL("admin_index"),
            "Nouvel utilisateur" => $this->router->getSimpleURL("admin_user_create"),
            "Utilisateurs" => $this->router->getSimpleURL("admin_user_list"),
            "Déconnexion" => $this->router->getSimpleURL("accounts_logout"),
        );
        foreach ($this->navLinksToRemove as $key) {
            if (isset($menu[$key])) {
                unset($menu[$key]);
            }
        }
        return $menu;
    }
}
