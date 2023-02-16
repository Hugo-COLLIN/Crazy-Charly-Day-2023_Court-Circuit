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
        for ($i = 1; $i < count($panier); $i++){
            $quarry = $db->prepare("select nom, prix from produit where id = ?");
            $quarry->bindParam(1, explode(":", $panier[$i])[0]);
            $quarry->execute();
            while($p = $produit->fetch()){
                $res.="<li> $p</li>";
            }
        }
        return $res;
    }
}