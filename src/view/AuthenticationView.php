<?php

require_once("AuthenticationRouter.php");
require_once("model/User.php");
require_once("view/AbstractView.php");

class AuthenticationView extends AbstractView {
    public function __construct($router){
        parent::__construct($router, "skull.php");
    }

    public function abstractRender(){}

    public function makeLoginPage($builder){
        $this->title = "Connectez-vous !";
        $this->content = '<form action="'.$this->router->getSimpleURL("accounts_login").'" method="POST">'."\n";
        $this->content .= "<p><label>Nom d'utilisateur : <input type=\"text\" name=\"{$builder->getUsernameRef()}\" value=\"";
        $this->content .= self::htmlesc($builder->getData($builder->getUsernameRef()));
		$this->content .= "\" autofocus />";
		$err = $builder->getError($builder->getUsernameRef());
		if ($err !== null)
			$this->content .= ' <span class="error">'.$err.'</span>';
		$this->content .="</label></p>";
        $this->content .= "<p><label>Mot de passe : <input type=\"password\" name=\"{$builder->getPasswordRef()}\" value=\"";
        $this->content .= self::htmlesc($builder->getData($builder->getPasswordRef()));
		$this->content .= "\" />";
		$err = $builder->getError($builder->getPasswordRef());
		if ($err !== null)
			$this->content .= ' <span class="error">'.$err.'</span>';
		$this->content .="</label></p>";
        $this->content .= "<button>Se connecter</button>";
        $this->content .= "</form>";
    }

    public function makeRegisterPage($builder){
        $this->title = "Créer son compte !";
        $this->content = '<form action="'.$this->router->getSimpleURL("accounts_signup").'" method="POST">'."\n";
        $this->content .= "<p><label>Nom d'utilisateur : <input type=\"text\" name=\"{$builder->getUsernameRef()}\" value=\"";
        $this->content .= self::htmlesc($builder->getData($builder->getUsernameRef()));
		$this->content .= "\" autofocus />";
		$err = $builder->getError($builder->getUsernameRef());
		if ($err !== null)
			$this->content .= ' <span class="error">'.$err.'</span>';
		$this->content .="</label></p>";
        $this->content .= "<p><label>Mot de passe : <input type=\"password\" name=\"{$builder->getPasswordRef()}\" value=\"";
        $this->content .= self::htmlesc($builder->getData($builder->getPasswordRef()));
		$this->content .= "\" />";
		$err = $builder->getError($builder->getPasswordRef());
		if ($err !== null)
			$this->content .= ' <span class="error">'.$err.'</span>';
		$this->content .="</label></p>";
        $this->content .= "<button>S'enregistrer</button>";
        $this->content .= "</form>";
    }

    public function makeLogoutPage($user){
        $this->title = "Déconnexion";
        $this->content = "<p>{$user->getUsername()}, êtes-vous sûr de vouloir vous déconnecter ?<p>";
        $this->content .= "<form action=\"{$this->router->getSimpleURL("accounts_logout")}\" method=\"POST\"><button>Oui</button>&nbsp;<a href=\"{$_SERVER['HTTP_REFERER']}\">Annuler</a></form>";
    }
}

?>