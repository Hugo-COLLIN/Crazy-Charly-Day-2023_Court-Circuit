<?php

namespace iutnc\ccd\action;
use iutnc\ccd\db\ConnectionFactory;

class ModifyFirstNameAction extends Action
{

    public function execute(): string
    {
        $res = "";
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $res = <<< HTML
                <main class="main-modify-firstname">
                    <div class="group-modify-firstname">
                        <h1>Modifier votre prénom :</h1>
                        <form action="?action=modify-firstname" method="post">
                            <label for="nvprenom">Nom : </label>
                            <input type="text" name="nvprenom" placeholder="votre nouveau prénom">
                            <button type="submit">Valider</button>
                        </form>
                    </div>
                
                </main>
               HTML;
        }
        elseif ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $nvprenom = filter_var($_POST["nvprenom"], FILTER_SANITIZE_STRING);
            $db = ConnectionFactory::makeConnection();
            $id_usr = unserialize($_SESSION['user'])->getID();
            $stmt = $db->prepare("UPDATE profil SET prenom = ? WHERE id_user = $id_usr");
            $stmt->bindParam(1, $nvprenom);
            $stmt->execute();
            $res = "<h1>Prénom mis à jour !</h1><br><button onclick='window.location.href=\"?action=profil\"'>Retour au profil</button>";
        }
        return $res;
    }
}