<?php

require_once "vendor/autoload.php";

use iutnc\ccd\action\ListeAction;
use iutnc\ccd\db\ConnectionFactory;
use iutnc\ccd\dispatch\Dispatcher;

session_start();
ConnectionFactory::setConfig("DBConfig.ini");
//Si l'utilisateur est connecté, on affiche la page qui propose d'afficher le catalogue
if (isset($_SESSION['user'])) {
    if (isset($_GET['action'])) {
        $dispatcher = new Dispatcher();
        $dispatcher->run();
    } else {
        $action = <<<HTML
            <header>
                <a id="title" href=""> </a>
                <div class="nav-group-acceuil">
                    <div class="group-acceuil-center">
                        <h2 id="page-name">Court-circuit Nancy</h2>
                    </div>
                    <div class="group-acceuil-right">
                        <div class="nav-acceuil-item-catalogue">
                            <a href="?action=catalogue" title="Click & collect"><span class="material-symbols-rounded">shopping_cart</span></a>
                        </div>
                        <div class="nav-acceuil-item-account">
                            <a href="?action=profil" title="Mon compte"><span class="material-symbols-rounded">account_box</span></a>
                        </div>
                        <div class="nav-acceuil-item-logout">
                            <a href="?action=logout" title="Se déconnecter"><span class="material-symbols-rounded">logout</span></a>
                        </div>
                    </div>
                </div>
            </header>
HTML;
        $action.="<div class='liste-serie'>";
        $list = new ListeAction("listPref");
        $action.= "<p>".$list->execute()."</p>";
        $listEnCour = new ListeAction("EnCour");
        $action.= "</br><p>".$listEnCour->execute()."</p>";
        $listEnCour = new ListeAction("listSerieVisionner");
        $action.= "</br><p>".$listEnCour->execute()."</p>";
        $action.="</div>";
        echo ajouterIndex($action);
    }
}
//Sinon (s'il n'est pas connecté), on affiche la page qui propose de se connecter ou de créer un compte
else {
    if (isset($_GET['action'])) {
        if ($_GET['action'] === "signin" or $_GET['action'] === "add-user" or $_GET['action'] === "activation") {
            $dispatcher = new Dispatcher();
            $dispatcher->run();
        }
        else {
            header("Location:index.php");
        }
    } else {
        $action = <<<HTML
            <div class="header">
                <a id="title" href="">Court-circuit Nancy</a>
                <div class="main">
                    <a id="signin" href="?action=signin">Se connecter</a>
                    <a id="signup" href="?action=add-user">S'inscrire</a>
                </div>
            </div>
HTML;
        echo ajouterIndex($action);
    }
}

//L'affichage principale de l'index
function ajouterIndex(string $html) : string {
    $code = <<<HTML
    <html lang="">
        <head>
            <meta charset="utf-8">
            <title>Court-circuit Nancy</title>
            <link rel="stylesheet" type="text/css" href="style.css">
            <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0"/>
        </head>
        <body>
            $html
        </body>
        <script src="js/bootstrap.min.js"></script>
    </html>
    HTML;
    return $code;
}