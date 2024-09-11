<?php
// bootstrap.php
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\Migrations\Configuration\Migration\PhpFile;

// Or use one of the Doctrine\Migrations\Configuration\Configuration\* loaders
$migrationConfig = new PhpFile(__DIR__ . '/../migrations.php');

//$paths = [ __DIR__.'/../src/Entity'];
//$isDevMode = true;

// Create a simple "default" Doctrine ORM configuration for Attributes
$ormConfig = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__."/src"],
    isDevMode: true,
);

//$config = array_merge($ormConfig, $migrationConfig);

//dump($config); exit;

// configuring the database connection
$connection = DriverManager::getConnection([
    'driver' => 'pdo_mysql',
    'dbname' => $_ENV['DATABASE_NAME'],
    'user' => $_ENV['DATABASE_USER'],
    'password' => $_ENV['DATABASE_PASS'],
    'host' => $_ENV['DATABASE_HOST'],
], $config);

// obtaining the entity manager
return new EntityManager($connection, $config);