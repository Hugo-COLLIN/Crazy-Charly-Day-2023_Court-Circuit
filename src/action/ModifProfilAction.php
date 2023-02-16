<?php

namespace iutnc\ccd\action;

use iutnc\ccd\db\ConnectionFactory;

class ModifProfilAction extends Action

{

    public function execute(): string
    {
        if ($_SESSION['id'] == null) {
            $bd = ConnectionFactory::makeConnection();
            $query = $bd->query('select nom,prenom,pseudo,date_naissance from profil where user_id = ' . $_SESSION['id']);
            $data = $query->fetch();
            $nom = $data[0];
            $prenom = $data[1];
            $pseudo = $data[2];
            $date = $data[3];
            return "
                <p>Nom : " . $nom . "<br>
                Prenom : " . $prenom . "<br> 
                Pseudo : " . $pseudo . "<br>
                Date de Naissance : " . $date . "</p>
                <form method='post' action='?action=profilmodif'>
                <input type='text' name='nom' placeholder='Nom'></input>
                <input type='text' name='prenom' placeholder='Prenom'></input>
                <input type='text' name='pseudo' placeholder='Pseudo'></input>
                <input type='date' name='date' placeholder='Date de Naissance'></input>
                <br>
                <button type='submit'>Valider</button>
                </form>";
        } else {
            return header('Location: index.php?action=login');
        }
    }
}