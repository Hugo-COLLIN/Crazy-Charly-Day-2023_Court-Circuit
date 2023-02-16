<?php

namespace iutnc\ccd\action;

use iutnc\ccd\db\ConnectionFactory;

class AjouterCommande extends Action{

    public function execute(): string{
        return "todo";
    }
        // TODO: Implement execute() method.
    public function ajouter(){
        $db = ConnectionFactory::makeConnection();
        $query = $db->prepare("Insert into commande (numCli, prix, rdv) values(?,?,TO_DATE(?,'YYYY-MM-DD'))");
        $query->bindParam(1, unserialize($_SESSION["user"])->getID());
        $query->bindParam(2, $_COOKIE["total"]);
        $query->bindParam(3, $_COOKIE["rdv"]);
        $query->
        $panier = $_COOKIE["panier"];
        $panier = explode(",", $panier);
    }

}