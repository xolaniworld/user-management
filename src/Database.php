<?php
namespace App;

use PDO;

class Database
{
    private static $connection;

    private $username;
    private $password;
    private $database;
    private $host;

    public function __construct($username, $password, $database, $host)
    {
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->host = $host;
    }

    public function getConnection()
    {
        if (static::$connection === null) {
            static::$connection = new PDO("mysql:host=" . $this->host
                . ";dbname=" . $this->database, $this->username, $this->password, [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
            ]);
        }

        return static::$connection;
    }
}