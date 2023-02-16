<?php

namespace iutnc\ccd\action;

use iutnc\ccd\db\ConnectionFactory;
use iutnc\ccd\Header\Html;

class CatalogueAction extends Action {

    public function execute(): string{

        $res = <<<END
            <main class="main-catalogue">
                <div class="search-group-catalogue">
                    <form action="?action=catalogue" method="post" class="search-form">
                        <input name="chaine" placeholder="Recherchez un article">
                        <span class="material-symbols-rounded">search</span>
                        <button type="submit" id="search-item-validate">Valider</button>
                    </form>
                    
                                      
                    <form action="?action=filtrer-catalogue" method="post">
                <select name='lieu'>
                    <option value="">Selectionner un lieu</option>
                    <option value="Santeny">Santeny</option>
                    <option value="Villeurbanne">Villeurbanne</option>
                    <option value="Nancy">Nancy</option>
                    <option value="Lucey">Lucey</option>
                    <option value="Wiwersheim">Wiwersheim</option>
                    <option value="Pont à Mousson">Pont à Mousson</option>
                    <option value="Chauny">Chauny</option>
                    <option value="Annecy">Annecy</option>
                    <option value="Les Pennes-Mirabeau">Les Pennes-Mirabeau</option>
                    <option value="Leyr">Leyr</option>
                    <option value="Sarralbe">Sarralbe</option>
                    <option value="Goviller">Goviller</option>
                </select>
                
                <select name='categorie'>
                    <option value="">Selectionner une catégorie</option>
                    <option value="Épicerie">Épicerie</option>
                    <option value="Boissons">Boissons</option>
                    <option value="Droguerie">Droguerie</option>
                    <option value="Cosmétiques">Cosmétiques</option>
                    <option value="Produits frais">Produits frais</option>
                </select>
                <button type='submit'>Filtrer</button>
            </form>
                </div>
            END;
        $res .= $this->divideBy5();
        return $res;
    }

    public function divideBy5() : String
    {
        $bd = ConnectionFactory::makeConnection();
        $rep = $bd->query("select * from produit");
        $res = '<div class="group-button-produit-catalogue">';
        $count = $rep->rowCount();
        $res .= '<div class="catalogue-page">';
        foreach (range(1, ceil($count / 5)) as $page) {
            $res .= "<button class='catalogue-page-button' '>$page</button>";
        }
        $res .= '</div>';
        $res .= '<div class="group-produit-catalogue">';
        while ($row = $rep->fetch()){
            $res.="<div class='item-produit-catalogue'>
                        <div class='img-item-catalogue'>
                            <a href=?action=produit&id=".$row[0].">
                                <img class='img-produit' src='image/$row[11]'>
                            </a>
                        </div>
                        <a class=\"group-produit\" href=?action=produit&id=".$row[0].">
                            ".$row[2]."
                            <p>Prix : $row[3]€</p>
                        </a>
                    </div>";
        }

        return $res."</div></div></main>";
    }

}
