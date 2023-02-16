<?php
declare(strict_types=1);
namespace iutnc\ccd\dispatch;

use iutnc\ccd\action\InfosUtilisateurAction;
use iutnc\ccd\action\ListeCommandesAction;
use iutnc\ccd\action\ListeUtilisateursAction;
use iutnc\ccd\action\PanierAction;
use iutnc\ccd\action\SelectionProduitAction;
use iutnc\ccd\action\AddUserAction;
use iutnc\ccd\action\CatalogueAction;
use iutnc\ccd\action\LogoutAction;
use iutnc\ccd\action\SigninAction;
use iutnc\ccd\action\CatalogueSearchAction;
use iutnc\ccd\action\CatalogueExecuteSearch;
use iutnc\ccd\action\FiltrerCatalogueAction;
use iutnc\ccd\header\Header;
use iutnc\ccd\header\Html;
use iutnc\ccd\render\InfosUtilsateurRenderer;

class Dispatcher {

    private string $action;
    public function __construct(String $action) {
        $this->action = $action;
    }

    private function renderPage(string $html) : void {
        $res = Html::afficherHtml() . Html::afficherHeader() . $html.'</body>
            </html>';
        echo $res;
    }

    public function run() : void {
        switch ($this->action) {
            case "signin":
                $action = new SigninAction();
                break;
            case "add-user":
                $action = new AddUserAction();
                break;
            case "logout":
                $action = new LogoutAction();
                break;
            case "listeUtilisateurs":
                $action = new ListeUtilisateursAction();
                break;
            case "infosUtilisateur":
                $action = new InfosUtilisateurAction($_GET['idUser']);
                break;
            case "catalogue":
                $classeTemp = new CatalogueSearchAction();
                if(!isset($_POST['chaine'])){
                    $_POST['chaine'] =  "";
                }
                $action = new CatalogueExecuteSearch($classeTemp, filter_var($_POST['chaine'], FILTER_SANITIZE_STRING));
                $_POST['chaine'] =  "";
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
                ProfilUpdate::update();*/
            case "profil":
                if (isset($_SESSION['user'])) {

                } else {
                    header("Location:index.php?action=signin");
                    $action = new SigninAction();
                }
                break;
            case "panier":
                $action = new PanierAction();
                break;
            default:
                echo 'error';
                break;
        }
        if ($action == null) {
            header("Location:index.php");
        }
        try {
            $this->renderPage($action->execute());
        }
        catch (\Exception $e) {
            header("Location:index.php");
        }
    }
}