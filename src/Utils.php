<?php

class Utils {
    public static function htmlesc($str)
    {
        return htmlentities(
            $str,
            /* on échappe guillemets _et_ apostrophes : */
            ENT_QUOTES
                /* les séquences UTF-8 invalides sont
        	* remplacées par le caractère �
        	* au lieu de renvoyer la chaîne vide…) */
                | ENT_SUBSTITUTE
                /* on utilise les entités HTML5 (en particulier &apos;) */
                | ENT_HTML5,
            'UTF-8'
        );
    }
}
