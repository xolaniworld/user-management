<?php


namespace Application;


use PDO;

abstract class AbstractGateway
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}