<?php

error_reporting(E_ALL);

define('ROOT_DIR', dirname(__DIR__));

include ROOT_DIR . '/vendor/autoload.php';

include ROOT_DIR . '/includes/config.php';

include ROOT_DIR . '/src/RouteProvider.php';

$app = new \Application\Application();

$app->run();