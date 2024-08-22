<?php

error_reporting(E_ALL);

define('ROOT_DIR', dirname(__DIR__));

require_once ROOT_DIR . '/vendor/autoload.php';

include ROOT_DIR . '/config/defaults.php';

include ROOT_DIR . '/src/RouteProvider.php';

$app = new \Application\Application();

$app->run();