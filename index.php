<?php

require_once "vendor/autoload.php";

use iutnc\ccd\action\ListeAction;
use iutnc\ccd\db\ConnectionFactory;
use iutnc\ccd\dispatch\Dispatcher;
use iutnc\ccd\Header\Header;

session_start();
ConnectionFactory::setConfig("DBConfig.ini");
//Si l'utilisateur est connecté, on affiche la page qui propose d'afficher le catalogue
if (isset($_SESSION['user'])) {
    if (isset($_GET['action'])) {
        $dispatcher = new Dispatcher();
        $dispatcher->run();
    } else {
        echo Header::afficher();
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
        echo '<html lang="fr">
        <head>
            <meta charset="utf-8">
            <title>Court-circuit Nancy</title>
            <link rel="stylesheet" type="text/css" href="style.css">
            <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0"/>
        </head>
        <body>
        <div class="header">
                <a id="title" href="">Court-circuit Nancy</a>
                <div class="main">
                    <a id="signin" href="?action=signin">Se connecter</a>
                    <a id="signup" href="?action=add-user">S'."'".'inscrire</a>
                </div>
            </div>
        </body>
        <script src="js/bootstrap.min.js"></script>
    </html>';
    }
}