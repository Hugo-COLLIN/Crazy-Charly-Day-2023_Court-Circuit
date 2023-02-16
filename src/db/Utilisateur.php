<?php

namespace iutnc\ccd\db;

class Utilisateur
{
    public static function recupererListe(): \PDOStatement {
        $res = "";
        $bd = ConnectionFactory::makeConnection();
        $query = $bd->prepare("select * from userccd");
        $query->execute();

        return $query;
    }

    public static function recupererUtilisateur(int $id)
    {
        $bd = ConnectionFactory::makeConnection();
        $query = $bd->prepare("select * from userccd inner join profil where profil.id_user = userccd.id and id = ?");
        $query->bindParam(1, $id);
        $query->execute();

        return $query;
    }
}