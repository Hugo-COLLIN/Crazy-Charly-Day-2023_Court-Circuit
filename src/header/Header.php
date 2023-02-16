<?php

namespace iutnc\ccd\header;
class Header{

    public static function afficher() : String{
        return '
    <html lang="fr">
        <head>
            <meta charset="utf-8">
            <title>Court-circuit Nancy</title>
            <link rel="stylesheet" type="text/css" href="style.css">
            <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0"/>
        <script src="js/bootstrap.min.js" defer></script>
        </head>
        <body>
            <header>
                <div class="nav-group-acceuil">
                    <div class="group-acceuil-center">
                        <h2 id="page-name">Court-circuit Nancy</h2>
                    </div>
                    <div class="group-acceuil-right">
                        <div class="nav-acceuil-item-catalogue">
                            <a href="?action=panier" title="Click & collect"><span class="material-symbols-rounded">shopping_cart</span></a>
                        </div>
                        <div class="nav-acceuil-item-catalogue">
                            <a href="?action=catalogue" title="Catalogue"><span class="material-symbols-rounded">catalogue</span></a>
                        </div>
                        <div class="nav-acceuil-item-account">
                            <a href="?action=profil" title="Mon compte"><span class="material-symbols-rounded">account_box</span></a>
                        </div>
                        <div class="nav-acceuil-item-logout">
                            <a href="?action=logout" title="Se déconnecter"><span class="material-symbols-rounded">logout</span></a>
                        </div>
                    </div>
                </div>
            </header>';
        }
}