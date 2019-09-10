<?php
include dirname(__DIR__) . '/bootstrap.php';

if(\Application\Authentication::isNotLoggedIn()) {
    header('location:index.php');
} else {
    $deletedUserGateway = new \Application\DeletedUserGateway(get_database());
    $transaction = new \Application\DeletedUsersTransaction($deletedUserGateway);
    list($results, $count) = $transaction->findAllDeletedUsers();
    $cnt = 1;

    // Render a template
    echo $templates->render('deleteduser', [
//        'alogin' => $_SESSION['alogin'],
        'results' => $results,
        'count' => $count,
        'cnt' => $cnt
    ]);
}