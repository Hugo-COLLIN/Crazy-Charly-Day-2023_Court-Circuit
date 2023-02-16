<?php

namespace iutnc\ccd\db;


class User
{
    private string $email;
    private string $passwd;

    /**
     * @param string $email
     * @param string $passwd
     */
    public function __construct(string $email, string $passwd)
    {
        $this->email = $email;
        $this->passwd = $passwd;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    public function getID() : int{
        $bd = ConnectionFactory::makeConnection();
        $stmt = $bd->prepare("SELECT id from userccd where login = '$this->email'");
        return $stmt->execute()->fetch();
    }


    public function getRole() : string
    {
        $bd = ConnectionFactory::makeConnection();
        $stmt = $bd->prepare("SELECT typeUser from userccd where login = '$this->email'");
        $stmt->execute();

        return $stmt->fetch()[0];
    }

}