<?php
include __DIR__ . '/bootstrap.php';

use Nyholm\Psr7\Factory\Psr17Factory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Component\HttpFoundation\Request;

$symfonyRequest = Request::createFromGlobals();
// The HTTP_HOST server key must be set to avoid an unexpected error
$psr17Factory = new Psr17Factory();
$psrHttpFactory = new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);
$psrRequest = $psrHttpFactory->createRequest($symfonyRequest);
$usersGateway = new \Application\UsersGateway(get_database());
$transaction = new \Application\LoginTransaction($usersGateway);
$plates = new Application\PlatesTemplate(TEMPLATES_DIR);
$controller = new \Application\Controllers\MainController($psrRequest, $transaction, $plates);
$controller->home();

/*
if (isset($_POST['login'])) {
    $usersGateway = new \Application\UsersGateway(get_database());
    $loginTransaction = new \Application\LoginTransaction($usersGateway);
    $loginTransaction->submitLogin($_POST['username'], $_POST['password']);
    if ($loginTransaction->submitLogin($_POST['username'], $_POST['password'])) {
        $_SESSION['alogin'] = $_POST['username']; ?>
        <script type='text/javascript'> document.location = 'profile.php'; </script>
    <?php } else { ?>
        <script> alert('Invalid Details Or Account Not Confirmed');</script>
        <?php
    }
}

// Render a template
echo $templates->render('home');*/