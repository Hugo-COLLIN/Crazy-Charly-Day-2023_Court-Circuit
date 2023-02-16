<?php

namespace iutnc\ccd\action;

use iutnc\ccd\db\ConnectionFactory;

class AjouterCommande extends Action{

    public function execute(): string{
        return "votre commande a ete effectuer";
    }
        // TODO: Implement execute() method.
    public static function ajouter(){
        $db = ConnectionFactory::makeConnection();
        $query = $db->prepare("Insert into commande (numCli, dateCommande, prix, rdv) values(?,?,?,?)");
        $val = unserialize($_SESSION["user"])->getID();
        $query->bindParam(1, $val);
        $str1 = "SYSDATE()";
        $query->bindParam(2, $str1);
        $query->bindParam(3, $_COOKIE["total"]);
        $str = "STR_TO_DATE('".$_COOKIE["rdv"]."','%Y-%m-%d')";
        $query->bindParam(4, $str);
        $query->execute();
        $panier = $_COOKIE["panier"];
        $panier = explode(",", $panier);
        for ($i = 1; $i < count($panier); $i++){
            $qte = explode(":", $panier[$i])[1];
            $res = $db->query("SELECT max(id) from commande");
            $idcommande = $res->fetch();
            $quarry = $db->prepare("insert into contient values (?,?,?)");
            $quarry->bindParam(1,$idcommande[0]);
            $quarry->bindParam(2, explode(":", $panier[$i])[0]);
            $quarry->bindParam(3, $qte);
            $quarry->execute();
        }
    }

}