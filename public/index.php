<?php

error_reporting(E_ALL);

require __DIR__ . '/../bootstrap.php';

include dirname(__DIR__) . '/src/routes.php';

$app = new \Application\Application();

$app->run();