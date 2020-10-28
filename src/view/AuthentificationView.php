<?php

require_once("model/User.php");
require_once("AbtractView.php");
require_once("AuthenticationRouter.php");
require_once("controller/AuthenticationManager.php");

class AuthenticationView extends AbstractView {
    private $manager;

    public function __construct($router, $accounts){
        parent::__construct($router, "skull.php");
        $this->manager = new AuthenticationManager($accounts);
    }

    public function abstractRender(){   
    }

    public function loginPage($builder){
        $this->title = "Connectez-vous !";
        $this->content = '<form action="'.$this->router->getLoginURL().'" method="POST">'."\n";
        $this->content .= "<label>Nom d'utilisateur : <input type=\"text\" name=\"{$builder->getUsernameRef()}\" /></label>";
        $this->content .= "<label>Mot de passe : <input type=\"password\" name=\"{$builder->getPasswordRef()}\" /></label>";
        $this->content .= "<button>Se connecter</button>";
        $this->content .= "</form>";
    }

    public function registerPage($builder){
        $this->title = "Connectez-vous !";
        $this->content = '<form action="'.$this->router->getSignUpURL().'" method="POST">'."\n";
        $this->content .= "<label>Nom d'utilisateur : <input type=\"text\" name=\"{$builder->getUsernameRef()}\" /></label>";
        $this->content .= "<label>Mot de passe : <input type=\"password\" name=\"{$builder->getPasswordRef()}\" /></label>";
        $this->content .= "<button>S'enregistrer</button>";
        $this->content .= "</form>";
    }

    public function logoutPage($user, $id){
        $this->title = "Déconnexion de {$user->getUsername()}";
        $this->content = "<p>Êtes-vous sûr de vouloir de vous déconnecter ?<p>";
        $this->content .= "<form action=\"{$this->router->getLogoutURL()}\" method=\"POST\"><input type=\"hidden\" name=\"user_id\" value=\"$id\" /><button>Oui</button>&nbsp;<a href=\"{$_SERVER['HTTP_REFERER']}\">Annuler</a></form>";
    }
}

?>