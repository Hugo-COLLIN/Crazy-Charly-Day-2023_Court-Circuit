<?php

namespace iutnc\ccd\render;

use iutnc\ccd\db\Commande;

class ListeCommandesRenderer
{
    static function render()
    {
        $res = "";
        $res .= "<div class=\"commandes\">";
        $res .= "<h1>Liste des commandes</h1>";
        $res .= Commande::afficherListe();
        $res .= "</div>";
        return $res;
    }
}