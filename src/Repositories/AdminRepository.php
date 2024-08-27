<?php

namespace App\Repositories;

use PDO;

class AdminRepository
{
    private $dbh;
    private $results;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }
    public function getAdminByUsernameOrEmail($usernameOrEmail)
    {
        $sql = 'SELECT username,password FROM admin WHERE `username` =:usernameOrEmail or `email` = :usernameOrEmail';
        $query = $this->dbh->prepare($sql);
        $query->bindParam(':usernameOrEmail', $usernameOrEmail, PDO::PARAM_STR);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }
}