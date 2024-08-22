<?php
// bootstrap.php
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

// Create a simple "default" Doctrine ORM configuration for Attributes
$config = ORMSetup::createAttributeMetadataConfiguration(
    [__DIR__ . '/src'],
    true
);

// configuring the database connection
$connection = DriverManager::getConnection([
    'driver' => 'pdo_mysql',
    'dbname' => DB_NAME,
    'user' => DB_USER,
    'password' => DB_PASS,
    'host' => DB_HOST,
], $config);

// obtaining the entity manager
return new EntityManager($connection, $config);