<?php
include dirname(__DIR__) . '/bootstrap.php';

if(\Application\Authentication::isNotLoggedIn()) {
    header("Location: index.php");
} else {
    $usersGateway = new \Application\UsersGateway(get_database());
    $transaction = new \Application\DownloadTransaction($usersGateway);
    $controller = new \Application\Controllers\Admin\DownloadController($transaction);
    $controller->download();
}