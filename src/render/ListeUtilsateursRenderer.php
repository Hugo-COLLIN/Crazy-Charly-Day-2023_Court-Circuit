<?php

namespace iutnc\ccd\render;

use iutnc\ccd\db\Utilisateur;

class ListeUtilsateursRenderer
{
    static function render()
    {
        $res = "";
        $res .= "<div class=\"utilisateurs\">";
        $res .= "<h1>Liste des commandes</h1>";


        $query = Utilisateur::recupererListe();
        $res.= "<section class=\"liste-utilisateurs\">";
        while ($row = $query->fetch()){
            $res .= "<div class='item-utilisateur'>";
            $res .= "<span class=\"material-symbols-rounded\">account_box</span> <span>{$row[3]}</span>";
            $res .= "<div class='desc-item-utilisateur'>";
            $res.="<h4>".$row[1]."</h4>";
            //$res.="<div class='elt-item-utilisateur'>".$row[3]."</div>";
            $res .= "</div></div>";
        }
        $res.= "</section>";
        $res .= "</div>";
        return $res;
    }
}