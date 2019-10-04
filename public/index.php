<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

include __DIR__ . '/bootstrap.php';

//$controllerFactory = new \Application\ControllerFactory();
//$controllerFactory->makeMainController()->home();

$app = new \Application\Application();

$app->run();