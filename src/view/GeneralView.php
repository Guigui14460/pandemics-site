<?php

require_once("view/AbstractView.php");

class GeneralView extends AbstractView
{
    public function __construct($router)
    {
        parent::__construct($router, "skull.php");
    }

    public function homePage()
    {
        $this->title = "";

        $this->content = "<h1>Bienvenue sur notre site Pandémonium !</h1><img src='./images/covid.png' alt=\"Image de virus\"/><p style=\"text-align: center;\">Venez voir notre <a href=\"{$this->router->getSimpleURL("pandemics_list")}\">liste de maladies</a>.</p>";
    }

    public function aboutPage()
    {
        $this->title = "A propos";

        $this->content = "<h1>{$this->title}</h1><h2>Le projet</h2>";
        $this->content .= "<p>Le but de ce site est de gérer des objets en PHP (ici des épidemies) et de créer un site respectant le modèle MVCR vu en cours et en TP.<br> Nous avons intégré les fonctionnalités suivantes :</p>";
        $this->content .= "<ul><li>Architecture MVCR</li><li>Manipulation de données</li><li>Système d'authentification</li><li>Manipulation de bases de données</li><li>Scindage des fichiers</li>";
        $this->content .= "<li>Compléments :<ul><li>Site responsive</li><li>Recherche d'objets</li><li>Gestion par un admin des comptes utilisateurs</li></ul></li>";
        $this->content .= "</ul>";

        $this->content .= "<h2>Composition du groupe N°20</h2><ul>";
        $this->content .= "<li>21806332 Arthur BOCAGE</li>";
        $this->content .= "<li>21804030 Guillaume LETELLIER</li>";
        $this->content .= "<li>21803752 Corentin PIERRE</li>";
        $this->content .= "<li>21701890 Alexandre PIGNARD</li></ul>";

        $this->content .= "<h2>Répartition des tâches</h2><p>Nous avons repris la base MVCR de Guillaume car la sienne fonctionnait mieux que celle des autres membres.</p><ul>";
        $this->content .= "<li>Arthur : <ul><li>CSS + site responsive</li><li>Partie du modèle</li><li>Page \"A propos\"</li><li>Adaptation de la base MVCR en se conformant au thème du site (PHP et SQL)</li></ul></li>";
        $this->content .= "<li>Guillaume : <ul><li>CSS + site responsive</li><li>Partie du modèle</li><li>Page \"A propos\"</li><li>Gestion des permissions sur les vues et URL</li><li>Gestion par un admin des comptes utilisateurs</li><li>Ajout du système de redirection avec un paramètre 'next_url' dans le GET</li><li>Modification du code pour l'intégration sur les serveurs web de la FAC</li><li>Système d'authentification</li><li>Amélioration de la structure et du système d'URLs</li><li>Ajout du système pour éviter les injections de code SQL, PHP, JavaScript</li></ul></li>";
        $this->content .= "<li>Corentin : <ul><li>CSS + site responsive</li><li>Partie du modèle</li></ul></li>";
        $this->content .= "<li>Alexandre : <ul><li>Partie du modèle</li><li>Page \"A propos\"</li><li>Implémentation du système de recherche de maladies</li></ul></li>";
        $this->content .= "</ul>";

        $this->content .= "<h2>Remarques</h2>";
        $this->content .= "<h3>Principaux choix</h3>";
        $this->content .= "<p>Nous avons décidé de réaliser un site plutôt simple en matière de design car il n'y a pas beaucoup de contenu.</p>";
        $this->content .= "<p>Au niveau implémentation du code et de l'architecture MVCR, nous avons donc repris l'application que nous avions réalisé lors des TP en l'adaptant et l'améliorant. Notamment, nous avons décidé d'améliorer la structure en scindant des fichiers et proposant des classes abstraites pour y simplifier l'utilisation et permettant d'éviter la répétition de code. Les fichiers ont été découpés sous forme d'application, une pour les pandémies, une autre pour le système d'authentification et une autre pour l'administration. Ceci permettant de débugger aussi plus rapidement. Autre amélioration apportée, est la généralisation des URLs. L'organisation mise en place nous permet d'accéder à n'importe quel URL facilement avec une gestion des paramètres. L'architecture mise en place permet de rajouter facilement une nouvelle application au site existant.</p>";
        $this->content .= "<h3>Git</h3>";
        $this->content .= "<p>Nous avons donc utilisé Git pour le versioning du projet mais quelqu'uns d'entre nous possédait déjà un compte Github avec leur nom d'utilisateur. Il a été mis à la place de nos numéro étudiant sur la forge. Voici l'association entre nos nom d'utilisateur et les numéros étudiants :</p>";
        $this->content .= "<ul><li>Arthur Bocage : 21806332</li><li>Guigui14460 : 21804030</li><li>Corentin Pierre : 21803752</li><li>myrani : 21701890</li></ul>";
    }
}
