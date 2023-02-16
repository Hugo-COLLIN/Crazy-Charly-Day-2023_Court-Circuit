<?php

namespace iutnc\ccd\header;
class Html
{

    public static function afficherHtml(): string
    {
        return '
    <html lang="fr">
        <head>
            <meta charset="utf-8">
            <title>Court-circuit Nancy</title>
            <link rel="stylesheet" type="text/css" href="style.css">
            <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0"/>
        <script src="js/bootstrap.min.js" defer></script>
        <script src="script.js" defer></script>
        </head>
        <body>';
    }

    public static function afficherHeader()
    {
        if (isset($_SESSION['user'])) {
            $connect = '<div class="nav-acceuil-item-logout">
                            <a href="?action=logout" title="Se déconnecter"><span class="material-symbols-rounded">logout</span></a>
                        </div>';
        }else {
            $connect = "";
        }
        $html = '<header>
                <div class="nav-group-acceuil">
                    <div class="group-acceuil-center">
                        <h2 id="page-name">Court-circuit Nancy</h2>
                    </div>
                    <div class="group-acceuil-right">
                        <div class="nav-acceuil-item-catalogue">
                            <a href="?action=catalogue" title="Click & collect"><span class="material-symbols-rounded">store</span></a>
                        </div>
                        <div class="nav-acceuil-item-catalogue">
                            <a href="" title="Panier"><span class="material-symbols-rounded">shopping_cart</span></a>
                        </div>
                        <div class="nav-acceuil-item-listeCommandes">
                            <a href="?action=listeCommandes" title="Liste des commandes (Administrateur)"><span class="material-symbols-rounded">order_approve</span></a>
                        </div>
                        <div class="nav-acceuil-item-listeUtilisateurs">
                            <a href="?action=listeUtilisateurs" title="Liste des utilisateurs (Administrateur)"><span class="material-symbols-rounded">group</span></a>
                        </div>
                        <div class="nav-acceuil-item-account">
                            <a href="?action=profil" title="Mon compte"><span class="material-symbols-rounded">account_box</span></a>
                        </div>
                        '. $connect . '
                    </div>
                </div>
                </header>';
        return $html;
    }



    public static function afficherLogin() : String
    {
        return <<<END
            <header>
                <div class="nav-group-acceuil">
                    <div class="group-acceuil-center">
                        <h2 id="page-name">Court-circuit Nancy</h2>
                    </div>
                </div>
            </header>
            <main>
                <div class="login">
                    <a id="signin" href="?action=signin">Se connecter</a>
                    <a id="signup" href="?action=add-user">S'inscrire</a> 
                </div>
            </main>
            END;

    }

}