<?php
include __DIR__ . '/../bootstrap.php';

if(\Application\Authentication::isNotLoggedIn()) {
    header('location:index.php');
} else {
    $factory = new \Application\ControllerFactory();
    $factory->makeUserController()->edit();
}