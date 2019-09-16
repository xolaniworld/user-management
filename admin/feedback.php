<?php

use Application\FeedbackTransaction;
use Application\RendererInterface;
use Application\Users\UsersTransactions;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;

include __DIR__ . '/../bootstrap.php';

if (\Application\Authentication::isNotLoggedIn()) {
    header('location:index.php');
} else {
    $symfonyRequest = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
    $psr17Factory = new Psr17Factory();
    $psrHttpFactory = new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);
    $psr7HttpRequest = $psrHttpFactory->createRequest($symfonyRequest);

    $userGateway = new \Application\UsersGateway(get_database());
    $request = new \Application\Request();
    $filesystem = new \Application\Filesystem(IMAGES_DIR);
    $usersTransaction = new Application\Users\UsersTransactions($userGateway, $request, $filesystem);
    $feedbackGateway = new \Application\FeedbackGateway(get_database());
    $feedbackTransaction = new \Application\FeedbackTransaction($feedbackGateway);
    $controller = new \Application\Controllers\Admin\FeedbackController($usersTransaction, $feedbackTransaction, $psr7HttpRequest, new \Application\PlatesTemplate(TEMPLATES_DIR));
    $controller->feedback();
}
