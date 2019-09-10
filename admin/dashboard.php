<?php
include dirname(__DIR__) . '/bootstrap.php';

if (\Application\Authentication::isNotLoggedIn()) {
    header('location:index.php');
} else {

    $dashboardTransaction = new \Application\Admin\DashboardTransaction(
        new \Application\UsersGateway(get_database()),
        new \Application\FeedbackGateway(get_database()),
        new \Application\NotificationGateway(get_database()),
        new \Application\DeletedUserGateway(get_database())
    );

    list($bg, $regbd, $regbd2, $query) = $dashboardTransaction->dashboard();

    // Render a template
    echo $templates->render('dashboard', compact('bg','regbd', 'regbd2', 'query'));
}