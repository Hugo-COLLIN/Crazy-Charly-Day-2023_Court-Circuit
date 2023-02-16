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
        if ($row[4] == 0){
            $prix = "Prix au kilo : " . $row[3];
        }else{
            $prix = "Prix : " . $row[3] . " poids :". "$row[4]";
        }
        $res = <<<END
        <div class="produit">
            <div class="img-produit">
                <img src="image/{$row['image']}">
            </div>
            <div class="info-produit">
                <h2>{$row['nom']}</h2>
                <h4>Catégorie du produit : {$row['categorie']}</h4>
                <h4 id="prix">$prix</h4>
                <div class="panier">
                <span class="material-symbols-rounded" onclick="ajouter()" title="Ajouter au panier">add_shopping_cart</span>
                    
                
        END;



        if ($row[4] == 0){
            $res .= ' <input type=number min =0.01 step=0.01 class="qte" value="0.01"/> Step 0.01kg<br />';
        }else{
            $res .="
        <select name='qte' class='qte'>
        <option value='1'>1</option>
        <option value='2'>2</option>
        <option value='3'>3</option>
        <option value='4'>4</option>
        <option value='5'>5</option></select>";
        }
        $res .= "</div></div></div>";
        $res .= '<script>
        function ajouter() {
        let a = document.getElementsByClassName("qte")
        let cookie = document.cookie.split(";")[2].split("=")[1];
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