<?php
include __DIR__ . '/bootstrap.php';

if (\Application\Authentication::isNotLoggedIn()) {
    header('location:index.php');
    exit;
} else {
    $msg = null;
    if (isset($_POST['submit'])) {
        $notificationGateway = new \Application\NotificationGateway(get_database());
        $feedbackGateway = new \Application\FeedbackGateway(get_database());
        $frontendFeedbackTransaction = new \Application\FrontendFeedbackTransaction($feedbackGateway, $notificationGateway, new \Application\Filesystem(ATTACHMENT_DIR));
        $frontendFeedbackTransaction->submitFeedback($_POST['title'], $_POST['description'], $_SESSION['alogin'], $_FILES['attachment']);
        $msg = "Feedback Send";
    }

    $headerTitle = 'Feedback';
    $usersGateway = new \Application\UsersGateway(get_database());
    $result = $usersGateway->findAll();
    $cnt = 1;

    // Render a template
    echo $templates->render('feedback', [
        'alogin' => $_SESSION['alogin'],
        'msg' => $msg,
        'cnt' => $cnt,
        'result' => $result
    ]);
}