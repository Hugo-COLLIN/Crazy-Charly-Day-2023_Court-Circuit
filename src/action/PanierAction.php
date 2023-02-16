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
            $res.="<li>" .$p["nom"] ." : ".$p["prix"]. "€   qte : ".$qte." <button id='$i' onclick='supprimer($i)' type='submit'>supprimer</button></li>";
            $total += floatval($p["prix"])*floatval($qte);
        }
        $res.=<<<HTML
        <script>
        function supprimer(i){
            let b = document.getElementById(i);
            let c = document.cookie.split(';')[0];
            let t = c.split(",")[i];
            c = c.replace("panier=", "")
            document.cookie = "panier="+c.replace(','+t, "");
            window.location.href = 'index.php?action=panier';
        }
        </script>
        HTML;
        $res.=$total . " €";
        return $res;
    }
}