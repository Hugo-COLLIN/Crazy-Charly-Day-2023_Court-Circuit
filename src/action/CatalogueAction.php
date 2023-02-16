<?php

namespace iutnc\ccd\action;

use iutnc\ccd\db\ConnectionFactory;
use iutnc\ccd\Header\Header;

class CatalogueAction extends Action {

    public function execute(): string{
        $res = "";
        $bd = ConnectionFactory::makeConnection();
        $rep = $bd->query("select * from produit");
        $res.= <<<END
            <main>
                <div class="search-group-catalogue">
                    <form action="?action=catalogue" method="post" class="search-form">
                        <label id="search-item-label">Rechercher </label>
                        <input name="chaine">
                        <button type="submit" id="search-item-validate">Validate</button>
                    </form>
                </div>
            END;
        $res.= '<div class="group-produit-catalogue">';
        while ($row = $rep->fetch()){
             $res.="<div class='item-produit-catalogue'>
                        <div class='img-item-catalogue'>
                            <a href=?action=produit&id=".$row[0].">
                                <img class='img-produit' src='image/$row[11]'>
                            </a>
                        </div>
                        <a class=\"group-produit\" href=?action=produit&id=".$row[0].">
                            ".$row[2]."
                        </a>
                    </div>";
        }
        return $res."</div></main>";
    }


}
