<?php
declare(strict_types=1);

namespace iutnc\ccd\action;

use iutnc\ccd\db\ConnectionFactory;

class FiltrerCatalogueAction extends Action{

    public function execute(): string{
        $res = "";
        if ($this->http_method == 'POST') {
            echo('jjjjj');

            $lieu= filter_var($_POST['lieu'],FILTER_SANITIZE_STRING);
                $categorie = filter_var($_POST['categorie'],FILTER_SANITIZE_STRING);
            if($_POST['lieu'] === "" || $_POST['categorie'] ==="") {
                    echo'rtyhtr';
                    $sql = "select * from produit 
                where lieu = ? 
                union 
                select * from produit 
                inner join categorie on produit.categorie = categorie.id
                where categorie.nom = ?";
                }
                else{
                    echo'hhhhhhhh';
                    $sql = "select * from produit 
                where lieu = ? 
                intersect 
                select * from produit 
                inner join categorie on produit.categorie = categorie.id
                where categorie.nom = ?";
                }
                $bd = ConnectionFactory::makeConnection();
                $stmt = $bd->query($sql);
                $stmt -> bindParam(1,$lieu);
                $stmt -> bindParam(2,$categorie);
                while ($row = $stmt->fetch()){
                    echo ("gohijtieaiagjh");
                    $res.="<div class='item-produit'><a href=?action=produit&id=".$row[0]."><img class='img-produit' src='image/$row[11]'></a><a class=\"group-produit\" href=?action=produit&id=".$row[0].">".$row[2]."<br>Prix : $row[3]</a></div>";
                }

        }
        return $res;
    }

}