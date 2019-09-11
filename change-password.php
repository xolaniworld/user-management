<?php

use Application\Request;
use Nyholm\Psr7\Factory\Psr17Factory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;

include __DIR__ . '/bootstrap.php';

if(\Application\Authentication::isNotLoggedIn()) {
    header('location:index.php');
} else {

    $symfonyRequest = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
// The HTTP_HOST server key must be set to avoid an unexpected error
    $psr17Factory = new Psr17Factory();
    $psrHttpFactory = new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);
    $psrRequest = $psrHttpFactory->createRequest($symfonyRequest);
    /* DEPENDENCY */
    $userGateway = new \Application\UsersGateway(get_database());
    $usersTransaction = new \Application\Users\UsersTransactions($userGateway, new \Application\Request(), new \Application\Filesystem(IMAGES_DIR));
    $plates = new Application\PlatesTemplate(TEMPLATES_DIR);

    $controller = new \Application\Controllers\UsersController($psrRequest, $usersTransaction, $plates, \Application\Session::getSession());
    $controller->changePassword();

//    $msg = null;
//    $error = null;
//    // Code for change password
//    if (isset($_POST['submit'])) {
//        $usersGateway = new \Application\UsersGateway(get_database());
//        $usersTransactions = new \Application\Users\UsersTransactions(
//                $usersGateway,
//                new Request(),
//                new \Application\Filesystem(IMAGES_DIR)
//        );
//
//        if ($usersTransactions->changePassword($_SESSION['alogin'], $_POST['password'], $_POST['newpassword'])) {
//            $msg = "Your Password succesfully changed";
//        } else {
//            $error = "Your current password is not valid.";
//        }
//    }
//    $session = \Application\Session::getSession();
//    $alogin = $session->get('alogin');
//
//    /* FINISHED */
//    echo $templates->render('change_password', compact('alogin','msg', 'error'));
}