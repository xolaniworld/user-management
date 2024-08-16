<?php

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// Establish database connection.
try {
    $dbh = new PDO("mysql:host=". $_ENV['DATABASE_HOST']
        .";dbname=".$_ENV['DATABASE_NAME'],
        $_ENV['DATABASE_USER'],
        $_ENV['DATABASE_PASS'],
        [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]);
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}
return $dbh;
