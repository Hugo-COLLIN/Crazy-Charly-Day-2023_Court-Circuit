<?php

namespace iutnc\ccd\db;

class Commande
{

    public static function afficherListe(): string {
        $res = "";
        $bd = ConnectionFactory::makeConnection();
        $query = $bd->prepare("select * from commande NATURAL JOIN userccd");
        $query->execute();

        $res.= "<section class=\"liste-commandes\">";
        while ($row = $query->fetch()){
            $res .= "<div class='item-commande'>";
            $res.="<h4>".$row[5]."</h4>";
            $res.="<div class='elt-item-commande'>Date : ".$row[2]."</div>";
            $res.="<div class='elt-item-commande'>Valeur : ".$row[3]."€</div>";
            $res .= self::afficherListeProduit($row[0]);
            $res .= "</div>";
        }
        $res.= "</section>";
        return $res;
    }

    private static function afficherListeProduit(int $int)
    {
        $res = "";
        $bd = ConnectionFactory::makeConnection();
        $query = $bd->prepare("select * from produit INNER JOIN contient where contient.idcommande = ? and contient.numProduit = produit.id");
        $query->bindParam(1, $int);
        $query->execute();
        $res .= "<div class='item-produit-commande'>";
        while ($row = $query->fetch()){
            $res.="<h5 class='elt-item-commande'>".$row[2]."</h5>";
            $res .= "<div class='elt-item-commande'>Prix : ".$row[3]."€</div>";
        }
        $res .= "</div>";
        return $res;
    }

    /*
    private static function afficherListeProduit(int $int)
    {
        $res = [];
        $bd = ConnectionFactory::makeConnection();
        $query = $bd->prepare("select * from produit INNER JOIN contient where contient.idcommande = ? and contient.numProduit = produit.id");
        $query->bindParam(1, $int);
        $query->execute();
        while ($row = $query->fetch()){
            $res[] = $row[2];
        }
        return $res;
    }
    */
}