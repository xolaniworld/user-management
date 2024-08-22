#!/usr/bin/env php
<?php
// bin/doctrine

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// Adjust this path to your actual bootstrap.php
$entityManager = require_once __DIR__ . '/entity-manager.php';

ConsoleRunner::run(
    new SingleManagerProvider($entityManager)
);