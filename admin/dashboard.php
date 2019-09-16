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

    $controller = new \Application\Controllers\Admin\DashboardController($dashboardTransaction, new \Application\PlatesTemplate(TEMPLATES_DIR));

    $controller->dashboard();
}