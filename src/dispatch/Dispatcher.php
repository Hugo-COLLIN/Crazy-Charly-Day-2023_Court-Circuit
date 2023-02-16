<?php

namespace iutnc\ccd\dispatch;

/*use iutnc\ccd\action\ActivationAction;*/
use iutnc\ccd\action\AddUserAction;
/*use iutnc\ccd\action\AjoutCommentaireAction;
use iutnc\ccd\action\CatalogueExecuteSearch;
use iutnc\ccd\action\CatalogueSearchAction;*/
use iutnc\ccd\action\LogoutAction;
/*use iutnc\ccd\action\ModifProfilAction;
use iutnc\ccd\action\SelectionEpisodeAction;
use iutnc\ccd\action\SelectionSerieAction;*/
use iutnc\ccd\action\SigninAction;
/*use iutnc\ccd\baseChange\AjouterPref;
use iutnc\ccd\baseChange\ProfilUpdate;
use iutnc\ccd\baseChange\SupprimerPref;*/

class Dispatcher {

    public function __construct() {
    }

    private function renderPage(string $html) : void {
        $res = <<<HTML
            <!DOCTYPE html>
            <html lang="fr">
                <head>
                    <meta charset="utf-8">
                    <title>NetVOD</title>
                    <link rel="stylesheet" type="text/css" href="style.css">
                </head>
                <body>
                    <div class="header">
                        <a id="title" href="index.php">NetVOD</a>
                    </div>
                    $html
                </body>
            </html>
        HTML;
        echo $res;
    }

    public function run() : void {
        switch ($_GET['action']) {
            case "signin":
                $action = new SigninAction();
                break;
            case "add-user":
                $action = new AddUserAction();
                break;
            case "logout":
                $action = new LogoutAction();
                break;
            case "catalogue":
                /*$classeTemp = new CatalogueSearchAction();
                if(!isset($_POST['chaine'])){
                    $_POST['chaine'] =  "";
                }
                $action = new CatalogueExecuteSearch($classeTemp, filter_var($_POST['chaine'], FILTER_SANITIZE_STRING));
                $_POST['chaine'] =  "";*/
                $action = new CatalogueAction();
                break;
            /*case "serie":
                $action = new SelectionSerieAction($_GET['id'], true);
                break;
            case "continuerSerie":
                $action = new SelectionSerieAction($_GET['id']);
                break;
            case "ajouterpref":
                AjouterPref::execute();
                $action = new SelectionSerieAction($_GET['id_serie']);
                break;
            case "supprimerpref":
                SupprimerPref::execute();
                $action = new SelectionSerieAction($_GET['id_serie']);
                break;
            case "regarder":
                $action = new SelectionEpisodeAction($_GET['id'],$_GET['id_ep']);
                break;
            case "ajout-comm":
                $action = new AjoutCommentaireAction($_GET['id'],$_GET['id_ep']);
                break;
            case "activation":
                $action = new ActivationAction($_GET['token']);
                break;
            case "profilmodif":
                ProfilUpdate::update();
            case "profil":
                $action = new ModifProfilAction();
                break;*/
            default:
                echo "mauvaise 'action'";
                break;
        }
        try {
                $this->renderPage($action->execute());
        }
        catch (\Erro $e) {
            header("Location:index.php");
        }
    }
}