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
        $res.= "<label id='total'> $total €</label>";
        $res .= '<br><div id="validation"<label>choisir date RDV : </label><input id="rdv" type="date" id="datePickerId" /> 
        <br><Button id="valider" onclick="valider()" type="submit"> valider</Button></div>';
        $res.=<<<HTML
        <script>
        function supprimer(i){
            let c = document.cookie.split(';')[0];
            let t = c.split(",")[i];
            c = c.replace("panier=", "")
            document.cookie = "panier="+c.replace(','+t, "");
            window.location.href = 'index.php?action=panier';
        }
        function valider(){
            let currentDate = new Date().toJSON().slice(0, 10);
            let d = document.getElementById("rdv");
            if(d.value >= currentDate){
                window.location.href = 'index.php?action=validerPanier';
                document.cookie = "rdv="+d.value;
                document.cookie = "total="+total;
            }else{
            alert("pas possible pour la date choisi");
            }
        }
        let total = document.getElementById("total").firstChild.wholeText.split(" ")[1];
        if (total == 0){
            document.getElementById("validation").style.display = 'none';
        }
        </script>
        HTML;

        return $res;
    }
}