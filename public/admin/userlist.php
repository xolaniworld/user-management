<?php
include dirname(__DIR__) . '/bootstrap.php';

if(\Application\Authentication::isNotLoggedIn()) {
    header('location:index.php');
} else {

    $factory = new \Application\ControllerFactory();
    $factory->makeUserListController()->all();
}
