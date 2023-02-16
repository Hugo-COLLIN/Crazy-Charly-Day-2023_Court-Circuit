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
            $res .= "<p class='item-utilisateur'>{$row[1]}</p>";
            $res .= "<p class='item-utilisateur'>{$row[2]}</p>";
            $res .= "<p class='item-utilisateur'>{$row[3]}</p>";
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