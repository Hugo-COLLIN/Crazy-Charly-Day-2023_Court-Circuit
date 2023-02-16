<?php

namespace iutnc\ccd\db;

class Commande
{

    public static function afficherListe(): string {
        $res = "";
        $bd = ConnectionFactory::makeConnection();
        $query = $bd->prepare("select * from commande /*NATURAL JOIN userccd*/");
        $query->execute();

        $res.= "<section class=\"liste-commandes\">";
        while ($row = $query->fetch()){
            $res .= "<div class='item-commande'>";
            $res.="<div class='elt-item-commande'>Id : ".$row[1]."</div>";
            $res.="<div class='elt-item-commande'>Date : ".$row[2]."</div>";
            $res.="<div class='elt-item-commande'>Valeur : ".$row[3]."</div>";
            $res .= "</div>";
        }
        $res.= "</section>";
/*
        foreach (Commande::getAll() as $commande) {
            $res .= $query->dateCommande;
            //$res .= $query->
        }
            $res .= "<td>" . $query->dateCommande . "</td>";
            $res .= "<td>" . $commande->getDateCommande() . "</td>";
            $res .= "<td>" . $commande->getMontant() . "</td>";
            $res .= "<td>" . $commande->getEtat() . "</td>";
            $res .= "<td>";
            foreach ($commande->getProduits() as $produit) {
                $res .= "<div class='item-produit'><a href=?action=produit&id=" . $produit->getId() . "><img class='img-produit' src='image/" . $produit->getImage() . "'></a><a class=\"group-produit\" href=?action=produit&id=" . $produit->getId() . ">" . $produit->getTitre() . "<br>Prix : " . $produit->getPrix() . "</a></div>";
            }
            $res .= "</td>";
            $res .= "</tr>";*/
        return $res;
    }
}