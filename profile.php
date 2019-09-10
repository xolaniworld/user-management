<?php

use Nyholm\Psr7\Factory\Psr17Factory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Component\HttpFoundation\Request;

include __DIR__ . '/bootstrap.php';

if (\Application\Authentication::isNotLoggedIn()) {
    header('location:index.php');
} else {


    $symfonyRequest = Request::createFromGlobals();
// The HTTP_HOST server key must be set to avoid an unexpected error
    $psr17Factory = new Psr17Factory();
    $psrHttpFactory = new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);
    $psrRequest = $psrHttpFactory->createRequest($symfonyRequest);
    /* DEPENDENCY */
    $userGateway = new \Application\UsersGateway(get_database());
    $usersTransaction = new \Application\Users\UsersTransactions($userGateway, new \Application\Request(), new \Application\Filesystem(IMAGES_DIR));
    $plates = new Application\PlatesTemplate(TEMPLATES_DIR);

    $controller = new \Application\Controllers\UsersController($psrRequest, $usersTransaction, $plates);
    $controller->profile(\Application\Session::getSession());
}