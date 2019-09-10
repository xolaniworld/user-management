<?php
include dirname(__DIR__) . '/bootstrap.php';

if (\Application\Authentication::isNotLoggedIn()) {
    header('location:index.php');
} else {

    $dashboardTransaction = new \Application\Admin\DashboardTransaction(
        new \Application\UsersGateway($dbh),
        new \Application\FeedbackGateway($dbh),
        new \Application\NotificationGateway($dbh),
        new \Application\DeletedUserGateway($dbh)
    );

    list($bg, $regbd, $regbd2, $query) = $dashboardTransaction->dashboard();

// Render a template
    echo $templates->render('dashboard', [
        'alogin' => $_SESSION['alogin'],
        'bg' => $bg,
        'regbd' => $regbd,
        'regbd2' => $regbd2,
        'query' => $query
    ]);
}