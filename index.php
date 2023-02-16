<?php

require_once "vendor/autoload.php";

use iutnc\sae\action\ListeAction;
use iutnc\sae\db\ConnectionFactory;
use iutnc\sae\dispatch\Dispatcher;

session_start();
ConnectionFactory::setConfig("DBConfig.ini");
//Si l'utilisateur est connecté, on affiche la page qui propose d'afficher le catalogue
if (isset($_SESSION['user'])) {
    if (isset($_GET['action'])) {
        $dispatcher = new Dispatcher();
        $dispatcher->run();
    } else {
        $action = <<<HTML
            <div class="header">
                <a id="title" href="">NetVOD</a>
                <div class="main">
                    <a href="?action=logout">Se déconnecter</a>
                    <a href="?action=catalogue">Catalogue</a>
                    <a href="?action=profil">Profil</a>
                </div>
            </div>
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
                <a id="title" href="">NetVOD</a>
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
            <title>NetVOD</title>
            <link rel="stylesheet" type="text/css" href="style.css">
        </head>
        <body>
            $html
        </body>
    </html>
    HTML;
    return $code;
}