<?php

require_once("Utils.php");
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
        $this->content .= Utils::htmlesc($builder->getData($builder->getUsernameRef()));
        $this->content .= "\" autofocus />";
        $err = $builder->getError($builder->getUsernameRef());
        if ($err !== null) {
            $this->content .= '<span class="error">' . $err . '</span>';
        }
        $this->content .= "</label></p>";

        $this->content .= "<p><label>Mot de passe : <input type=\"password\" name=\"{$builder->getPasswordRef()}\" value=\"";
        $this->content .= Utils::htmlesc($builder->getData($builder->getPasswordRef()));
        $this->content .= "\" />";
        $err = $builder->getError($builder->getPasswordRef());
        if ($err !== null) {
            $this->content .= '<span class="error">' . $err . '</span>';
        }
        $this->content .= "</label></p>";

        $this->content .= "<button class=\"button info\">Se connecter</button>";
        $this->content .= "</form>";
        $this->content .= "<p>Pas encore de compte, inscris-toi <a href=\"" . $this->router->getSimpleURL("accounts_signup") . ($next_url !== null ? '?next=' . $next_url : "") . "\">ici</a> !</p>";
    }

    public function displayLoginSuccess($next_url)
    {
        $this->router->POSTredirect(($next_url !== null ? $_SERVER['SCRIPT_NAME'] . $next_url : $this->router->getSimpleURL("home")), "Connexion réussie !", "success");
    }

    public function displayLoginFailure($next_url)
    {
        $this->router->POSTredirect(($next_url !== null ? $_SERVER['SCRIPT_NAME'] . $next_url : $this->router->getSimpleURL("accounts_login")), "Vous n'avez pas pu vous connecté !", "error");
    }

    public function makeRegisterPage($builder, $next_url)
    {
        $this->title = "Inscription";

        $this->content = '<h1>Créer son compte !</h1><form action="' . $this->router->getSimpleURL("accounts_signup") . ($next_url !== null ? '?next=' . $next_url : "") . '" method="POST">' . "\n";
        $this->content .= "<p><label>Nom d'utilisateur : <input type=\"text\" name=\"{$builder->getUsernameRef()}\" value=\"";
        $this->content .= Utils::htmlesc($builder->getData($builder->getUsernameRef()));
        $this->content .= "\" autofocus />";
        $err = $builder->getError($builder->getUsernameRef());
        if ($err !== null) {
            $this->content .= '<span class="error">' . $err . '</span>';
        }
        $this->content .= "</label></p>";

        $this->content .= "<p><label>Mot de passe : <input type=\"password\" name=\"{$builder->getPasswordRef()}\" value=\"";
        $this->content .= Utils::htmlesc($builder->getData($builder->getPasswordRef()));
        $this->content .= "\" />";
        $err = $builder->getError($builder->getPasswordRef());
        if ($err !== null) {
            $this->content .= '<span class="error">' . $err . '</span>';
        }
        $this->content .= "</label></p>";

        $this->content .= "<button class=\"button success\">S'inscrire</button>";
        $this->content .= "</form>";
        $this->content .= "<p>Déjà un compte, connectes-toi <a href=\"" . $this->router->getSimpleURL("accounts_login") . ($next_url !== null ? '?next=' . $next_url : "") . "\">ici</a> !</p>";
    }

    public function displayRegisterSuccess($next_url)
    {
        $this->router->POSTredirect(($next_url !== null ? $_SERVER['SCRIPT_NAME'] . $next_url : $this->router->getSimpleURL("home")), "Inscription réussie !", "success");
    }

    public function displayRegisterFailure($next_url)
    {
        $this->router->POSTredirect(($next_url !== null ? $_SERVER['SCRIPT_NAME'] . $next_url : $this->router->getSimpleURL("accounts_signup")), "Vous n'avez pas pu vous inscrire !", "error");
    }

    public function makeLogoutPage($user)
    {
        $this->title = "Déconnexion";

        $this->content = "<h1>{$this->title}</h1><p>" . Utils::htmlesc($user->getUsername()) . ", êtes-vous sûr de vouloir vous déconnecter ?<p>";
        $this->content .= "<form class=\"no-border\" action=\"{$this->router->getSimpleURL("accounts_logout")}\" method=\"POST\"><input type=\"hidden\" name=\"oui\" value=\"oui\"><button class=\"button danger\">Oui</button>&nbsp;";
        $this->content .= "<a class=\"button\" href=\"" . (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $this->router->getSimpleURL("home")) . "\">Non</a></form>";
    }

    public function displayLogoutSuccess()
    {
        $this->router->POSTredirect($this->router->getSimpleURL("home"), "Déconnexion réussie !", "success");
    }
}
