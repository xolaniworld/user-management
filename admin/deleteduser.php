<?php
include dirname(__DIR__) . '/bootstrap.php';

if(\Application\Authentication::isNotLoggedIn()) {
    header('location:index.php');
} else {
    $deletedUserGateway = new \Application\DeletedUserGateway(get_database());
    $transaction = new \Application\DeletedUsersTransaction($deletedUserGateway);
    $controller = new \Application\Controllers\Admin\DeletedUsersController($transaction, new \Application\PlatesTemplate(TEMPLATES_DIR));
    $controller->all();
}