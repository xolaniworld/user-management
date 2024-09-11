<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;

//*******************************************************************************************************
// Constants
//*******************************************************************************************************
const ROOT_DIR = __DIR__;
const INCLUDES_DIR = ROOT_DIR . '/includes';
const STORAGE_DIR = ROOT_DIR . '/storage';
const PUBLIC_DIR = ROOT_DIR . '/public';
const IMAGES_DIR = PUBLIC_DIR . '/images';
const ATTACHMENT_DIR = PUBLIC_DIR . '/attachment';
const TEMPLATES_DIR = ROOT_DIR . '/templates';

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
        $dbh = new PDO("mysql:host=" . $_ENV['DB_HOST']
            . ";dbname=" . $_ENV['DB_DATABASE'],
            $_ENV['DB_USERNAME'],
            $_ENV['DB_PASSWORD'],
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
$migrationsConfig = new PhpFile(__DIR__ . '/config/migrations.php');

//*******************************************************************************************************
// Create a simple "default" Doctrine ORM configuration for Attributes
//*******************************************************************************************************
$ORMConfig  = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__."/src"],
    isDevMode: true,
);

//*******************************************************************************************************
// configuring the database connection
//*******************************************************************************************************
$connection = DriverManager::getConnection([
    'driver' => 'pdo_mysql',
    'dbname' => $_ENV['DB_DATABASE'],
    'user' => $_ENV['DB_USERNAME'],
    'password' => $_ENV['DB_PASSWORD'],
    'host' => $_ENV['DB_HOST'],
], $ORMConfig);

//*******************************************************************************************************
// Obtaining the entity manager
//*******************************************************************************************************
$entityManager =  new EntityManager($connection, $ORMConfig);

//*******************************************************************************************************
// Dependency Factory
//*******************************************************************************************************
return DependencyFactory::fromEntityManager($migrationsConfig, new ExistingEntityManager($entityManager));
