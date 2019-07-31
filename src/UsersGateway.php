<?php

namespace Application;
use PDO;

class UsersGateway
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function countByEmailPassowrdAndStatus($email, $password, $status)
    {
        $sql = "SELECT email,password FROM users WHERE email=:email and password=:password and status=(:status)";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        return $query->rowCount();
    }
}