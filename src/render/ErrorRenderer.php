<?php

namespace iutnc\ccd\render;

class ErrorRenderer
{
    static function render()
    {
        $res = "<h4>On s'est égaré ? Retournons à l'accueil</h4>";
        $res .= "<a href=\"index.php\">Retour à l'accueil</a>";

        return $res;
    }
}