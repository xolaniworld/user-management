<?php
include __DIR__ . '/bootstrap.php';

if(\Application\Authentication::isNotLoggedIn()) {
    header('location:index.php');
} else {
    $reciver = $_SESSION['alogin'];
    $feedbackGateway = new \Application\FeedbackGateway($dbh);
    list($results, $count) = $feedbackGateway->findByReciver($reciver);
    $cnt=1;

    // Render a template
    echo $templates->render('messages', [
        'alogin' => $reciver,
        'results' => $results,
        'count' => $count
    ]);
}