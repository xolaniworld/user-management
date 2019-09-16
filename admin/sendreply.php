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

    $notificationGateway = new \Application\NotificationGateway(get_database());
    $feedbackGateway = new \Application\FeedbackGateway(get_database());
    $usersGateway = new \Application\UsersGateway(get_database());

    $sendReplyTransaction = new \Application\SendReplyTransaction(
        $notificationGateway,
        $feedbackGateway,
        $usersGateway
    );

    $controller = new \Application\Controllers\SendReplyController(
        $sendReplyTransaction, $psr7HttpRequest, new \Application\PlatesTemplate(TEMPLATES_DIR)
    );

    $controller->sendReply();

//    $msg = null;
//    $replyto = null;
//
//    if (isset($_GET['reply'])) {
//        $replyto = $_GET['reply'];
//    }
//
//    if (isset($_POST['submit'])) {
//        $reciver = $_POST['email'];
//        $message = $_POST['message'];
//        $sendReplyTransaction->notifyAdmin($_POST['email'], $_POST['message']);
//        $msg = "Feedback Send";
//    }
//
//    $result = $sendReplyTransaction->findAllUsers();
//    $cnt = 1;
//
//    echo $templates->render('admin/sendreply', compact('result', 'cnt', 'msg', 'replyto'));
}