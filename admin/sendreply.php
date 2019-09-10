<?php
include dirname(__DIR__) . '/bootstrap.php';

if (\Application\Authentication::isNotLoggedIn()) {
    header('location:index.php');
} else {
    $msg = null;
    $replyto = null;

    if (isset($_GET['reply'])) {
        $replyto = $_GET['reply'];
    }

    if (isset($_POST['submit'])) {
        $reciver = $_POST['email'];
        $message = $_POST['message'];
        $notificationGateway = new \Application\NotificationGateway(get_database());
        $feedbackGateway = new \Application\FeedbackGateway(get_database());
        $sendReplyTransaction = new \Application\SendReplyTransaction(
            $notificationGateway,
            $feedbackGateway
        );
        $sendReplyTransaction->notifyAdmin($_POST['email'], $_POST['message']);
        $msg = "Feedback Send";
    }

    $usersGateway = new \Application\UsersGateway(get_database());
    $result = $usersGateway->findAll();
    $cnt = 1;

    echo $templates->render('admin/sendreply', compact('result', 'cnt', 'msg', 'replyto'));
}