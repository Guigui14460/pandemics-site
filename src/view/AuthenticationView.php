<?php

require_once("AuthenticationRouter.php");
require_once("model/User.php");
require_once("view/AbstractView.php");

class AuthenticationView extends AbstractView
{
    public function __construct($router)
    {
        parent::__construct($router, "skull.php");
    }

    public function makeLoginPage($builder, $next_url)
    {
        $this->title = "Connexion";

        $this->content = '<h1>Connectez-vous !</h1><form action="' . $this->router->getSimpleURL("accounts_login") . ($next_url !== null ? '?next=' . $next_url : "") . '" method="POST">' . "\n";
        $this->content .= "<p><label>Nom d'utilisateur : <input type=\"text\" name=\"{$builder->getUsernameRef()}\" value=\"";
        $this->content .= $builder->getData($builder->getUsernameRef());
        $this->content .= "\" autofocus />";
        $err = $builder->getError($builder->getUsernameRef());
        if ($err !== null)
            $this->content .= ' <span class="error">' . $err . '</span>';
        $this->content .= "</label></p>";
        $this->content .= "<p><label>Mot de passe : <input type=\"password\" name=\"{$builder->getPasswordRef()}\" value=\"";
        $this->content .= $builder->getData($builder->getPasswordRef());
        $this->content .= "\" />";
        $err = $builder->getError($builder->getPasswordRef());
        if ($err !== null)
            $this->content .= ' <span class="error">' . $err . '</span>';
        $this->content .= "</label></p>";
        $this->content .= "<button>Se connecter</button>";
        $this->content .= "</form>";
    }

    public function displayLoginSuccess($next_url)
    {
        $this->router->POSTredirect(($next_url !== null ? $_SERVER['SCRIPT_NAME'] . $next_url : $this->router->getSimpleURL("home")), "Connexion réussie !");
    }

    public function displayLoginFailure($next_url)
    {
        $this->router->POSTredirect(($next_url !== null ? $_SERVER['SCRIPT_NAME'] . $next_url : $this->router->getSimpleURL("accounts_login")), "Vous n'avez pas pu vous connecté !");
    }

    public function makeRegisterPage($builder, $next_url)
    {
        $this->title = "Inscription";

        $this->content = '<h1>Créer son compte !</h1><form action="' . $this->router->getSimpleURL("accounts_signup") . ($next_url !== null ? '?next=' . $next_url : "") . '" method="POST">' . "\n";
        $this->content .= "<p><label>Nom d'utilisateur : <input type=\"text\" name=\"{$builder->getUsernameRef()}\" value=\"";
        $this->content .= $builder->getData($builder->getUsernameRef());
        $this->content .= "\" autofocus />";
        $err = $builder->getError($builder->getUsernameRef());
        if ($err !== null)
            $this->content .= ' <span class="error">' . $err . '</span>';
        $this->content .= "</label></p>";
        $this->content .= "<p><label>Mot de passe : <input type=\"password\" name=\"{$builder->getPasswordRef()}\" value=\"";
        $this->content .= $builder->getData($builder->getPasswordRef());
        $this->content .= "\" />";
        $err = $builder->getError($builder->getPasswordRef());
        if ($err !== null)
            $this->content .= ' <span class="error">' . $err . '</span>';
        $this->content .= "</label></p>";
        $this->content .= "<button>S'enregistrer</button>";
        $this->content .= "</form>";
    }

    public function displayRegisterSuccess($next_url)
    {
        $this->router->POSTredirect(($next_url !== null ? $_SERVER['SCRIPT_NAME'] . $next_url : $this->router->getSimpleURL("home")), "Inscription réussie !");
    }

    public function displayRegisterFailure($next_url)
    {
        $this->router->POSTredirect(($next_url !== null ? $_SERVER['SCRIPT_NAME'] . $next_url : $this->router->getSimpleURL("accounts_signup")), "Vous n'avez pas pu vous inscrire !");
    }

    public function makeLogoutPage($user)
    {
        $this->title = "Déconnexion";

        $this->content = "<h1>{$this->title}</h1><p>{$user->getUsername()}, êtes-vous sûr de vouloir vous déconnecter ?<p>";
        $this->content .= "<form action=\"{$this->router->getSimpleURL("accounts_logout")}\" method=\"POST\"><button>Oui</button>&nbsp;<a href=\"{$_SERVER['HTTP_REFERER']}\">Annuler</a></form>";
    }

    public function displayLogoutSuccess()
    {
        $this->router->POSTredirect($this->router->getSimpleURL("home"), "Déconnexion réussie !");
    }
}
