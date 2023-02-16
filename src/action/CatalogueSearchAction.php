<?php

namespace iutnc\ccd\action;
use iutnc\ccd\db\ConnectionFactory;
use iutnc\ccd\action\CatalogueAction;

class CatalogueSearchAction extends CatalogueAction
{
    public function executeWithArg(string $ch): string
    {
        if($ch == ""){
             $t = new CatalogueAction();
             return $t->execute();
        }else {
            $res = "<HTML>";
            $bd = ConnectionFactory::makeConnection();
            $rep = $bd->query("select * from serie where lower(descriptif) like lower('%$ch%') or lower(titre) like lower('%$ch%')");
            $res.= '<form action="?" method="get" class="search-form">
                    <button type="submit" >Retour</button>
                    <input type="hidden" name="action" value="catalogue">
                    </form>';
            $res.= "<div class=\"series\">";
            while ($row = $rep->fetch()){
                $res.="<div class='video-div'><a href=?action=serie&id=".$row[0]."><img class='img-video' src='image/$row[3]'></a><a class=\"serie\" href=?action=serie&id=".$row[0].">".$row[1]."</a></div>";
            }

            return $res."</div></HTML>";
        }

    }
}