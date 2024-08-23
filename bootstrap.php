<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

//*******************************************************************************************************
// Constants
//*******************************************************************************************************
define('ROOT_DIR', __DIR__);
define('INCLUDES_DIR', ROOT_DIR . '/includes');
define('STORAGE_DIR', ROOT_DIR . '/storage');
define('PUBLIC_DIR', ROOT_DIR . '/public');
define('IMAGES_DIR', PUBLIC_DIR . '/images');
define('ATTACHMENT_DIR', PUBLIC_DIR . '/attachment');
define('TEMPLATES_DIR', ROOT_DIR . '/templates');

//*******************************************************************************************************
// Composer autoload
//*******************************************************************************************************
require_once __DIR__ . '/vendor/autoload.php';

//*******************************************************************************************************
// Error handler
//*******************************************************************************************************
$whoops = new \Whoops\Run;
$whoops->prependHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

//*******************************************************************************************************
// Load environment variables
//*******************************************************************************************************
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//*******************************************************************************************************
// Global database PDO
//*******************************************************************************************************
function get_database() {
    static $dbh;

    if ($dbh !== null) {
        return $dbh;
    }

    // Establish database connection.
    try {
        $dbh = new PDO("mysql:host=" . $_ENV['DATABASE_HOST']
            . ";dbname=" . $_ENV['DATABASE_NAME'],
            $_ENV['DATABASE_USER'],
            $_ENV['DATABASE_PASS'],
            [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]
        );
        return $dbh;
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }
}

//*******************************************************************************************************
// Create a simple "default" Doctrine ORM configuration for Attributes
//*******************************************************************************************************
$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__."/src"],
    isDevMode: true,
);

//*******************************************************************************************************
// configuring the database connection
//*******************************************************************************************************
$connection = DriverManager::getConnection([
    'driver' => 'pdo_mysql',
    'dbname' => $_ENV['DATABASE_NAME'],
    'user' => $_ENV['DATABASE_USER'],
    'password' => $_ENV['DATABASE_PASS'],
    'host' => $_ENV['DATABASE_HOST'],
], $config);

//*******************************************************************************************************
// obtaining the entity manager
//*******************************************************************************************************
$entityManager =  new EntityManager($connection, $config);