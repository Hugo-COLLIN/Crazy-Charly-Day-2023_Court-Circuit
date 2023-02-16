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
}