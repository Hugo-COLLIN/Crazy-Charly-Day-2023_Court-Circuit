<?php

namespace iutnc\ccd\render;

use iutnc\ccd\db\Utilisateur;

class InfosUtilsateurRenderer
{
    static function render(int $id)
    {
        $res = "";
        $res .= "<div class=\"utilisateurs\">";
        $res .= "<h1>Liste des utilisateurs</h1>";


        $query = Utilisateur::recupererUtilisateur($id);
        if ($row = $query->fetch())
        {
            $res.= "<section class=\"infos-utilisateur\">";
            $res .= "<span class=\"material-symbols-rounded\">account_box</span>{$row[3]}";
            $res .= "<h4>{$row[5]} {$row[6]}</h4>";
            $res .= "<p class=''>@{$row[7]}</p>";
            $res .= "<p class=''>{$row[1]}</p>";
            $res.= "</section>";
            $res .= "</div>";
        }
        else
        {
            $res .= "<p>Utilisateur introuvable</p>";
        }

        return $res;
    }
}