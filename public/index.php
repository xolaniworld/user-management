<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

include dirname(__DIR__) . '/bootstrap.php';

$app = new \Application\Application();

$app->run();