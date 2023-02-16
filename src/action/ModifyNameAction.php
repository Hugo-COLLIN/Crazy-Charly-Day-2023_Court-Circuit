<?php

namespace iutnc\ccd\action;

use iutnc\ccd\db\ConnectionFactory;

class ModifyNameAction extends Action
{

    public function execute(): string
    {
        $res = "";
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $res = <<< HTML
                    <main class="main-modify-name">
                        <div class="group-modify-name">
                            <h1>Modifier votre nom :</h1>
                            <form action="?action=modify-name" method="post">
                                <label for="nvnom">Nom : </label>
                                <input type="text" name="nvnom" placeholder="votre nouveau nom">
                                <button type="submit">Valider</button>
                            </form>
                        </div>
                    
                    </main>
                   HTML;
        }
        elseif ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $nvnom = filter_var($_POST["nvnom"], FILTER_SANITIZE_STRING);
            $db = ConnectionFactory::makeConnection();
            $id_usr = unserialize($_SESSION['user'])->getID();
            $stmt = $db->prepare("UPDATE profil SET nom = ? WHERE id_user = $id_usr");
            $stmt->bindParam(1, $nvnom);
            $stmt->execute();
            $res = "<h1>Nom mis à jour !</h1><br><button onclick='window.location.href=\"?action=profil\"'>Retour au profil</button>";
        }
        return $res;
    }
}