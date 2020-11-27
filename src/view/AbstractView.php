<?php

abstract class AbstractView
{
    protected $title, $content, $menu, $css,
        $router, $include_file_name, $feedback,
        $navLinksToRemove;

    public function __construct($router, $include_file_name, $feedback = "")
    {
        $this->router = $router;
        $this->include_file_name = $include_file_name;
        $this->feedback = $feedback;
        $this->navLinksToRemove = array();
        $this->css = null;
    }

    public function render()
    {
        $title = $this->title;
        $content = $this->content;
        $css = $this->css;
        $feedback = $this->feedback;
        $menu = $this->getMenu();
        include($this->include_file_name);
    }

    public function show500()
    {
        http_response_code(500);
        $this->title = "Erreur serveur";
        $this->content = "<p>Une erreur est survenu avec le serveur. Veuillez réesaayer l'action effectuée.<span class=\"error-code\">Code erreur : 500</span></p>";
    }

    public function show404()
    {
        http_response_code(404);
        $this->title = "Page non trouvée";
        $this->content = "<p>La page que vous recherchez n'existe pas ou plus.<span class=\"error-code\">Code erreur : 404</span></p>";
    }

    public function show403($msg)
    {
        http_response_code(403);
        $this->title = "Accès interdit";
        $this->content = "<p>Vous n'avez pas la permission d'accéder à cette page !<br><strong>$msg</strong><br><span class=\"error-code\">Code erreur : 403</span></p><br><a href=\"" . $_SERVER["HTTP_REFERER"] . "\">Retourner à la page précédente</a>";
    }

    public function show405()
    {
        http_response_code(405);
        $this->title = "Mauvaise méthode";
        $this->content = "<p>Vous avez utilisé une mauvaise méthode !<span class=\"error-code\">Code erreur : 405</span></p>";
    }

    public function showDebugPage($variable)
    {
        $this->title = 'Debug';
        $this->content = "<pre>" . htmlspecialchars(var_export($variable, true)) . "</pre>";
    }

    public function getMenu()
    {
        $menu = array(
            "Nouvelle maladie" => $this->router->getSimpleURL("pandemics_create"),
            "Maladies" => $this->router->getSimpleURL("pandemics_list"),
            "A propos" => $this->router->getSimpleURL("about"),
            "Connexion" => $this->router->getSimpleURL("accounts_login"),
            "S'inscrire" => $this->router->getSimpleURL("accounts_signup"),
            "Déconnexion" => $this->router->getSimpleURL("accounts_logout"),
        );
        foreach ($this->navLinksToRemove as $key) {
            if (isset($menu[$key])) {
                unset($menu[$key]);
            }
        }
        return $menu;
    }

    public function removeNavLink($key)
    {
        array_push($this->navLinksToRemove, $key);
    }

    public function setFeedback($feedback)
    {
        $this->feedback = $feedback;
    }
}
