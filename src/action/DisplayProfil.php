<?php

namespace iutnc\ccd\action;

use iutnc\ccd\db\ConnectionFactory;

class DisplayProfil extends Action
{
    public function execute(): string
    {
        $bd = ConnectionFactory::makeConnection();
        $usr = unserialize($_SESSION['user']);
        $stmt = $bd->prepare("select id_user, nom, prenom, pseudo from profil where id_user = ?");
        $usr_id = $usr->getID();
        $stmt->bindParam(1, $usr_id);
        $stmt->execute();
        $profil = $stmt->fetch();
        $res = <<<HTML
             <main class="main-profil">
                <div class="group-profil">
                    <div class="profil-entete">
                    <h1>Bonjour $profil[1] $profil[2] : </h1>
                    <h3>Votre pseudo est $profil[3]</h3>
                    </div>
                    <br>
                    </div class="profil-buttons">
                    <button onclick="window.location.href='?action=modify-name'">Changer votre nom</button>
                    <br>
                    <br>
                    <button onclick="window.location.href='?action=modify-firstname'">Changer votre prénom</button>
                    <br>
                    <br>
                    <button onclick="window.location.href='?action=modify-surname'">Changer votre pseudonyme</button>
                    </div>
                </div>
             </main>
             HTML;
        return $res;
    }
}