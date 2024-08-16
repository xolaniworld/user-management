<?php

namespace UserManagement\Admin;

use PDO;

class AdminRepository
{
    private $dbh;
    private $results;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }
    public function userLogin($usernameOrEmail, $password)
    {
        $sql = 'SELECT username, password FROM admin WHERE `username` =:usernameOrEmail or `email` = :usernameOrEmail';
        $query = $this->dbh->prepare($sql);
        $query->bindParam(':usernameOrEmail', $usernameOrEmail, PDO::PARAM_STR);
        $query->execute();
        if ($result = $query->fetch(PDO::FETCH_OBJ)) {
            return password_verify($password, $result->password);
        }
        return false;
    }

    public function getResults()
    {
        return $this->results;
    }
}