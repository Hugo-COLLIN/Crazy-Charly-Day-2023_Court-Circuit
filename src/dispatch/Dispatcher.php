<?php

namespace iutnc\ccd\dispatch;

use iutnc\ccd\action\ListeCommandesAction;
use iutnc\ccd\action\PanierAction;
use iutnc\ccd\action\SelectionProduitAction;
use iutnc\ccd\action\AddUserAction;
use iutnc\ccd\action\CatalogueAction;
use iutnc\ccd\action\LogoutAction;
use iutnc\ccd\action\SigninAction;
use iutnc\ccd\action\FiltrerCatalogueAction;
use iutnc\ccd\Header\Header;

class Dispatcher {

    public function __construct() {
    }

    private function renderPage(string $html) : void {
        $res = Header::afficher() . $html.'</body>
            </html>';
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
            case "produit":
                $action = new SelectionProduitAction($_GET['id']);
                break;
            case "filtrer-catalogue" :
                $action = new FiltrerCatalogueAction();
                break;
            case "listeCommandes":
                $action = new ListeCommandesAction();
                break;
                /*
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
            case "panier":
                $action = new PanierAction();
                break;
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