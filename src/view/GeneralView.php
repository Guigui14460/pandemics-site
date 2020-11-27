<?php

require_once("view/AbstractView.php");

class GeneralView extends AbstractView {
    public function __construct($router){
        parent::__construct($router, "skull.php");
    }

    public function homePage(){
        $this->title = "";
       
        $this->content = "<h1>Bienvenue sur notre site Pandémonium !</h1><img src='./images/covid.png'/>";
     
        
       
    }

    public function aboutPage(){
        $this->title = "A propos";
       
        $this->content = "<h1>{$this->title}</h1><h2>Le projet</h2>";
        $this->content .= "<p>21804030 Guillaume LETELLIER<br>";
        $this->content .= "21803752 Corentin PIERRE<br>";
        $this->content .= "21806332 Arthur BOCAGE<br>";
        $this->content .= "21701890 Alexandre PIGNARD</p>";
        

        $this->content .= "<h2>Remarque</h2>";
        $this->content .= "<p>L'utilisation de l'URL ne marche pas sous l'hébergement de la fac (marche sur toutes nos machines)</p>";
      
    }
}

?>