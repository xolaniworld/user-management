<?php

use Nyholm\Psr7\Factory\Psr17Factory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;

include dirname(__DIR__) . '/bootstrap.php';
if (\Application\Authentication::isNotLoggedIn()) {
    header('location:index.php');
} else {
    $symfonyRequest = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
    $psr17Factory = new Psr17Factory();
    $psrHttpFactory = new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);
    $psr7HttpRequest = $psrHttpFactory->createRequest($symfonyRequest);

    $adminGateway = new \Application\Admin\AdminGateway(get_database());
    $adminTransaction = new \Application\Admin\AdminTransaction($adminGateway);
    $controller = new \Application\Controllers\Admin\AdminController(
        $adminTransaction,
        $psr7HttpRequest,
        \Application\Session::getSession(),
        new \Application\PlatesTemplate(TEMPLATES_DIR)
    );

    $controller->profile();

//    $msg = null;
//    if (isset($_POST['submit'])) {
//        $name = $_POST['name'];
//        $email = $_POST['email'];
//        $adminTransaction->submitUpdateAdminUpdateUsernameAndPassword($name, $email);
//        $msg = "Information Updated Successfully";
//    }
//
//    $result = $adminTransaction->getAll();
//    $cnt = 1;
//
//    echo $templates->render('admin/profile', compact('result', 'cnt', 'name', 'email', 'msg'));
}