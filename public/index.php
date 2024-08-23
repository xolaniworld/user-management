<?php

error_reporting(E_ALL);

require __DIR__ . '/../bootstrap.php';

//define('ROOT_DIR', dirname(__DIR__));

//include ROOT_DIR . '/config/defaults.php';

include dirname(__DIR__) . '/src/RouteProvider.php';

$app = new \Application\Application();

$app->run();