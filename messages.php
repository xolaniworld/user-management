<?php
include __DIR__ . '/bootstrap.php';

if (\Application\Authentication::isNotLoggedIn()) {
    header('location:index.php');
} else {
    $alogin = $_SESSION['alogin'];
    $feedbackGateway = new \Application\FeedbackGateway(get_database());
    list($results, $count) = $feedbackGateway->findByReciver($alogin);
    $cnt = 1;

    // Render a template
    echo $templates->render('messages', compact('alogin', 'results', 'count', 'cnt'));
}