<?php

namespace iutnc\ccd\action;

use iutnc\ccd\db\ConnectionFactory;

class PanierAction extends Action{

    public function execute(): String{
        $res = "";
        $db = ConnectionFactory::makeConnection();
        $panier = $_COOKIE["panier"];
        $panier = explode(",", $panier);
        $res.="<ul>";
        $total = 0;
        for ($i = 1; $i < count($panier); $i++){
            $qte = explode(":", $panier[$i])[1];
            $quarry = $db->prepare("select nom, prix from produit where id = ?");
            $quarry->bindParam(1, explode(":", $panier[$i])[0]);
            $quarry->execute();
            $p = $quarry->fetch();
            $res.="<li>" .$p["nom"] ." : ".$p["prix"]. " qte : ".$qte."</li>";
            $total += floatval($p["prix"])*floatval($qte);
        }
        $res.=$total;
        return $res;
    }
}