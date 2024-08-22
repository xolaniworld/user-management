<?php
// bootstrap.php
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

// Create a simple "default" Doctrine ORM configuration for Attributes
 $config = ORMSetup::createAnnotationMetadataConfiguration(
    [dirname(__DIR__)."/src"],
    true
 );

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