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
        </script><a href=?action=catalogue>Retour</a>';


        $res.='<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d336163.39846476965!2d'.$row['longitude'].'!3d'.$row['latitude'].'!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sfr!2sfr!4v1676583649510!5m2!1sfr!2sfr" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
        return $res;
    }
}