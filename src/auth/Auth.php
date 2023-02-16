<?php

namespace iutnc\ccd\auth;

use iutnc\ccd\db\ConnectionFactory;
use iutnc\ccd\db\User;
use iutnc\ccd\exception\EmailAlreadyRegistedException;
use iutnc\ccd\exception\EmailNonExistsException;
use iutnc\ccd\exception\NotStrengthPassWord;
use iutnc\ccd\exception\TooShortPasswordException;
use PDO;

class Auth {
    /**
     * @throws EmailAlreadyRegistedException
     * @throws TooShortPasswordException
     * @throws NotStrengthPassWord
     */
    public static function register(string $email, string $password) : bool {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) return false;
        $hash = password_hash($password, PASSWORD_DEFAULT, ['cost'=>12]);
        $bd = ConnectionFactory::makeConnection();
        $query = $bd->prepare("select * from userccd where login = ?"); $query->bindParam(1, $email); $query->execute();
        if($query->rowCount() > 0) throw new EmailAlreadyRegistedException("Email has already registed");
        if (self::checkPassStrength($password, 10)) {
            $query = $bd->prepare("insert into userccd (login, mdp, typeUser) values(?, ?, 'client')");
            $query->bindParam(1, $email);
            $query->bindParam(2, $hash);
            $query->execute();
        }
        return true;
    }

    public static function checkPassStrength(string $passwd, int $minLength):bool {
        $lenght = strlen($passwd) >= $minLength;
        if (!$lenght) throw new TooShortPasswordException("le mot de passe est trop court");
        $digit = preg_match("#\d#", $passwd);
        $special = preg_match("#\W#", $passwd);
        $lower = preg_match("#[a-z]#", $passwd);
        $upper = preg_match("#[A-Z]#", $passwd);
        if (! ($digit && $special && $lower && $upper)) throw new NotStrengthPassWord("le mot de passe n'est pas asses protoge: Doit contenir une Majuscule, une minuscule, un chiffre et un caractere speciale");
        return true;
    }


    public static function authenticate(string $email, string $passwd2check): bool {
        $connection = false;
        $bd = ConnectionFactory::makeConnection();
        $query = $bd->prepare("select * from userccd where login = ? ");
        $query->bindParam(1, $email);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            $hash = $data['mdp'];
            if (!password_verify($passwd2check, $hash)) {return false;}
            $_SESSION['user'] = serialize(new User($email, $passwd2check));
            $rep = $bd->query("select id from userccd where login = '$email' ");
            $row = $rep->fetch();
            $_SESSION['id'] = $row[0];
            $connection = true;
        }
        if ($connection) {
            setcookie("panier", "test:0");
        }
        return $connection;
    }
}