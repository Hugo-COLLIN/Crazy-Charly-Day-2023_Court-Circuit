<?php

namespace iutnc\ccd;

use iutnc\ccd\db\ConnectionFactory;
use PDOException;

class Produit
{

    public static function afficher(string $id): string {
        $res = "";
        $bd = ConnectionFactory::makeConnection();
        $query = $bd->prepare("select * from produit where id = ?");
        $query->bindParam(1, $id);
        $query->execute();
        $row = $query->fetch();
        $res .= "<div class=\"description\"><p>". $row[2];

        if ($row[4] == 0){
            $res .= "prix au kilo : " . $row[3];
        }else{
            $res .= "prix : " . $row[3] . " poids :". "$row[4]";
        }
        $res .= "</p><p>description : " . $row[5] . "</p><p>Detail : " . $row[6] . "</div></p><p>Lieux de production : " . $row[7] . "</p><p>Distance de Nancy : " . $row[8] . "km   coordonnees : ".$row[9]." ".$row[10]."</div>";

        $res .= '<br><div class="immage-produit"><img src="image/'.$row[11].'"></div></br>';
        $res .='<button onclick="ajouter()" type="submit">ajouter au panier</button>';
        if ($row[4] == 0){
            $res .= ' <input type=number min =0.01 step=0.01 class="qte" value="0.01" /> Step 0.01<br />';
        }else{
            $res .="
        <select name='qte' class='qte'>
        <option value='1'>1</option>
        <option value='2'>2</option>
        <option value='3'>3</option>
        <option value='4'>4</option>
        <option value='5'>5</option></select>";
        }
        $res .= '<script>
        function ajouter() {
        let a = document.getElementsByClassName("qte")
        let cookie = document.cookie.split(";")[0].split("=")[1];
        document.cookie = "panier="+cookie+",'.$id.':"+a[0].value;
        }
        </script>';
        $res .= "
        <form method='post' action='?action=ajout-comm&id=" . $id . "' class='comment-form'>
        <h2>Note</h2>
        <select name='note'>
        <option value='1'>1</option>
        <option value='2'>2</option>
        <option value='3'>3</option>
        <option value='4'>4</option>
        <option value='5'>5</option></select>
        <h2>Commentaire</h2>
        <textarea maxlength='520' name='commentaire' placeholder='Commentaire' required></textarea><br>
        <button type='submit'>Envoyer</button></form><a href=?action=catalogue>Retour</a>";
        return $res;
    }
}