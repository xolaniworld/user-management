<?php

include __DIR__ . '/bootstrap.php';

if(\Application\Authentication::isNotLoggedIn()) {
    header('location:index.php');
} else {

    $reciver = $_SESSION['alogin'];
    $notificationGateway = new \Application\NotificationGateway($dbh);
    $notificationTransaction = new \Application\NotificationTransaction($notificationGateway);
    $notificationTransaction->findNotificationsByReciver($reciver);
//    $results = $notificationTransaction->getNotications();
//    $count = $notificationTransaction->getTotal();
//    $cnt=1;

    // Render a template
    echo $templates->render('notification', [
        'alogin' => $reciver,
        'results' => $notificationTransaction->getNotications(),
        'count' => $notificationTransaction->getTotal(),
        'cnt' => 1
    ]);
}