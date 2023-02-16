<?php

namespace iutnc\ccd\action;

use iutnc\ccd\db\ConnectionFactory;

class CatalogueAction extends Action {

    public function execute(): string{
        $res = "<HTML>";
        $bd = ConnectionFactory::makeConnection();
        $rep = $bd->query("select * from produit");
        $res.= '<div style="margin: inherit;"><form action="?action=catalogue" method="post" class="search-form">
                    <label>Rechercher </label><input name="chaine">
                    <button type="submit">Validate</button>
                </form></div>';
        $res.= "<div class=\"group-produit\">";
        while ($row = $rep->fetch()){
             $res.="<div class='item-produit'><a href=?action=produit&id=".$row[0]."><img class='img-produit' src='image/$row[11]'></a><a class=\"group-produit\" href=?action=produit&id=".$row[0].">".$row[2]."<br>Prix : $row[3]</a></div>";
        }
        return $res."</div></HTML>";
    }


}
