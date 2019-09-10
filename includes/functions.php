<?php

use Symfony\Component\HttpFoundation\Session\Session;

function get_database() {
    static $dbh;

    if ($dbh !== null) {
        return $dbh;
    }

    // Establish database connection.
    try {
        $dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]);
        return $dbh;
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }
}