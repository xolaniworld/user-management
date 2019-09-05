<?php
// DB credentials.
define('DB_HOST', 'localhost');
define('DB_USER', 'dbuser');
define('DB_PASS', 'dbuser');
define('DB_NAME', '2520448_armentum');

define('ROOT_DIR', dirname(__DIR__));
define('IMAGES_DIR', ROOT_DIR . '/images/');
define('INCLUDES_DIR', ROOT_DIR . '/includes/');
define('ATTACHMENT_DIR', ROOT_DIR . '/attachment/');

// Establish database connection.
try {
    $dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]);
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}
