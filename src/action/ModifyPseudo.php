<?php

namespace iutnc\ccd\action;

use iutnc\ccd\db\ConnectionFactory;

class ModifyPseudo extends Action
{

    public function execute(): string
    {
        $res = "";
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $res = <<< HTML
                    <main class="main-modify-surname">
                        <div class="group-modify-surname">
                            <h1>Modifier votre pseudonyme :</h1>
                            <form action="?action=modify-surname" method="post">
                                <label for="nvpseudo">Nom : </label>
                                <input type="text" name="nvpseudo" placeholder="votre nouveau pseudo">
                                <button type="submit">Valider</button>
                            </form>
                        </div>
                    
                    </main>
                   HTML;
        }
        elseif ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $nvnom = filter_var($_POST["nvpseudo"], FILTER_SANITIZE_STRING);
            $db = ConnectionFactory::makeConnection();
            $id_usr = unserialize($_SESSION['user'])->getID();
            $stmt = $db->prepare("UPDATE profil SET pseudo = ? WHERE id_user = $id_usr");
            $stmt->bindParam(1, $nvnom);
            $stmt->execute();
            $res = "<h1>Pseudonyme mis à jour !</h1><br><button onclick='window.location.href=\"?action=profil\"'>Retour au profil</button>";
        }
        return $res;
    }
}