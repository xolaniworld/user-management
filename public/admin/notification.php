<?php

use Nyholm\Psr7\Factory\Psr17Factory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;

include __DIR__ . '/../bootstrap.php';

$session = new \Application\Session();
$request = new \Application\Request();

if (\Application\Authentication::isNotLoggedIn()) {
    header('location:index.php');
} else {
    $adminGateway = new \Application\Admin\AdminGateway(get_database());
    $notificationGateway = new \Application\NotificationGateway(get_database());

    $symfonyRequest = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
    $psr17Factory = new Psr17Factory();
    $psrHttpFactory = new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);
    $psr7HttpRequest = $psrHttpFactory->createRequest($symfonyRequest);

    $notificationTransaction = new \Application\NotificationTransaction($notificationGateway);
    $adminTransaction = new \Application\Admin\AdminTransaction($adminGateway);

    $controller = new \Application\Controllers\Admin\NotificationController(
        $notificationTransaction,
        $adminTransaction,
        new \Application\PlatesTemplate(TEMPLATES_DIR),
        $psr7HttpRequest
    );

    $controller->notification();

//    if ($request->postIsset('submit')) {
//        $adminTransaction->submitUpdateAdminUpdateUsernameAndPassword(
//            $request->getPost('name'),
//            $request->getPost('email')
//        );
//        $msg = "Information Updated Successfully";
//    }
//    $notificationTransaction->findAdminNotifications();
//    $results = $notificationTransaction->getNotications();
//    $count = $notificationTransaction->getTotal();
//    $cnt = 1;
//
//    echo $templates->render('admin/notification', compact('results', 'count', 'cnt'));
}